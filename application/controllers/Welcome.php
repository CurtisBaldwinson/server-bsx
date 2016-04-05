<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Botcards Trading Server - homepage
 */
class Welcome extends Application {

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
		$this->data['pagebody'] = 'dashboard';

		$result = '';
		foreach ($this->users->all() as $record)
		{
			if (strlen($result) > 0)
				$result .= ', ';
			if ($record->role == 'agent')
				$result .= $record->name;
		}
		if (strlen($result) === 0)
			$result = 'None';
		$this->data['theagents'] = $result;

		// show some summary stocks data
		$result = '';
		foreach ($this->stocks->all() as $record)
		{
			if (strlen($result) > 0)
				$result .= ', ';
			$result .= $record->code;
		}
		$this->data['thestocks'] = $result;

		$result = $this->certificates->size();
		$this->data['thecerts'] = $result;

		$result = '';
		$count = array();
		foreach ($this->movement->tail() as $record)
		{
			$result .= $this->parser->parse('1move',(array)$record,true);
		}
		$this->data['themoves'] = $result;

		$result = '';
		$count = array();
		foreach ($this->transactions->tail() as $record)
		{
			$result .= $this->parser->parse('1trans',(array)$record,true);
		}
		$this->data['thetrans'] = $result;

		$this->render();
	}

}
