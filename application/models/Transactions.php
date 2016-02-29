<?php

/**
 * Class Transactions
 *`
 * Model for the transactions for the current game round
 * 
 */
class Transactions extends MY_Model {

	public function __construct()
	{
		parent::__construct('transactions','seq');
	}

}
