<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * BSX Server - Present the deck of stocks we are playing with
 */
class Deck extends Application {

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
		$this->data['pagebody'] = 'stocklist';
		$this->data['stocks'] = $this->stocks->all();
		$this->render();
	}

	// Show the history fpr a stock
	function show($code)
	{
		$this->data['stocks'] = array($this->stocks->get($code));
		
		$result = '';
		$count = array();
		foreach ($this->movement->some('code',$code) as $record)
		{
			$result .= $this->parser->parse('1move', (array) $record, true);
		}
		$this->data['themoves'] = $result;

		$result = '';
		$count = array();
		foreach ($this->transactions->some('stock',$code) as $record)
		{
			$result .= $this->parser->parse('1trans', (array) $record, true);
		}
		$this->data['thetrans'] = $result;

		$this->data['pagebody'] = 'stockdetails';
		$this->render();
	}

}
