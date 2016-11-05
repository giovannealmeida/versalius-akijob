<?php

class Subscribe extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('_inc/header');
        $this->load->view('subscribe');
        $this->load->view('_inc/footer');
    }

    public function plan($id, $period)
    {
        if ($id != 1) {
            redirect('subscribe');
        } elseif (!$this->session->userdata('logged_in')) {
            redirect('register');
        } else {
            $id_user = $this->session->userdata('logged_in')->id;
        }
        $this->load->model('Plans_model', 'plans');
        $this->load->model('Subscription_model', 'subscription');
        $plan_info = $this->plans->getById($id);
        if ($plan_info == null) {
            show_404();
        }
        $data['styles'] = array(base_url('assets/css/style.css'));
        $this->subscription->insert($id_user, $id, $period);
        redirect("profile/plan", $data);
    }

    public function redeem($hash = "")
    {
        if ($hash == '') {
            if ($this->input->post()) {
                $hash = $this->input->post('code');
            } else {
                redirect('subscribe');
            }
        }

        if (!$this->session->userdata('logged_in')) {
            redirect('register');
        } else {
            $id_user = $this->session->userdata('logged_in')->id;
        }

        $this->load->model('Subscription_model', 'subscription');
        if ($this->subscription->redeem_code($hash, $id_user) != null) {
            // $this->session->set_flashdata("code_redeem", "sucess");
            die("TA SHOW");
        } else {
            // $this->session->set_flashdata("code_redeem", "fail");

            die("Deu ruim");

        }




    }

    // public function generate_hash()
    // {
    //     $this->load->model('Util_model', 'util');
    //
    //     for ($i = 0; $i < 30; ++$i) {
    //         $batch[] = array('hash' => $this->util->generateRandomString(6));
    //     }
    //
    //     $this->db->insert_batch("tb_subscriptions_hashes", $batch);
    // }
}
