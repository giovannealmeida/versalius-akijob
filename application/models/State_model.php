<?php

defined('BASEPATH') or exit('No direct script access allowed');

class State_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll(){
        $query =  $this->db->get("tb_states");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $gender) {
                $return[$gender->id] = $gender->name;
            }
            return $return;
        } else {
            return null;
        }
    }
}
