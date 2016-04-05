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

}
