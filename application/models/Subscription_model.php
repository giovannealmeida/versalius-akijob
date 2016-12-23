<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Subscription_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function isSubscribed($user_id)
    {
        $today = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('tb_subscriptions');
        $this->db->where('user_id',$user_id);
        $this->db->where('start <=',$today);
        $this->db->where('end >=',$today);
        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function insert($user_id)
    {
        date_default_timezone_set('America/Sao_Paulo');

        $start = $this->getEndSubscription($user_id);
        if ($start == null) {
            $start = date('Y-m-d');
        }
        $period = 'month';

        $end = date('Y-m-d', strtotime("+1 {$period}", strtotime($start)));

        $insert = array('user_id' => $user_id, 'id_plan' => 1, 'start' => $start, 'end' => $end);
        $this->db->insert('tb_subscriptions', $insert);
    }

    public function getEndSubscription($user_id)
    {
        $this->db->order_by('end', 'DESC');
        $query = $this->db->get_where('tb_subscriptions', array('user_id' => $user_id));

        if ($query->num_rows() > 0) {
            return $query->result()[0]->end;
        }

        return null;
    }

    public function getPlanByUser($idUser)
    {
        $this->db->select('p.name, p.price_per_month, p.price_per_year, s.start, s.end');
        $this->db->from('tb_plans p');
        $this->db->join('tb_subscriptions s', 'p.id = s.id_plan', "inner");
        $this->db->where('s.user_id', $idUser);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return null;
    }

    public function redeem_code($hash, $user_id)
    {
        // Hash exists
        $this->db->where('hash', $hash);
        $query = $this->db->get('tb_subscriptions_hashes');
        if ($query->num_rows() != 1) {
            return false;
        }
        $hash_id = $query->result()[0]->id;

        // Hash used
        $this->db->where('h.id_hash', $hash_id);
        $query = $this->db->get('tb_subscriptions_hashes_history h');
        if ($query->num_rows() != 0) {
            return false;
        }

        date_default_timezone_set('America/Sao_Paulo');
        $used_date = date('Y-m-d H:i:s');

        $start = date('Y-m-d');
        $end = date('Y-m-d', strtotime("+1 month", strtotime($start)));
        $this->db->trans_start();

        $this->db->insert("tb_subscriptions", array("user_id" => $user_id, "id_plan" => 2, "start" => $start, "end" => $end));
        $this->db->insert("tb_subscriptions_hashes_history", array("user_id" => $user_id, "id_hash" => $hash_id, "used_date" => $used_date));

        $this->db->trans_complete();



        return true;
    }

    public function hash_used($hash)
    {

        if ($this->hash_exist($hash) == null) {
            return null;
        }



        return $this->hash_exist($hash);
    }

    public function hash_exist($hash)
    {

    }
}
