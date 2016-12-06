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
            SELECT u.name as name, u.email, u.id as id_user, u.avatar, s.street, s.complement, s.number, s.neighborhood, s.id, s.zip_code, s.latitude, s.longitude, j.name as job, IFNULL(SUM(r.value),0) as saldo, ra.rating, IF(sub.id is null,0,1) as premium, s.`primary`
            FROM tb_services s
            LEFT JOIN tb_recommendation r ON r.id_user_receiver = s.id_user
            INNER JOIN tb_jobs j ON j.id = s.id_job
            INNER JOIN tb_users u ON u.id = s.id_user
            LEFT JOIN tb_subscriptions sub ON u.id = sub.id_user AND NOW() BETWEEN sub.`start` AND sub.`end`
            LEFT JOIN (SELECT id_service, SUM(`value`)/count(value) as rating FROM tb_rating GROUP BY id_user_receiver) AS ra ON s.id = ra.id_service
            LEFT JOIN tb_subscriptions p ON s.id_user = p.id_user
            WHERE s.id_job = {$idJob} AND s.id_city = {$idCity} AND u.id_status = 1
            GROUP BY s.id_user
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
        $this->db->join('tb_jobs j', 's.id_job = j.id', "inner");
        $this->db->join('tb_city c', 's.id_city = c.id', "inner");
        $this->db->where('id_user', $idUser);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return NULL;
    }

    public function getServicesById($idService) {
        $query = $this->db->query("
            SELECT s.id_user, s.id, s.street, s.number, s.neighborhood, s.latitude, s.longitude, s.skills, j.name as job, c.name as city, st.name as state, ra.rating as saldo
            FROM tb_services s
            LEFT JOIN (SELECT id_service, SUM(`value`)/count(value) as rating FROM tb_rating GROUP BY id_user_receiver) AS ra ON s.id = ra.id_service
            INNER JOIN tb_jobs j ON j.id = s.id_job
            INNER JOIN tb_city c ON s.id_city = c.id
            INNER JOIN tb_states st ON c.id_state = st.id
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
        $this->db->join('tb_jobs j', 's.id_job = j.id', "inner");
        $this->db->where('s.id', $idService);
        $this->db->where('s.id_user', $idUser);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result()[0];
        }
        return NULL;
    }

    public function getDifferentialByService($idService) {
        $this->db->select('id_differential');
        $this->db->from('tb_service_differential');
        $this->db->where('id_service', $idService);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            foreach ($result as $value) {
                $data[] = $value['id_differential'];
            }
            return $data;
        }
        return NULL;
    }

    public function getPortfoliosByUser($idUser) {
        $query = $this->db->get_where('tb_portfolios', array('id_user' => $idUser));

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return NULL;
    }

    public function getPortfoliosByService($idService) {
        $query = $this->db->get_where('tb_portfolios', array('id_service' => $idService));

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
        $result = $this->db->query("SELECT count(*) as quantidade FROM tb_services WHERE id_user = {$data["id_user"]}")->result()[0]->quantidade;

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
        foreach ($data['id_differential'] as $value) {
            $this->db->insert('tb_service_differential', array('id_service' => $data['id_service'], 'id_differential' => $value));
        }

        if ($this->db->affected_rows() > 0) {

            return true; // to the controller
        }

        return false;
    }

    public function delete_differential($idService, $idDifferential) {
        $this->db->delete('tb_service_differential', array('id_service' => $idService, 'id_differential' => $idDifferential));

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

        $this->db->delete('tb_services', array('id' => $idService, 'id_user' => $idUser));

        if ($this->db->affected_rows() > 0) {
            $result = $this->db->query("SELECT count(*) as quantidade FROM tb_services WHERE id_user = {$idUser}")->result()[0]->quantidade;
            if ($result > 0) {
                $next = $this->db->limit(1)->get_where("tb_services", array("id_user" => $idUser))->result()[0]->id;
                $this->update($next, array("primary" => 1));
            }
            $this->db->trans_complete();

            return TRUE;
        }
        return FALSE;
    }

}
