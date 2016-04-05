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
		$scoop->countdown = $this->properties->get('countdown');
		
		// game state descriptions
		$game_states = array(
			'0' => 'closed',
			'1' => 'setup',
			'2' => 'ready',
			'3' => 'open',
			'4' => 'over'
		);
		$scoop->desc = (isset($game_states[$state])) ? $game_states[$state] : "Unknown";

		// return it to the user
		$this->output
				->set_content_type('text/xml')
				->set_output($scoop->asXML());
	}

}
