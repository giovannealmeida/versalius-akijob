<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getUser($email, $password) {
        $response = $this->db->get_where('tb_users', array('email' => $email, 'password' => $password));

        if ($response->num_rows() == 1) {
            return $response->result()[0];
        }

        return null;
    }

    public function getUserById($id) {
        $response = $this->db->get_where('tb_users', array('id' => $id));

        if ($response->num_rows() == 1) {
            return $response->result()[0];
        }
        return null;
    }

    // $type pode ser "facebook" ou "google"
    public function getUserExternalAuth($email, $id, $type) {
        $this->db->where('email', $email);
        if ($type == 'facebook') {
            $this->db->where("id_facebook", $id);
        } elseif ($type == 'google') {
            $this->db->where("id_google", $id);
        } else {
            return null;
        }
        $response = $this->db->get('tb_users');

        if ($response->num_rows() == 1) {
            return $response->result()[0];
        }

        return null;
    }

    public function insert($dados) {
        $query = $this->db->insert("tb_users", $dados);

        if ($this->db->affected_rows() == 1) {
            return ($this->db->get_where("tb_users", $dados)->result()[0]);
        }

        return null;
    }

    public function update($id_user, $data) {
        $this->db->where('id', $id_user);
        $this->db->update('tb_users', $data);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }

        return FALSE;
    }

    public function validatePassword($id, $password) {
        $this->db->where('id', $id);
        $this->db->where('password', $password);

        $query = $this->db->get('tb_users');

        if (count($query->result()) > 0) {
            return TRUE;
        }

        return FALSE;
    }

    public function exists($email) {
        $response = $this->db->get_where('tb_users', array('email' => $email));

        if ($response->num_rows() == 1) {
            return $response->result()[0]->id;
        }

        return null;
    }

    public function forgot_password($hash){
        $query = $this->db->query("SELECT id_user FROM tb_forgotten_password_hash WHERE TIMESTAMPDIFF(MINUTE,time,NOW()) < 80 AND hash = \"{$hash}\"");
        if ($query->num_rows() == 1) {
            return $query->result()[0]->id_user;
        }
        return false;
    }
}
