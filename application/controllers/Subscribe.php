<?php

class Subscribe extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('subscribe');
    }

    public function plan($id, $period)
    {
        if ($id == '') {
            redirect('subscribe');
        }elseif (!$this->session->userdata('logged_in')) {
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
		$this->subscription->insert($id_user, $id, $period);

    }
}
