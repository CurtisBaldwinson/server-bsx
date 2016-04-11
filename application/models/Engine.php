<?php

/**
 * Game engine
 * 
 */
class Engine extends CI_Model {

	var $state = -1;
	var $next_event = -1;

	public function __construct()
	{
		parent::__construct();

		$CI = &get_instance();
		$this->state = $CI->properties->get('state');
		$this->next_event = $CI->properties->get('next_event');
	}

	// Check for an alarm gone off; handle it
	function check()
	{
		$CI = &get_instance();
		$state = $CI->properties->get('state');

		$now = time();
		$alarm = $CI->properties->get('alarm');
		if ($now > $alarm)
			$this->gearChange($state);

		if ($state == GAME_OPEN)
			$this->processQueue();
	}

	// advance the game state
	function gearChange($state)
	{
		$CI = &get_instance();
		switch ($state)
		{
			case GAME_CLOSED:
				// flush the round-specific tables
				$CI->movement->truncate();
				$CI->queue->truncate();
				$CI->transactions->truncate();
				$CI->certificates->truncate();
				break;
			case GAME_SETUP:
				// choose candidate stocks
				$this->pickStocks();
				// generate movements
				$this->generateMoves();
				// eliminate stale players or agents
				$this->tossStale();
				// reset starting cash & certificates
				$this->cleanSlate();
				// update the round #
				$round = $CI->properties->get('round');
				$CI->properties->put('round', $round + 1);
				break;
			case GAME_READY:
				// brief pause for commercials; nothing to do
				break;
			case GAME_OPEN:
				// nothing to see or do here
				break;
			case GAME_OVER:
			default:
				// nothing to do but wait
				break;
		}

		// advance to the next state
		$state = ($state + 1) % (GAME_OVER + 1);
		$CI->properties->put('state', $state);
		$next_alarm = time() + (int) ($CI->config->item('state_countdowns')[$state]);
		$CI->properties->put('alarm', $next_alarm);
	}

	// homepage report
	function report()
	{
		$CI = &get_instance();
		$parms = array();
		$state_descs = $CI->config->item('game_states');
		$state_countdowns = $CI->config->item('state_countdowns');
		$current = $CI->properties->get('state');
		$upcoming = ($current + 1) % GAME_OVER;
		$parms['current'] = $state_descs[$current];
		$parms['duration'] = $state_countdowns[$current];
		$parms['upcoming'] = $state_descs[$upcoming];
		$parms['alarm'] = date(SHORT_DATE, $CI->properties->get('alarm'));
		$parms['round'] = $CI->properties->get('round');
		$parms['now'] = date(SHORT_DATE);
		return $CI->parser->parse('status_report', $parms, true);
	}

	// Pick the stocks to use for the current round
	function pickStocks()
	{
		$CI = &get_instance();
		$CI->stocks->truncate();
		$size = $CI->candidates->size();
		$choices = rand(6, $size / 2); // choose a number
		$pool = $CI->candidates->results();
		for ($index = 0; $index < $choices; $index++)
		{
			$pick = rand(0, $size);
			$pickme = $pool->row($pick);
			if (!$CI->stocks->exists($pickme->code)) {
				$pickme->value = 100; // all start at 100
				$CI->stocks->add($pickme);
			}
		}
	}

