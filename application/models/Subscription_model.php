<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Subscription_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function isSubscribed($id_user)
    {
        $today = date('Y-m-d'); ;
        $this->db->select('*');
        $this->db->from('tb_subscriptions');
        $this->db->where('id_user',$id_user);
        $this->db->where('start <=',$today);
        $this->db->where('end >=',$today);
        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function insert($id_user, $id_plan, $period)
    {
        $start = $this->getEndSubscription($id_user);
        if ($start == null) {
            $start = date('Y-m-d');
        }
        $period = $period == 1 ? 'month' : 'year';

        $end = date('Y-m-d', strtotime("+1 {$period}", strtotime($start)));

        $insert = array('id_user' => $id_user, 'id_plan' => $id_plan, 'start' => $start, 'end' => $end);
        $this->db->insert('tb_subscriptions', $insert);
    }

    public function getEndSubscription($id_user)
    {
        $this->db->order_by('end', 'DESC');
        $query = $this->db->get_where('tb_subscriptions', array('id_user' => $id_user));

        if ($query->num_rows() > 0) {
            return $query->result()[0]->end;
        }

        return null;
    }

    public function redeem_code($hash, $id_user)
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

        $this->db->insert("tb_subscriptions", array("id_user" => $id_user, "id_plan" => 2, "start" => $start, "end" => $end));
        $this->db->insert("tb_subscriptions_hashes_history", array("id_user" => $id_user, "id_hash" => $hash_id, "used_date" => $used_date));

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
