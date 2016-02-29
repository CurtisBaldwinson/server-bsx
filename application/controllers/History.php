<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * BSX Server - present the stock movement for this round
 */
class History extends Application {

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
		$this->data['pagebody'] = 'movelist';
		$this->data['movement'] = $this->movement->all();
		$this->render();
	}

}

