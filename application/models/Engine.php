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
	function check() {
		$state = $this->properties->get('state');
		
		$now = date(DATE_ATOM);
		$alarm = $this->properties->get('alarm');
		if ($now > $alarm) $this->gearChange($state);
		
		if ($state == GAME_OPEN) {
			// look for stock movement events
		}
	}
	
	// advance the game state
	function gearChange($state) {
		switch($state) {
			case GAME_CLOSED:
				// flush movement & transaction tables				
				break;
			case GAME_SETUP:
				// choose candidate stocks
				// generate movements
				// eliminate stale players or agents
				// reset starting cash & certificates
				break;
			case GAME_READY:
				// brief pause for commercials; nothing to do
				break;
			case GAME_OPEN:
				// check for stock splits
				// check for stock delistings
				break;
			case GAME_OVER:				
			default:
				// nothing to do but wait
				break;
		}
		
		// advance to the next state
		$next_alarm = time() + $this->config->item('state_countdowns') * 1000;
		$this->properties->set('alarm',date(DATE_ATOM,$next_alarm));
		$this->properties->set('state', ($state + 1 ) % GAME_OVER);
	}
}
