<?php

defined('BASEPATH') or exit('No direct script access allowed');

class State_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $query = $this->db->get("tb_states");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $gender) {
                $return[$gender->id] = $gender->name;
            }
            return $return;
        } else {
            return null;
        }
    }

    public function getStateByCity($id_city) {
        $this->db->select('s.id, s.name, s.initials');
        $this->db->from('tb_city c');
        $this->db->join('tb_states s', 's.id = c.id_state', "inner");
        $this->db->where('c.id', $id_city);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result()[0];
        } else {
            return null;
        }
    }

}
