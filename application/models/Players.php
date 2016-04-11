<?php

/**
 * Class Players
 *
 * Model for the players active for an agent
 * 
 */
class Players extends MY_Model {

	public function __construct()
	{
		parent::__construct('players', 'seq');
	}

	// find a specific player
	function find($agent, $player)
	{
		foreach ($this->all() as $record)
			if ($record->agent == $agent)
				if ($record->player == $player)
					return $record;
		return null; // not there
	}

}
