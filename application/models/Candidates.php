<?php

/**
 * Class Stocks
 *
 * Model for the Stocks that could be managed on the exchange
 * 
 */
class Candidates extends MY_Model {

	public function __construct()
	{
		parent::__construct('candidates','code');
	}

}
