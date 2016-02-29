<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * BSX Server - who is playing?
 */
class Gamers extends Application {

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
		$this->data['pagebody'] = 'playerlist';
		$this->data['players'] = $this->players->all();
		$this->render();
	}

}

