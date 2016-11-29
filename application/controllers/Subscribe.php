<?php

class Subscribe extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (isset($this->session->userdata('logged_in')->id_status) && $this->session->userdata('logged_in')->id_status == -1) {
            redirect('profile/account');
        }
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            \PagSeguro\Library::initialize();
            \PagSeguro\Library::cmsVersion()->setName('Nome')->setRelease('1.0.0');
            \PagSeguro\Library::moduleVersion()->setName('Nome')->setRelease('1.0.0');

            //For example, to configure the library dynamically:
            \PagSeguro\Configuration\Configure::setEnvironment('sandbox'); //production or sandbox
            \PagSeguro\Configuration\Configure::setAccountCredentials(
                'versalius.it@gmail.com',
                'CCEACF42E2FE4820BFA08D1E9035D7A6'
            );
            \PagSeguro\Configuration\Configure::setCharset('UTF-8'); // UTF-8 or ISO-8859-1
            $payment = new \PagSeguro\Domains\Requests\Payment();

            $payment->addItems()->withParameters(
                '0001',
                'Mensalidade Akijob',
                1,
                7.00
            );

            $payment->setCurrency('BRL');

            $this->load->model('Util_model', 'util');
            date_default_timezone_set('America/Sao_Paulo');
            $insert = array('hash' => $this->util->generateRandomString(10), 'id_user' => $this->session->userdata('logged_in')->id, 'modification_date' => date('Y-m-d H:i:s'));
            $this->db->insert('tb_payment_history', $insert);

            $payment->setReference($insert['hash']);

            $payment->setRedirectUrl(base_url('profile'));
            $payment->setNotificationUrl(base_url('subscribe/pagseguro_listener'));

            try {
                $code = $payment->register(
                    \PagSeguro\Configuration\Configure::getAccountCredentials(),
                    true
                );
            } catch (Exception $e) {
                die($e->getMessage());
            }

            $data = array('code' => $code->getCode());
        }

        $data['styles'] = array(base_url('assets/css/price-table.css'));

        $this->load->view('_inc/header', $data);
        $this->load->view('subscribe');
        $this->load->view('_inc/footer');
    }

    public function confirm()
    {
        $this->load->model('Plans_model', 'plans');
        $this->load->model('Subscription_model', 'subscription');
        $this->subscription->insert($this->session->userdata('logged_in')->id);
        redirect('profile/plan');
    }

    public function redeem($hash = '')
    {
        if ($hash == '') {
            if ($this->input->post()) {
                $hash = $this->input->post('code');
            } else {
                // redirect('subscribe');
            }
        }

        if (!$this->session->userdata('logged_in')) {
            redirect('register');
        } else {
            $id_user = $this->session->userdata('logged_in')->id;
        }

        $this->load->model('Subscription_model', 'subscription');
        if ($this->subscription->redeem_code($hash, $id_user) != null) {
            $this->session->set_flashdata('code_redeem', 'success');
        } else {
            $this->session->set_flashdata('code_redeem', 'fail');
        }

        redirect('profile/plan');
    }

    public function pagseguro_listener()
    {
        \PagSeguro\Library::initialize();
        \PagSeguro\Library::cmsVersion()->setName('Nome')->setRelease('1.0.0');
        \PagSeguro\Library::moduleVersion()->setName('Nome')->setRelease('1.0.0');
        \PagSeguro\Configuration\Configure::setEnvironment('sandbox'); //production or sandbox
        \PagSeguro\Configuration\Configure::setAccountCredentials(
            'versalius.it@gmail.com',
            'CCEACF42E2FE4820BFA08D1E9035D7A6'
        );

        try {
            if (\PagSeguro\Helpers\Xhr::hasPost()) {
                $response = \PagSeguro\Services\Transactions\Notification::check(
                    \PagSeguro\Configuration\Configure::getAccountCredentials()
                );
            } else {
                throw new \InvalidArgumentException($_POST);
            }

            //file_put_contents('filename.txt', print_r($response, true));
            // $myfile = fopen("testfile.txt", "w");
            // fwrite($myfile, print_r($response, true));
            // fclose($myfile);

            $result = $this->db->get_where('tb_payment_history', array('hash' => $response->getReference()));
            if ($result->num_rows() == 1) {
                $result = $result->result()[0];
                date_default_timezone_set('America/Sao_Paulo');

                $this->db->where('id', $result->id);
                $this->db->update('tb_payment_history', array('modification_date' => date('Y-m-d H:i:s'), 'id_status' => $response->getStatus()));
                if ($response->getStatus() == 3) {
                    $this->load->model('Subscription_model', 'subscription');
                    $this->subscription->insert($result->id_user);
                }
            }
        } catch (Exception $e) {
            // $myfile = fopen("testfile.txt", "w");
            // fwrite($myfile, $e->getMessage());
            // fclose($myfile);
            die($e->getMessage());
        }
    }
    // public function generate_hash()
    // {
    //     $this->load->model('Util_model', 'util');

    //     for ($i = 0; $i < 30; ++$i) {
    //         $batch[] = array('hash' => $this->util->generateRandomString(6));
    //     }

    //     $this->db->insert_batch("tb_subscriptions_hashes", $batch);
    // }
}
