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

    function getUserLatLng($idUser) {
        $this->db->select('c.latitude, c.longitude');
        $this->db->from('tb_users u');
        $this->db->join('tb_city c', 'u.id_city = c.id', "inner");
        $this->db->where('u.id', $idUser);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

}
