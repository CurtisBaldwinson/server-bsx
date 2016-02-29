<?php

/**
 * Class Certificates
 *
 * Model for the issued trading cards
 * 
 */
class Certificates extends MY_Model {

	public function __construct()
	{
		parent::__construct('certificates','token');
	}

}
