<?php

/**
 * Class Stocks
 *
 * Model for the Stocks managed on the exchange
 * 
 */
class Stocks extends MY_Model {

	public function __construct()
	{
		parent::__construct('stocks','code');
	}

}
