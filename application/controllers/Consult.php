<?php

class consult extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function getCityByState($id_state) {
        $this->load->model('City_model');
        $result = $this->City_model->getCityByState($id_state);
        echo json_encode($result);
    }

    public function getCityByName(){
        if ($this->input->post()) {
            $name = $this->input->post("q");
        }
        $this->db->select('c.id, s.initials, c.name');
        $this->db->like('c.name', $name);
        $this->db->join("tb_states s", "s.id = c.id_state");
        $result = $this->db->get("tb_city c")->result();
        $array = array( );

        foreach ($result as $row) {
            $array[] = array("id" => $row->id, "initials" => $row->initials, "name" => $row->name);
        }

        print_r(json_encode($array));
    }

    public function getJobsByName(){
        if ($this->input->post()) {
            $name = $this->input->post("q");
        }
        $this->db->like('name', $name);
        $result = $this->db->get("tb_jobs")->result();
        $array = array( );
        foreach ($result as $row) {
            $array[] = array("id" => $row->id, "name" => $row->name);
        }

        print_r(json_encode($array));
    }
}
