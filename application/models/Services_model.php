<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Services_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getJobsAll() {
        $query = $this->db->get("tb_jobs");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $gender) {
                $return[$gender->id] = $gender->name;
            }
            return $return;
        } else {
            return null;
        }
    }

    function getUserLatLng($idUser) {
        $this->db->select('c.latitude, c.longitude');
        $this->db->from('tb_users u');
        $this->db->join('tb_city c', 'u.id_city = c.id', "inner");
        $this->db->where('u.id', $idUser);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result()[0];
        } else {
            return null;
        }
    }

    public function getServicesByIdByCity($idJob, $idCity) {
        /*$this->db->select('u.name, u.email, s.street, s.number, s.neighborhood, s.complement, s.zip_code, s.latitude, s.longitude, s.note, j.name as job');
        $this->db->from('tb_users u');
        $this->db->join('tb_services s', 'u.id = s.id_user', "inner");
        $this->db->join('tb_jobs j', 'j.id = s.id_job', "inner");
        $this->db->where('s.id_job', $idJob);
        $this->db->where('s.id_city', $idCity);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }*/
        //Query de results aqui
        
    }

    public function getServicesByUser($idUser) {
        $this->db->select('s.id, s.note, j.name as job');
        $this->db->from('tb_services s');
        $this->db->join('tb_jobs j', 's.id_job = j.id', "inner");
        $this->db->join('tb_city c', 's.id_city = c.id', "inner");
        $this->db->where('id_user', $idUser);
        $query = $this->db->get();

        if (count($query->result()) > 0) {
            return $query->result();
        }
        return NULL;
    }

    public function getServicesById($idService) {
        $query = $this->db->get_where('tb_services', array('id' => $idService));

        if (count($query->result()) > 0) {
            return $query->result()[0];
        }
        return NULL;
    }

    public function getServicesByIdAndUser($idUser, $idService) {
        $query = $this->db->get_where('tb_services', array('id' => $idService, 'id_user' => $idUser));

        if (count($query->result()) > 0) {
            return $query->result()[0];
        }
        return NULL;
    }

    public function getPortfoliosByUser($idUser) {
        $query = $this->db->get_where('tb_portfolios', array('id_user' => $idUser));

        if (count($query->result()) > 0) {
            return $query->result();
        }
        return NULL;
    }

    public function insert($data) {
        $this->db->insert('tb_services', $data);

        if ($this->db->affected_rows() > 0) {

            return true; // to the controller
        }

        return false;
    }

    public function update($idService, $data) {
        $this->db->where('id', $idService);
        $this->db->update('tb_services', $data);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }

        return FALSE;
    }

    public function delete($idUser, $idService) {
        $this->db->delete('tb_services', array('id' => $idService, 'id_user' => $idUser));

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

}
