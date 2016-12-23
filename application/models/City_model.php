<?php

defined('BASEPATH') or exit('No direct script access allowed');

class City_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getCityByState($state_id) {
        $this->db->where('state_id', $state_id);
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

    public function getAllWithStateInitials() {
        $this->db->select('c.id, c.name, s.initials');
        $this->db->from('tb_city c');
        $this->db->join('tb_states s', 's.id = c.state_id', "inner");

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $city) {
                $return[$city->id] = $city->name . ' - ' . $city->initials;
            }
            return $return;
        } else {
            return null;
        }
    }

    public function getIdByNameAndState($city, $initials) {
        $this->db->select('c.id');
        $this->db->from('tb_city c');
        $this->db->join('tb_states s', 's.id = c.state_id', "inner");
        $this->db->where('c.name', $city);
        $this->db->where('s.initials', $initials);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result()[0]->id;
        } else {
            return null;
        }
    }

}
