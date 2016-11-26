<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Visits_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
	
	public function insert($dados){
		$this->db->insert('tb_visits', $dados);
	}
	
	/*public function getAllVisitsByUser($idUser){
		return $this->db->query('SELECT COUNT(id_services) as visits FROM tb_visits WHERE id_user = '.$idUser)->result();
	}*/
	
	public function getVisitsByService($idService){
		return $this->db->query('SELECT COUNT(id_service) as visit_service FROM tb_visits WHERE id_service = '.$idService)->result();
	}
	
	public function getVisitDateByService($idService){
		return $this->db->query('SELECT visit_date FROM tb_visits WHERE id_service = '.$idService)->result();
	}
	
	public function getCountVisitDayByService($idService, $day){	
		return $this->db->query('SELECT count(visit_date) as count_visit_date FROM tb_visits WHERE id_service = '.$idService.' AND date(visit_date) = date("'.$day.'")')->result();
	}
	
	
}