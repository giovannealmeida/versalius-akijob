<?php

defined('BASEPATH') or exit('No direct script access allowed');

class City_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCityByState($id_state){
        $this->db->select('*');
        $this->db->from('tb_city');
        $this->db->where('id_state', $id_state);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }


    }
}
