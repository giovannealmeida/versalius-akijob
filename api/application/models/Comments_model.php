<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Comments_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getCommentsByIdServices($idService, $offset) {
        $this->db->select('u.avatar as avatar, u.name as user_name, c.comment as comment, c.current_date as current_date');
        $this->db->join('tb_users as u', 'c.id_user = u.id', "inner");
        $this->db->where('c.id_service', $idService);
        $this->db->order_by("current_date", "desc"); 
        if ($offset == 0) {
            $query = $this->db->get('tb_comments as c', 5);
        } else {
            $query = $this->db->get('tb_comments as c', 5, $offset);
        }

        if ($query->num_rows() > 0) {
            $query = $query->result();
            for ((int) $i = 0; $i < count($query); $i++) {
                $query[$i]->current_date = date(' d/m/Y - H:i',strtotime($query[$i]->current_date));
                if ($query[$i]->avatar === NULL):
                    $query[$i]->avatar = '//placehold.it/200';
                elseif (!($query[$i]->avatar == base64_decode(base64_encode(stripslashes($query[$i]->avatar))))):
                    $query[$i]->avatar = 'data:image/jpeg;base64,' . base64_encode(stripslashes($query[$i]->avatar));
                endif;
            }
            return $query;
        } else {
            return null;
        }
    }

    public function insert($data) {
        $this->db->insert('tb_comments', $data);

        if ($this->db->affected_rows() > 0) {

            return true;
        }

        return false;
    }

}
