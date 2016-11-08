<?php

class Callbacks extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->facebook = new Facebook\Facebook([
          'app_id' => '1330791536954247',
          'app_secret' => '71ba607dfdc732389a7cc46a6ee209d8',
          'default_graph_version' => 'v2.5',
        ]);
        $this->load->library('googleplus');
    }

    public function callback_google()
    {
        if (isset($_GET['code'])) {
            $this->googleplus->getAuthenticate();
            $aux = $this->googleplus->getUserInfo();
            $data['user_profile'] = array(
                'email' => $aux['email'],
                'name' => $aux['name'],
                'id_auth' => $aux['id'],
                'link_rede' => $aux['link'],
                'gender' => $aux['gender'],
                'picture' => $aux['picture'],
                'key' => "id_google"
            );
            $data["type"] = "google";

            $this->session->set_flashdata("user_data", $data);
            redirect('login');
        }
    }

    public function callback_facebook()
    {
        $helper = $this->facebook->getRedirectLoginHelper();
        try {
            $accessToken = $helper->getAccessToken();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: '.$e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: '.$e->getMessage();
            exit;
        }

        if (isset($accessToken)) {
            $accessToken= (string) $accessToken;

            $this->facebook->setDefaultAccessToken($accessToken);

            try {
                $response = $this->facebook->get('/me?fields=name,gender,birthday,location,email');

                $aux = $response->getGraphUser();
                $data['user_profile'] = array(
                  'name' => $aux->getName(),
                  'email' => $aux->getEmail(),
                  'id_auth' => $aux->getId(),
                  'link_rede' => "https://www.facebook.com/{$aux->getId()}",
                  'gender' => $aux->getGender(),
                  'birthday' => $aux->getBirthday()->format('d/m/Y'),
                  'picture' => 'https://graph.facebook.com/'.$aux->getId().'/picture?width=200',
                  'key' => "id_facebook"

              );
                $location_id = $response->getGraphUser()->getLocation()->getId();
                array_push($data['user_profile'], $this->facebook->get("/{$location_id}?fields=location")->getDecodedBody()['location']);
                $data["type"] = "facebook";
                $this->session->set_flashdata("user_data", $data);
                redirect("login");

            } catch (Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: '.$e->getMessage();
                exit;
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: '.$e->getMessage();
                exit;
            }
        }
    }
}
