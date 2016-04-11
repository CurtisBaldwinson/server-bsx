<?php

/**
 * Class Queue
 *`
 * Model for the upcoming stock movements for this round
 * 
 */
class Queue extends MY_Model {

	public function __construct()
	{
		parent::__construct('queue','seq');
	}

}
