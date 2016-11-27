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
        $query = $this->db->query("
            SELECT u.name as name, u.email, u.id as id_user, s.street, s.complement, s.number, s.neighborhood, s.id, s.zip_code, s.latitude, s.longitude, j.name as job, IFNULL(SUM(r.value),0) as saldo, ra.rating
            FROM tb_services s
            LEFT JOIN tb_recommendation r ON r.id_user_receiver = s.id_user
            INNER JOIN tb_jobs j ON j.id = s.id_job
            INNER JOIN tb_users u ON u.id = s.id_user
            LEFT JOIN (SELECT id_service, SUM(`value`)/count(value) as rating FROM tb_rating GROUP BY id_user_receiver) AS ra ON s.id = ra.id_service
            WHERE s.id_job = {$idJob} AND s.id_city = {$idCity} AND u.id_status = 1
            GROUP BY s.id_user");

        if (count($query->result()) > 0) {
            return $query->result();
        }
        return NULL;
    }

    public function getServicesByUser($idUser) {
        $this->db->select('s.id, j.name as job');
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
        $this->db->select('s.id_user, s.id, s.street, s.number, s.neighborhood, s.latitude, s.longitude, s.skills, s.availability_fds, s.availability_24h, j.name as job, c.name as city, st.name as state, IFNULL(SUM(r.`value`)/count(r.value),0) as saldo');
        $this->db->from('tb_services s');
        $this->db->join('tb_jobs j', 's.id_job = j.id', "inner");
        $this->db->join('tb_city c', 's.id_city = c.id', "inner");
        $this->db->join('tb_states st', 'c.id_state = st.id', "inner");
        $this->db->join('tb_rating r', 'r.id_service = s.id', "left");
        $this->db->where('s.id', $idService);
        $query = $this->db->get();

        if (count($query->result()) > 0) {
            return $query->result()[0];
        }
        return NULL;
    }

    public function getServicesByIdAndUser($idUser, $idService) {
        $this->db->select('s.*, j.name as job');
        $this->db->from('tb_services s');
        $this->db->join('tb_jobs j', 's.id_job = j.id', "inner");
        $this->db->where('s.id', $idService);
        $this->db->where('s.id_user', $idUser);
        $query = $this->db->get();

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

    public function getPortfolioById($idPortfolio) {
        $query = $this->db->get_where('tb_portfolios', array('id' => $idPortfolio));

        if (count($query->result()) > 0) {
            return $query->result()[0];
        }
        return NULL;
    }

    public function insertPortfolio($data) {
        $this->db->insert('tb_portfolios', $data);

        if ($this->db->affected_rows() > 0) {

            return true; // to the controller
        }

        return false;
    }

    public function updatePortfolio($idPortfolio, $data) {
        $this->db->where('id', $idPortfolio);
        $this->db->update('tb_portfolios', $data);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }

        return FALSE;
    }

    public function deletePortfolio($idPortfolio) {
        $this->db->delete('tb_portfolios', array('id' => $idPortfolio));

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
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
