<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * BSX Server - present the transactions for this round
 */
class Activity extends Application {

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
		$this->data['pagebody'] = 'translist';
		$this->data['transactions'] = $this->transactions->all();
		$this->render();
	}

}

