<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * BSX Server - return the game status
 */
class Status extends Application {

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
		// build our state description
		$scoop = new SimpleXMLElement('<bsx/>');
		$scoop->round = $this->properties->get('round');
		$state = $this->properties->get('state');
		$scoop->state = $state;

		// game state descriptions
		$game_states = array(
			'0' => 'closed',
			'1' => 'setup',
			'2' => 'ready',
			'3' => 'open',
			'4' => 'over'
		);
		$state_descs = $this->config->item('game_states');
		$state_countdowns = $this->config->item('state_countdowns');
		
		$scoop->desc = (isset($game_states[$state])) ? $game_states[$state] : "Unknown";

		$upcoming = ($state + 1) % GAME_OVER;
		$scoop->current = $state_descs[$state];
		$scoop->duration = $state_countdowns[$state];
		$scoop->upcoming = $state_descs[$upcoming];
		$scoop->alarm = date(SHORT_DATE, $this->properties->get('alarm'));
		$scoop->now = date(SHORT_DATE);
		$scoop->desc = (isset($game_states[$state])) ? $game_states[$state] : "Unknown";
		$scoop->countdown = $this->properties->get('alarm') - time();

		// return it to the user
		$this->output
				->set_content_type('text/xml')
				->set_output($scoop->asXML());
	}

}
