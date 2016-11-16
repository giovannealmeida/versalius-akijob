<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comments_model extends CI_Model {

     public function __construct() {
        parent::__construct();
    }
    
    function getCommentsByIdServices($idService, $offset) {
        $this->db->select('u.`name` as `user_name`, c.`comment` as `comment`');
        $this->db->join('tb_users as u', 'c.id_user = u.id', "inner");
        $this->db->where('c.id_service', $idService);
        if($offset == 0){ $query = $this->db->get('tb_comments as c', 5);}
        else{ $query = $this->db->get('tb_comments as c', 5, $offset);}
        if ($query->num_rows() > 0) {
            return $query->result();
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
