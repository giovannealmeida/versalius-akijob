<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Plans_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

	public function getAll(){
        $query = $this->db->get("tb_plans");
        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return null;

	}

	public function getById($id){
        $query = $this->db->get_where("tb_plans", array("id" => $id));
        if ($query->num_rows() == 1) {
            return $query->result()[0];
        }
        return null;
	}
}
