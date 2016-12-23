<?php

class consult extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function getCityByState($state_id) {
        $this->load->model('City_model');
        $result = $this->City_model->getCityByState($state_id);
        echo json_encode($result);
    }

    public function getCityByName() {
        if ($this->input->post()) {
            $name = $this->input->post("q");
        }
        $this->db->select('c.id, s.initials, c.name');
        $this->db->like('c.name', $name);
        $this->db->join("tb_states s", "s.id = c.state_id");
        $result = $this->db->get("tb_city c")->result();
        $array = array();

        foreach ($result as $row) {
            $array[] = array("id" => $row->id, "initials" => $row->initials, "name" => $row->name);
        }

        print_r(json_encode($array));
    }

    public function getCityById($idCity) {
        $this->db->select('*');
        $this->db->from('tb_city');
        $this->db->where('id', $idCity);
        $query = $this->db->get();
        $array = array('lat' => $query->result()[0]->latitude, 'lng' => $query->result()[0]->longitude);

        print_r(json_encode($array));
    }

    public function getJobsByName() {
        if ($this->input->post()) {
            $name = $this->input->post("q");
            $this->db->like('name', $name);
            $result = $this->db->get("tb_jobs")->result();
            $array = array();
            foreach ($result as $row) {
                $array[] = array("id" => $row->id, "name" => $row->name);
            }

            print_r(json_encode($array));
        }else{
            show_404();
        }
    }

    public function getComments($idService, $x) {
        $this->load->model('Comments_model');
        //Definindo variaveis de inicio e fim para serem usadas como "limit" na consulta do mysql
        $offset = $x * 5;
        $this->load->model('City_model');
        $result = $this->Comments_model->getCommentsByIdServices($idService, $offset);
        echo json_encode($result);
    }

    public function insert_recommendation($id_user, $id_user_receiver, $value) {
        if (isset($this->session->userdata('logged_in')->id) && $this->session->userdata('logged_in')->id == $id_user) {
            $data = array("id_user" => $id_user, "id_user_receiver" => $id_user_receiver, "value" => $value);
            $this->db->where($data);
            $query = $this->db->get('tb_recommendation');
            if ($query->num_rows() > 0) {
                $this->db->delete('tb_recommendation', $data);
                echo 0;
            } else {
                $this->db->where("id_user", $id_user);
                $this->db->where("id_user_receiver", $id_user_receiver);
                $query = $this->db->get('tb_recommendation');
                if ($query->num_rows() > 0) {
                    $this->db->where('id_user', $id_user);
                    $this->db->where('id_user_receiver', $id_user_receiver);
                    $this->db->update('tb_recommendation', array("value" => $value));
                    echo 1;
                } else {
                    $this->db->insert("tb_recommendation", $data);
                    echo 2;
                }
            }
        } else {
            show_404();
        }
    }

    public function rating($id_user, $id_user_receiver, $id_service, $value) {
        if ($this->session->userdata('logged_in')->id == $id_user) {
            $data = array("id_user" => $id_user, "id_user_receiver" => $id_user_receiver, "id_service" => $id_service, "value" => $value);
            $this->db->where($data);
            $query = $this->db->get('tb_rating');
            if ($query->num_rows() > 0) {
                echo 0;
            } else {
                $this->db->where("id_user", $id_user);
                $this->db->where("id_user_receiver", $id_user_receiver);
                $this->db->where("id_service", $id_service);
                $query = $this->db->get('tb_rating');
                if ($query->num_rows() > 0) {
                    $this->db->where('id_user', $id_user);
                    $this->db->where('id_user_receiver', $id_user_receiver);
                    $this->db->where("id_service", $id_service);
                    $this->db->update('tb_rating', array("value" => $value));
                    echo 1;
                } else {
                    $this->db->insert("tb_rating", $data);
                    echo 2;
                }
            }
        } else {
            show_404();
        }
    }

}
