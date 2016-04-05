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

		// verify the agent
		if (!$this->users->exists($team))
			$this->booboo('Unrecognized agent');
		$theteam = $this->users->get($team);
		if ($token != $theteam->password)
			$this->booboo('Bad agent token');
		echo 'should not see this';
		die();

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
		if ($password != $this->properties->get('potd'))
			$this->booboo('Incorrect password');

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

		$certificate = $this->certificates->create();
		$certificate->token = dechex(rand(1000000));
		$certificate->stock = $stock;
		$certificate->agent = $team;
		$certificate->player = $player;
		$certificate->amount = $quantity;
		$this->certificates->add($certificate);

		$cert = new SimpleXMLElement('<certificate/>');
		foreach (((array) $certificate) as $key => $value)
			$cert->$key = $value;
		$this->output
				->set_content_type('text/xml')
				->set_output($cert->asXML());
	}

	// respond with an error message
	function booboo($message = "Unknown erorr")
	{
		$response = new SimpleXMLElement('<error/>');
		$response->message = $message;
		// return it to the user
		$this->output
				->set_content_type('text/xml')
				->set_output($response->asXML());
		die();
	}

}
