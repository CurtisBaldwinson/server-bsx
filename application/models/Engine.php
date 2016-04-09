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

		$now = date(DATE_FORMAT);
		$alarm = $CI->properties->get('alarm');
		if ($now > $alarm)
			$this->gearChange($state);

		if ($state == GAME_OPEN)
		{
			// look for stock movement events
		}
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
				// handle any queued movement transactions
				//FIXME
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

	// Pick the stocks to sue for the current round
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
			if (!$CI->stocks->exists($pickme->code))
				$CI->stocks->add($pickme);
		}
	}

	// Generate an appropriate set of stock movements
	//FIXME
	function generateMoves() {
		
	}
	
	// Eliminate stale players or agents
	//FIXME
	function tossStale() {
		
	}
	
	// Clear all player slates
	function cleanSlate() {
		$CI = &get_instance();
		$CI->certificates->truncate();
		$pot = $CI->properties->get('startcash');
		foreach($CI->players->all() as $player) {
			$player->cash = $pot;
			$CI->players->update($player);
		}
	}
}
