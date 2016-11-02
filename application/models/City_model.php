<?php

defined('BASEPATH') or exit('No direct script access allowed');

class City_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getCityByState($id_state) {
        $this->db->where('id_state', $id_state);
        $query = $this->db->get("tb_city");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $city) {
                $return[$city->id] = $city->name;
            }
            return $return;
        } else {
            return null;
        }
    }

    public function getStateByCity($id_city) {
        $this->db->select('id_state');
        $this->db->from('tb_city');
        $this->db->where('id', $id_city);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array()[0]['id_state'];
        } else {
            return null;
        }
    }

    public function getCityById($idCity) {
        $this->db->where('id', $idCity);
        $query = $this->db->get("tb_city");
        if ($query->num_rows() > 0) {
            return $query->result()[0];
        } else {
            return null;
        }
    }

    public function getAll() {
        $query = $this->db->get("tb_city");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $city) {
                $return[$city->id] = $city->name;
            }
            return $return;
        } else {
            return null;
        }
    }

}
