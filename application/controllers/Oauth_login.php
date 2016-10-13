<?php

class Oauth_Login extends CI_Controller
{
    public $user = '';

    public function __construct()
    {
        parent::__construct();

		// Load facebook library and pass associative array which contains appId and secret key
		// $this->load->library('facebook', array('appId' => '1330791536954247', 'secret' => '71ba607dfdc732389a7cc46a6ee209d8'));
		$this->facebook = new Facebook\Facebook([
		  'app_id' => '1330791536954247',
		  'app_secret' => '71ba607dfdc732389a7cc46a6ee209d8',
		  'default_graph_version' => 'v2.5',
		]);
		// Get user's login information
		// $this->user = $this->facebook->getUser();
    }

	// Store user information and send to profile page
	public function index()
	{
	    if ($this->user) {
	        $data['user_profile'] = $this->facebook->api('/me/');

		// Get logout url of facebook
		$data['logout_url'] = $this->facebook->getLogoutUrl(array('next' => base_url().'index.php/oauth_login/logout'));

		// Send data to profile page
		$this->load->view('profile', $data);
		    } else {

		// Store users facebook login url
		// $data['login_url'] = $this->facebook->getLoginUrl();
		$helper = $this->facebook->getRedirectLoginHelper();
		$permissions = ['public_profile ', 'user_likes', 'user_location', 'user_birthday'];
		$data['login_url'] = $helper->getLoginUrl('http://localhost/akijob/index.php/oauth_login/callback', $permissions);

        $this->load->view('login', $data);
	    }
	}

	public function callback(){
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
		  // Now you can redirect to another page and use the
		  // access token from $_SESSION['facebook_access_token']
		  redirect(base_url()."index.php/oauth_login/profile");
		}
	}

	public function profile(){
		if (!isset($_SESSION['facebook_access_token'])) {
			redirect();
		}
		$this->facebook->setDefaultAccessToken($this->session->userdata("facebook_access_token"));

		try {
		  $response = $this->facebook->get('/me?fields=name,gender,birthday,location');
		  $data['user_profile'] = $response->getGraphUser();
		  $location_id = $response->getGraphUser()->getLocation()->getId();
		  $data['user_location'] = $this->facebook->get("/{$location_id}?fields=location")->getDecodedBody()["location"];

		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

		// echo 'Logged in as ' . $userNode->getName();
		$this->load->view("profile", $data);

	}

	// Logout from facebook
	public function logout()
	{

		// Destroy session
		session_destroy();

		// Redirect to baseurl
		redirect(base_url());
	}
}
