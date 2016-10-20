<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register_service_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getJobsAll() {
        $query = $this->db->get("tb_jobs");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function insertServices($data) {
        $this->db->insert('tb_services', $data);

        if ($this->db->affected_rows() > 0) {

            return true; // to the controller
        }

        return false;
    }
    
    function insertServicesJobs($data) {
        $this->db->insert('tb_services_jobs', $data);

        if ($this->db->affected_rows() > 0) {

            return true; // to the controller
        }

        return false;
    }

}
