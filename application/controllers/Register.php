<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * BSX Server - register an agent
 */
class Register extends Application {

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
		// state check
		$state = $this->properties->get('state');
		if ($state != GAME_OPEN)
			if ($state != GAME_READY)
				$this->booboo('You can only register while the market is "ready" or "open".');

		// extract parameters
		$team = strtolower($this->input->post_get('team'));
		$name = $this->input->post_get('name');
		$password = $this->input->post_get('password');

		// existence testing
		if (empty($team))
			$this->booboo('Need a team to register');
		if (empty($name))
			$this->booboo('Your team needs a name');
		if (empty($password))
			$this->booboo("You cannot register without today's password");

		// verify these
		$set = substr($team, 0, 1);
		if (!in_array($set, array('b', 'g', 'o', 's')))
			$this->booboo('Unrecognized set');
		if (strlen($name) < 1)
			$this->booboo('You need a name');
		if ($password != $this->properties->get('potd'))
			$this->booboo('Incorrect password');

		// if they are already registered, confirm
		$agent = $this->users->get($team);
		if ($agent != null)
		{
			if ($agent->role != 'agent')
				$this->booboo('Nice try');
		} else
		{
			// so far, so good. add the agent
			$agent = $this->users->create();
			$agent->code = $team;
			$agent->name = $name;
			$agent->role = 'agent';
			$agent->password = md5($team . $name . time());
			$agent->last_round = $this->properties->get('round');

			$this->users->add((array) $agent);
		}
		$response = new SimpleXMLElement('<agent/>');
		$response->team = $agent->code;
		$response->token = $agent->password;
		$this->output
				->set_content_type('text/xml')
				->set_output($response->asXML());
	}

}
