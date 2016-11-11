<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rating_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getRating($idUser, $idUserReceiver, $idService) {
        $response = $this->db->get_where('tb_rating', array('id_user' => $idUser, 'id_user_receiver' => $idUserReceiver, 'id_service' => $idService));
        if ($response->num_rows() == 1) {
            return $response->result()[0];
        }
        return FALSE;
    }

    public function insert_rating($data) {
        $query = $this->db->insert("tb_rating", $data);

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }

        return FALSE;
    }

    public function update_rating($data) {
        $this->db->where('id_user', $data['id_user']);
        $this->db->where('id_user_receiver', $data['id_user_receiver']);
        $this->db->update('tb_rating', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }

        return FALSE;
    }

}
