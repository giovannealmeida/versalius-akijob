<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

		$this->facebook = new Facebook\Facebook([
		  'app_id' => '1330791536954247',
		  'app_secret' => '71ba607dfdc732389a7cc46a6ee209d8',
		  'default_graph_version' => 'v2.5',
		]);
		$this->load->library("googleplus");

    }

	public function index()
	{

		$helper = $this->facebook->getRedirectLoginHelper();
		$permissions = ['public_profile ', 'user_likes', 'user_location', 'user_birthday', 'email'];
		$data['login_url_facebook'] = $helper->getLoginUrl('http://localhost/akijob/index.php/login/callback_facebook', $permissions);
		$data['login_url_google'] = $this->googleplus->loginURL();

        $this->load->view('login', $data);

	}

	public function callback_google(){
		if (isset($_GET['code'])) {

			$this->googleplus->getAuthenticate();
			$this->session->set_userdata('user_profile',$this->googleplus->getUserInfo());
			$this->session->set_userdata("login", "google");
			$this->session->set_userdata("authenticated", true);
			redirect('login/profile');

		}
	}

	public function callback_facebook(){
		$helper = $this->facebook->getRedirectLoginHelper();
		try {
		  $accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

		if (isset($accessToken)) {
		  // Logged in!
		  $_SESSION['facebook_access_token'] = (string) $accessToken;
		  $this->session->set_userdata("login", "facebook");
		  $this->session->set_userdata("authenticated", true);

		  redirect(base_url()."index.php/login/profile");
	  } else {
		  die("NOT LOGGED");
	  }
	}

	public function profile(){
		$data = array();

		if (!$this->session->userdata("authenticated")) {
			redirect();
		}else {
			if ($this->session->userdata("login") == "google") {
				$aux = $this->session->userdata("user_profile");
				$data["user_profile"] = array(
					'email' => $aux["email"],
					"name" => $aux["name"],
					"id_auth" => $aux["id"],
					"link_rede" => $aux["link"],
					"gender" => $aux["gender"],
					"picture" => $aux["picture"]
				);
			} elseif ($this->session->userdata("login") == "facebook") {
				$this->facebook->setDefaultAccessToken($this->session->userdata("facebook_access_token"));

				try {
				  $response = $this->facebook->get('/me?fields=name,gender,birthday,location,email');

				  $aux = $response->getGraphUser();
				  $data["user_profile"] = array(
					  "name" => $aux->getName(),
					  "email" => $aux->getEmail(),
					  "id_auth" => $aux->getId(),
					  "link_rede" => $aux->getLink() ,
					  "gender" => $aux->getGender(),
					  "birthday" => $aux->getBirthday()->format('d/m/Y'),
					  "picture" => "https://graph.facebook.com/".$aux->getId().'/picture'
				  );
				  $location_id = $response->getGraphUser()->getLocation()->getId();
				  $data['user_location'] = $this->facebook->get("/{$location_id}?fields=location")->getDecodedBody()["location"];

				} catch(Facebook\Exceptions\FacebookResponseException $e) {
				  echo 'Graph returned an error: ' . $e->getMessage();
				  exit;
				} catch(Facebook\Exceptions\FacebookSDKException $e) {
				  echo 'Facebook SDK returned an error: ' . $e->getMessage();
				  exit;
				}
			}
		}


		$this->load->view("profile", $data);

	}

	public function logout()
	{

		session_destroy();

		redirect(base_url());
	}
}
