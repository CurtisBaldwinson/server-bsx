<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * BSX Server - buy stock
 */
class Buy extends Application {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Default entry point
	 */
	function index()
	{
		// extract parameters - what do they want to do?
		$team = $this->input->post_get('team');
		$token = $this->input->post_get('token');
		$player = $this->input->post_get('player');
		$stock = $this->input->post_get('stock');
		$quantity = $this->input->post_get('quantity');

		// existence testing
		if (empty($team)) $this->booboo('You are missing an agency code');
		if (empty($token)) $this->booboo('Your need your agent token');
		if (empty($player)) $this->booboo('Which player is this transaction for?');
		if (empty($stock)) $this->booboo('Which stock are they looking to buy?');
		if (empty($quantity)) $this->booboo('How much stock do they widh to buy?');
		
		// verify the agent
		if (!$this->users->exists($team))
			$this->booboo('Unrecognized agent');
		$theteam = $this->users->get($team);
		if ($token != $theteam->password)
			$this->booboo('Bad agent token');
		
		// Verify the player
		$players = $this->players->some('agent', $team);
		$found = -1;
		foreach ($players as $one)
		{
			if (($one->agent == $team) && ($one->player == $player))
				$found = $one->seq;
		}

		if ($found < 1)
		{
			// create new player record
			$one = $this->players->create();
			$one->agent = $team;
			$one->player = $player;
			$one->cash = $this->properties->get('startcash');
			$this->players->add($one);
			$found = $this->players->size();
		}
		$one = $this->players->get($found);
		$one->round = $this->properties->get('round');
		$this->players->update($one);


		if (!$this->stocks->exists($stock))
			$this->booboo('Unrecognized stock');

		if ($quantity < 1)
			$this->booboo('Nice try!');

		// finally, can they afford the transaction?
		$thestock = $this->stocks->get($stock);
		$amount = $thestock->value * $quantity;
		if ($amount > $one->cash)
			$this->booboo('You cannot afford to buy that');

		// take the money out of their account
		$one->cash -= $amount;
		$this->players->update($one);
		
		// record the transaction
		$trx = $this->transactions->create();
		$trx->seq=0;
		$trx->datetime = date(DATE_ATOM);
		$trx->agent = $team;
		$trx->player = $player;
		$trx->stock = $stock;
		$trx->trans = 'buy';
		$trx->quantity = $quantity;
		$this->transactions->add($trx);

		$certificate = $this->certificates->create();
		$certificate->token = dechex(rand(0,1000000));
		$certificate->stock = $stock;
		$certificate->agent = $team;
		$certificate->player = $player;
		$certificate->amount = $quantity;
		$certificate->datetime = date(DATE_ATOM);
		$this->certificates->add($certificate);

		$cert = new SimpleXMLElement('<certificate/>');
		foreach (((array) $certificate) as $key => $value)
			$cert->$key = $value;
		$this->output
				->set_content_type('text/xml')
				->set_output($cert->asXML());
	}


}
