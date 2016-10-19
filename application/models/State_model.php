<?php

defined('BASEPATH') or exit('No direct script access allowed');

class State_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getStatesAll(){
        $query =  $this->db->get("tb_states");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }


    }
}
