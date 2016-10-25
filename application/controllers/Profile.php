<?php

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public function index()
    {
        $data["user_profile"] = $this->session->userdata('logged_in');
        $this->load->model("Subscription_model", "subs");
        $data["premium_data"]["isPremium"] = $this->subs->isSubscribed($data["user_profile"]->id);
        $data["premium_data"]["endSubscription"] = $this->subs->getEndSubscription($data["user_profile"]->id);
        $this->load->view("profile", $data);
    }
}
