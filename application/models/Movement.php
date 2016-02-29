<?php

/**
 * Class Movement
 *`
 * Model for the current game round stock movements
 * 
 */
class Movement extends MY_Model {

	public function __construct()
	{
		parent::__construct('movement','seq');
	}

}
