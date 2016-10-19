<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register_service_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getJobsAll(){
        $query =  $this->db->get("tb_jobs");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }


    }
}
