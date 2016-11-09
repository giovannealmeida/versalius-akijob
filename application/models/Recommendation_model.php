<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Recommendation_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getRecommendation($idUser, $idUserReceiver) {
        $response = $this->db->get_where('tb_recommendation', array('id_user' => $idUser, 'id_user_receiver' => $idUserReceiver));
        if ($response->num_rows() == 1) {
            return $response->result()[0];
        }
        return FALSE;
    }

    public function delete_recommendation($data) {
        $this->db->delete('tb_recommendation', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public function insert_recommendation($data) {
        $query = $this->db->insert("tb_recommendation", $data);

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }

        return FALSE;
    }

    public function update_recommendation($data) {
        $this->db->update('tb_recommendation', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }

        return FALSE;
    }

    public function getRecommendationPositiveByUser($idUserReceiver) {
        $response = $this->db->get_where('tb_recommendation', array('id_user_receiver' => $idUserReceiver, 'id_type_recommendation' => 1));
        if ($response->num_rows() == 1) {
            return count($response->result_array());
        }
        return 0;
    }

    public function getRecommendationNegativeByUser($idUserReceiver) {
        $response = $this->db->get_where('tb_recommendation', array('id_user_receiver' => $idUserReceiver, 'id_type_recommendation' => -1));
        if ($response->num_rows() == 1) {
            return count($response->result_array());
        }
        return 0;
    }

    public function getRecommendationByUser($idUserReceiver) {
        $positive = $this->db->get_where('tb_recommendation', array('id_user_receiver' => $idUserReceiver, 'id_type_recommendation' => 1));
        $negative = $this->db->get_where('tb_recommendation', array('id_user_receiver' => $idUserReceiver, 'id_type_recommendation' => -1));
        return count($positive->result_array()) - count($negative->result_array());
    }

}
