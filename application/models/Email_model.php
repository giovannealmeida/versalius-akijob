<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Email_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_crypto'] = 'ssl';
        $config['smtp_host'] = 'br784.hostgator.com.br';
        $config['smtp_user'] = 'no-reply@akijob.com.br';
        $config['smtp_pass'] = 'vers@kijob';
        $config['smtp_port'] = '465';

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from('no-reply@akijob.com.br', 'AkiJob');
    }

    public function send($email)
    {
    }

    public function send_forgotten_password($email, $id)
    {
        date_default_timezone_set('America/Bahia');
        $hash = md5(uniqid(rand(), true));
        $time = date("Y-m-d H:i:s");
        $this->db->insert("tb_forgotten_password_hash", array("id_user"=>$id, "hash" => $hash, "time" => $time));

        $this->email->to($email);
        $this->email->subject('Email Test');
        $this->email->message(base_url("login/forgot_password/{$hash}"));

        $result = $this->email->send();
        if (!$result) {
            return false;
        }

        return true;
    }
}
