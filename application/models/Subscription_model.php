<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Subscription_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

	public function isSubscribed(){
		// $this->db->where("");
	}

	public function insert($id_user, $id_plan, $period){
		$start = $this->getEndSubscription($id_user);
		if ($start == null) {
			$start = date("Y-m-d");
		}
		$period = $period == 1 ? "month" : "year";

		$end = date("Y-m-d", strtotime("+1 {$period}", strtotime($start)));

		$insert = array("id_user" => $id_user, "id_plan" => $id_plan, "start" => $start, "end" => $end );
		$this->db->insert("tb_subscriptions", $insert);
	}

	public function getEndSubscription($id_user){
		$this->db->order_by("end", "DESC");
		$query = $this->db->get_where("tb_subscriptions", array("id_user" => $id_user));

		if ($query->num_rows() > 0) {
			return $query->result()[0]->end;
		}

		return null;

	}

}
