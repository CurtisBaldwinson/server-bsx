<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Botcards Trading Server - agents & users
 */
class Community extends Application {

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
		$this->data['pagebody'] = 'userlist';
		
		// extract agent info
		$users = $this->users->some('role', 'agent');
		foreach($users as $user) {
			$players = $this->players->some('agent',$user->code);
			$user->players = '';
			foreach ($players as $one)
				$user->players .= $one->player . ' ';
		}
		
		$this->data['users'] = $users;
		$this->render();
	}

}
