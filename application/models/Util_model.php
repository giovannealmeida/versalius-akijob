<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Util_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

	public function generateRandomString($length = 10) {
	    $characters = '0123456789ABCDEFGHJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}
