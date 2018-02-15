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

    public function getRecommendationPositiveByUser($idUserReceiver) {
        $response = $this->db->get_where('tb_recommendation', array('id_user_receiver' => $idUserReceiver, 'value' => 1));
        return count($response->result_array());
    }

    public function getRecommendationNegativeByUser($idUserReceiver) {
        $response = $this->db->get_where('tb_recommendation', array('id_user_receiver' => $idUserReceiver, 'value' => -1));
        return count($response->result_array());
    }

    public function getRecommendationByUser($idUserReceiver) {
        $query = $this->db->query("SELECT IFNULL(SUM(r.`value`),0) as saldo FROM tb_recommendation r where id_user_receiver ={$idUserReceiver}");
        if (count($query->result()) > 0) {
            return $query->result()[0]->saldo;
        }
        return NULL;
    }

}