	// Generate an appropriate set of stock movements
	function generateMoves()
	{
		$CI = &get_instance();
		$count = $CI->config->item('state_countdowns')[GAME_OPEN];
		$start = time();

		// generation parameters
		$genx = array(
			STOCK_BLUECHIP => 0.1,
			STOCK_NORMAL => 0.25,
			STOCK_PENNY => 0.5
		);
		// dice to use
		$genz = array(
			STOCK_BLUECHIP => array('up', 'up', 'up', 'down', 'div', 'div'), // favors up
			STOCK_NORMAL => array('up', 'down', 'div'), // normal
			STOCK_PENNY => array('up', 'up', 'down', 'down', 'div') // favors non-div
		);

		// generate candidate movements
		$upcoming = array();
		foreach ($CI->stocks->all() as $stock)
		{
			$stock_type = $stock->category;
			$limit = $count * $genx[$stock_type];
			$dice = $genz[$stock_type];
			$amounts = array(5, 10, 20);
			for ($i = 0; $i < $limit; $i++)
			{
				$maybe = $CI->movement->create();
				$maybe->datetime = $start + rand(0, $count);
				$maybe->code = $stock->code;
				$maybe->action = $dice[array_rand($dice)];
				$maybe->amount = $amounts[array_rand($amounts)];
				$key = $maybe->datetime . (1000 + $i);
				$upcoming[$key] = $maybe;
			}
		}

		// order the candidate movements
		ksort($upcoming);
		// add the candidate movements to our queue
		foreach ($upcoming as $maybe)
			$this->queue->add($maybe);
	}

	// Eliminate stale players or agents
	function tossStale()
	{
		$CI = &get_instance();
		$cutoff = $CI->properties->get('round') - 2;
		// clean up the players
		foreach ($CI->players->all() as $player)
			if ($player->round < $cutoff)
				$CI->players->delete($player->seq);
		// clean up the agents
		foreach ($CI->users->all() as $user)
			if ($user->last_round < $cutoff)
				$CI->users->delete($user->code);
	}

	// Clear all player slates
	function cleanSlate()
	{
		$CI = &get_instance();
		$CI->certificates->truncate();
		$pot = $CI->properties->get('startcash');
		foreach ($CI->players->all() as $player)
		{
			$player->cash = $pot;
			$CI->players->update($player);
		}
	}

	// process as much of the movement queue as needed
	function processQueue()
	{
		$CI = &get_instance();
		$now = time();
		// consume from the front of the queue
		while (true)
		{
			$record = $CI->queue->first();
			if ($record->datetime > $now)
				break;
			$this->handle($record);
			$CI->queue->delete($record->seq);
			$CI->movement->add($record);
		}
	}

	// handle a market movement
	function handle($record)
	{
		$CI = &get_instance();
		$stock = $CI->stocks->get($record->code);

		// make sure we found the stock in question
		if ($stock == null) return;
		
		switch ($record->action)
		{
			case MOVE_UP:
				$stock->value += $record->amount;
				if ($stock->value >= 200)
				{
					$this->stock_split($stock->code);
					$stock->value = 100;
				}
				break;
			case MOVE_DOWN:
				$stock->value -= $record->amount;
				if ($stock->value <= 0)
				{
					$this->stock_delist($stock->code);
					$stock->value = 100;
				}
				break;
			case MOVE_DIVIDEND:
				if ($stock->value >= 100)
					$this->stock_dividend($stock->code, $record->amount);
				break;
			default:
				// not our problem
				return;
		}
		$CI->stocks->update($stock);
	}

	// hand;e a stock split
	function stock_split($code)
	{
		$CI = &get_instance();
		$winners = $CI->certificates->some('stock', 'code');
		foreach ($winners as $record)
		{
			$record->amount *= 2;
			$CI->certificates->update($record);
		}
	}

	// hand;e a stock delisting
	function stock_delist($code)
	{
		$CI = &get_instance();
		$losers = $CI->certificates->some('stock', 'code');
		foreach ($losers as $record)
		{
			$CI->certificates->delete($record->token);
		}
	}

	// handle a stock dividend
	function stock_dividend($code, $amount)
	{
		$CI = &get_instance();
		$winners = $CI->certificates->some('stock', 'code');
		foreach ($winners as $record)
		{
			$lucky1 = $CI->players->find($record->agent, $record->player);
			if ($lucky1 != null)
			{
				$lucky1->cash += $record->amount * $amount;
				$CI->players->update($lucky1);
			}
		}
	}

}
