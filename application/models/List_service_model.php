<?php

defined('BASEPATH') or exit('No direct script access allowed');

class List_service_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getServicesAll() {
        $this->db->select('*');
        $this->db->from('tb_users u');
        $this->db->join('tb_services s', 'u.id = s.id_user', "inner");
        $this->db->join('tb_services_jobs', 'u.id = s.id_user');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

}
