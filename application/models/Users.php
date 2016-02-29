<?php

/**
 * Class Users
 *
 * Model for our users (brokers) & admin
 * 
 */
class Users extends MY_Model {

	public function __construct()
	{
		parent::__construct('users','code');
	}

}
