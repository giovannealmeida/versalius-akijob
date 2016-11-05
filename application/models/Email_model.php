<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Email_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_crypto'] = 'ssl';
        $config['smtp_host'] = 'br784.hostgator.com.br';
        $config['smtp_user'] = 'no-reply@akijob.com.br';
        $config['smtp_pass'] = 'vers@kijob';
        $config['smtp_port'] = '465';
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from('no-reply@akijob.com.br', 'AkiJob');
    }

    public function send($email) {
        
    }

    public function send_forgotten_password($email, $id) {
        date_default_timezone_set('America/Bahia');
        $data['hash'] = md5(uniqid(rand(), true));
        $time = date("Y-m-d H:i:s");
        $this->db->insert("tb_forgotten_password_hash", array("id_user" => $id, "hash" => $data['hash'], "time" => $time));
        $emailTemplate = $this->load->view("email_template", $data, TRUE);
        $this->email->to($email);
        $this->email->subject('[AKIJOB] Recuperar senha');
        $this->email->message($emailTemplate);

        $result = $this->email->send();
        if (!$result) {
            return false;
        }

        return true;
    }

}
