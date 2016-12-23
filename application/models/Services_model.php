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
        $this->db->join('tb_city c', 'u.city_id = c.id', "inner");
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
            SELECT u.name as name, u.email, u.id as user_id, u.avatar, s.street, s.complement, s.number, s.neighborhood, s.id, s.zip_code, s.latitude, s.longitude, j.name as job, IFNULL(SUM(r.value),0) as saldo, ra.rating, IF(sub.id is null,0,1) as premium, s.`primary`
            FROM tb_services s
            LEFT JOIN tb_recommendation r ON r.user_receiver_id = s.user_id
            INNER JOIN tb_jobs j ON j.id = s.job_id
            INNER JOIN tb_users u ON u.id = s.user_id
            LEFT JOIN tb_subscriptions sub ON u.id = sub.user_id AND NOW() BETWEEN sub.`start` AND sub.`end`
            LEFT JOIN (SELECT service_id, SUM(`value`)/count(value) as rating FROM tb_rating GROUP BY user_receiver_id) AS ra ON s.id = ra.service_id
            LEFT JOIN tb_subscriptions p ON s.user_id = p.user_id
            WHERE s.job_id = {$idJob} AND s.city_id = {$idCity} AND u.ativo = 1
            GROUP BY s.user_id
            ORDER BY p.id IS NOT NULL DESC, saldo DESC, ra.rating DESC"
        );

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return NULL;
    }

    public function getServicesByUser($idUser) {
        $this->db->select('s.id, j.name as job');
        $this->db->from('tb_services s');
        $this->db->join('tb_jobs j', 's.job_id = j.id', "inner");
        $this->db->join('tb_city c', 's.city_id = c.id', "inner");
        $this->db->where('user_id', $idUser);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return NULL;
    }

    public function getServicesById($idService) {
        $query = $this->db->query("
            SELECT s.user_id, s.id, s.street, s.number, s.neighborhood, s.latitude, s.longitude, s.skills, j.name as job, c.name as city, st.name as state, ra.rating as saldo
            FROM tb_services s
            LEFT JOIN (SELECT service_id, SUM(`value`)/count(value) as rating FROM tb_rating GROUP BY user_receiver_id) AS ra ON s.id = ra.service_id
            INNER JOIN tb_jobs j ON j.id = s.job_id
            INNER JOIN tb_city c ON s.city_id = c.id
            INNER JOIN tb_states st ON c.state_id = st.id
            WHERE s.id = {$idService}"
        );
        if ($query->num_rows() > 0) {
            return $query->result()[0];
        }
        return NULL;
    }

    public function getServicesByIdAndUser($idUser, $idService) {
        $this->db->select('s.*, j.name as job');
        $this->db->from('tb_services s');
        $this->db->join('tb_jobs j', 's.job_id = j.id', "inner");
        $this->db->where('s.id', $idService);
        $this->db->where('s.user_id', $idUser);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result()[0];
        }
        return NULL;
    }

    public function getDifferentialByService($idService) {
        $this->db->select('differential_id');
        $this->db->from('tb_service_differential');
        $this->db->where('service_id', $idService);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            foreach ($result as $value) {
                $data[] = $value['differential_id'];
            }
            return $data;
        }
        return NULL;
    }

    public function getPortfoliosByUser($idUser) {
        $query = $this->db->get_where('tb_portfolios', array('user_id' => $idUser));

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return NULL;
    }

    public function getPortfoliosByService($idService) {
        $query = $this->db->get_where('tb_portfolios', array('service_id' => $idService));

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return NULL;
    }

    public function getPortfolioById($idPortfolio) {
        $query = $this->db->get_where('tb_portfolios', array('id' => $idPortfolio));

        if ($query->num_rows() > 0) {
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
        $result = $this->db->query("SELECT count(*) as quantidade FROM tb_services WHERE user_id = {$data["user_id"]}")->result()[0]->quantidade;

        if ($result == 0) {
            $data["primary"] = 1;
        }

        $this->db->insert('tb_services', $data);

        if ($this->db->affected_rows() > 0) {

            return true; // to the controller
        }

        return false;
    }

    public function insert_differential($data) {
        foreach ($data['differential_id'] as $value) {
            $this->db->insert('tb_service_differential', array('service_id' => $data['service_id'], 'differential_id' => $value));
        }

        if ($this->db->affected_rows() > 0) {

            return true; // to the controller
        }

        return false;
    }

    public function delete_differential($idService, $idDifferential) {
        $this->db->delete('tb_service_differential', array('service_id' => $idService, 'differential_id' => $idDifferential));

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

        $this->db->trans_start();

        $this->db->delete('tb_services', array('id' => $idService, 'user_id' => $idUser));

        if ($this->db->affected_rows() > 0) {
            $result = $this->db->query("SELECT count(*) as quantidade FROM tb_services WHERE user_id = {$idUser}")->result()[0]->quantidade;
            if ($result > 0) {
                $next = $this->db->limit(1)->get_where("tb_services", array("user_id" => $idUser))->result()[0]->id;
                $this->update($next, array("primary" => 1));
            }
            $this->db->trans_complete();

            return TRUE;
        }
        return FALSE;
    }

}
