<?php

class Index extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (isset($this->session->userdata('logged_in')->id_status) && $this->session->userdata('logged_in')->id_status == -1) {
            redirect('profile/account');
        }
    }

    public function index() {
        $data["user_profile"] = $this->session->userdata('logged_in');
        $data["scripts"] = array(
            base_url("assets/js/ajax-bootstrap-select.min.js"),
            base_url("assets/js/search.js")
        );
        $data["styles"] = array(base_url('assets/css/akijob.css'));
        $this->load->view("_inc/header", $data);
        $this->load->view("search");
        $this->load->view("_inc/footer");
    }

    public function pagseguro(){

        \PagSeguro\Library::initialize();
        \PagSeguro\Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
        \PagSeguro\Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");

        //For example, to configure the library dynamically:
        \PagSeguro\Configuration\Configure::setEnvironment('sandbox');//production or sandbox
        \PagSeguro\Configuration\Configure::setAccountCredentials(
            'versalius.it@gmail.com',
            'CCEACF42E2FE4820BFA08D1E9035D7A6'
        );
        \PagSeguro\Configuration\Configure::setCharset('UTF-8');// UTF-8 or ISO-8859-1
        $payment = new \PagSeguro\Domains\Requests\Payment();

        $payment->addItems()->withParameters(
            '0001',
            'Mensalidade Akijob',
            1,
            7.00
        );


        $payment->setCurrency("BRL");

        $this->load->model('Util_model', 'util');
        date_default_timezone_set('America/Sao_Paulo');
        $insert = array('hash' => $this->util->generateRandomString(10), "id_user" => 131, "modification_date" => date('Y-m-d H:i:s'));
        $this->db->insert("tb_payment_history", $insert);

        $payment->setReference($insert["hash"]);

        $payment->setRedirectUrl("http://www.lojamodelo.com.br");

        // Set your customer information.
        $payment->setSender()->setName('João Comprador');
        $payment->setSender()->setEmail('email@comprador.com.br');

        //Add items by parameter using an array
        $payment->addParameter()->withArray(['notificationURL', 'http://www.lojamodelo.com.br/nofitication']);

        $payment->setRedirectUrl("http://www.lojamodelo.com.br");
        $payment->setNotificationUrl("http://www.lojamodelo.com.br/nofitication");

        try {


            $code = $payment->register(
                \PagSeguro\Configuration\Configure::getAccountCredentials(),
                true
            );

        } catch (Exception $e) {
            die($e->getMessage());
        }

        $data = array('code' => $code->getCode() );
        $this->load->view("pagseguro", $data);
    }

    public function pag_notification(){

        \PagSeguro\Library::initialize();
        \PagSeguro\Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
        \PagSeguro\Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");
		\PagSeguro\Configuration\Configure::setEnvironment('sandbox');//production or sandbox
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

            $result = $this->db->get_where("tb_payment_history", array("hash" => $response->getReference()));
            if ($result->num_rows() == 1) {
                $result = $result->result()[0];
                date_default_timezone_set('America/Sao_Paulo');

                $this->db->where("id", $result->id);
                $this->db->update("tb_payment_history", array("modification_date" => date('Y-m-d H:i:s'), "id_status" => $response->getStatus()));
                if ($response->getStatus() == 3) {
                    $this->load->model('Subscription_model', 'subscription');
                    $this->subscription->insert($result->id_user);
                }
            }
			
        } catch (Exception $e) {
			$myfile = fopen("testfile.txt", "w");
			fwrite($myfile, $e->getMessage());
			fclose($myfile);
            die($e->getMessage());
        }
    }
}
