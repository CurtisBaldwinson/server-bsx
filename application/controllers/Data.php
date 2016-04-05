<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * BSX Server - return data for agents
 */
class Data extends Application {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Default entry point - shouldn't be used
	 */
	function index()
	{
		$parms = array(
			array('datum'=>'stocks'),
			array('datum'=>'movement'),
			array('datum'=>'transactions'),
		);
		$this->data['available'] = $parms;
		$this->data['pagebody'] = 'dataview';
		$this->render();
	}
	
	// return the stocks for the current round
	function stocks() {
		$this->load->dbutil();
		$records = $this->stocks->results();
		echo $this->dbutil->csv_from_result($records);
	}

	// return the movement for the current round
	function movement() {
		$this->load->dbutil();
		$records = $this->movement->results();
		echo $this->dbutil->csv_from_result($records);
	}

	// return the transactions for the current round
	function transactions() {
		$this->load->dbutil();
		$records = $this->transactions->results();
		echo $this->dbutil->csv_from_result($records);
	}

}

