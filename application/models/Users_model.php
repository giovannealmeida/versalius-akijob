<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUserLogin($email, $password, $idStatus){
        $response = $this->db->get_where('tb_users', array('email' => $email, 'id_status' => $idStatus));
        if ($response->num_rows() == 1) {
            $user = $response->result()[0];
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }

        return null;
    }
   

    public function getUserById($id)
    {
        $response = $this->db->get_where('tb_users', array('id' => $id));

        if ($response->num_rows() == 1) {
            return $response->result()[0];
        }

        return null;
    }

    public function getUserByService($idService)
    {
        $response = $this->db->get_where('tb_services', array('id' => $idService));

        if ($response->num_rows() == 1) {
            return $response->result()[0]->id_user;
        }

        return null;
    }

    // $type pode ser "facebook" ou "google"
    public function getUserExternalAuth($email, $id_social, $id_satus)
    {
        $this->db->where('email', $email);
        $this->db->where('id_social', $id_social);
        $this->db->where('id_status', $id_satus);
        $response = $this->db->get('tb_users');

        if ($response->num_rows() == 1) {
            return $response->result()[0];
        }

        return null;
    }

    public function insert($dados)
    {
        //print_r($dados);die;
        $query = $this->db->insert('tb_users', $dados);

        if ($this->db->affected_rows() == 1) {
            return $this->db->get_where('tb_users', array('id' => $this->db->insert_id()))->result()[0];
        }

        return null;
    }

    public function update($id_user, $data)
    {
        $this->db->where('id', $id_user);
        $this->db->update('tb_users', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

    public function validatePassword($id, $password)
    {
        $this->db->where('id', $id);
        $this->db->where('password', $password);

        $query = $this->db->get('tb_users');

        if (count($query->result()) > 0) {
            return true;
        }

        return false;
    }

    public function exists($email)
    {
        $response = $this->db->get_where('tb_users', array('email' => $email));

        if ($response->num_rows() == 1) {
            return $response->result()[0]->id;
        }

        return null;
    }

    public function forgot_password($hash)
    {
        $query = $this->db->query("SELECT id_user FROM tb_forgotten_password_hash WHERE TIMESTAMPDIFF(MINUTE,time,NOW()) < 80 AND hash = \"{$hash}\"");
        if ($query->num_rows() == 1) {
            return $query->result()[0]->id_user;
        }

        return false;
    }

    public function getTierImage($id, $recommendations)
    {
        if ($recommendations < 100) {
            return base_url('assets/img/crown-nothing.png');
        }
        if ($recommendations >= 100 && $recommendations <= 1000) {
            return base_url('assets/img/crown-bronze.png');
        } elseif ($recommendations > 1000 && $recommendations <= 5000) {
            return base_url('assets/img/crown-bronze.png');
        } elseif ($recommendations > 5000 && $recommendations < 10000) {
            return base_url('assets/img/crown-bronze.png');
        } elseif ($recommendations > 10000) {
            return base_url('assets/img/crown-bronze.png');
        }
    }
    
    public function excluir($idUser) {
        $this->db->delete('tb_users', array('id' => $idUser));

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }
}
