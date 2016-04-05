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
			array('datum' => 'stocks'),
			array('datum' => 'movement'),
			array('datum' => 'transactions'),
		);
		$this->data['available'] = $parms;
		$this->data['pagebody'] = 'dataview';
		$this->render();
	}

	// return the stocks for the current round,or just 1
	function stocks($code = null)
	{
		$this->load->dbutil();
		if ($code == null)
			$records = $this->stocks->results();
		else
			$records = $this->stocks->just1($code);
		echo $this->dbutil->csv_from_result($records);
	}

	// return the movement for the current round
	// optionally just return the tail
	function movement($limit = 0)
	{
		$this->load->dbutil();
		if ($limit < 1)
			$records = $this->movement->results();
		else
			$records = $this->movement->trailing($limit);
		echo $this->dbutil->csv_from_result($records);
	}

	// return the transactions for the current round
	function transactions($limit = 0)
	{
		$this->load->dbutil();
		if ($limit < 1)
			$records = $this->transactions->results();
		else
			$records = $this->transactions->trailing($limit);
		echo $this->dbutil->csv_from_result($records);
	}

}
