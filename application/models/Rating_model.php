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

}
