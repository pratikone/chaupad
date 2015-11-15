<?php

require_once APPPATH.'third_party/google/vendor/autoload.php';

class Youtube extends CI_Controller{

	public function view($page = 'home'){
		$loc = APPPATH.'/views/pages/'.$page.'.php';
		if( !file_exists( $loc )){
			echo $loc;	
			show_404();
		}

		$data['title'] = ucfirst($page); //Capitalize it bitch

		$this->load->view('templates/header', $data );
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);

	}
	
	public function analytics(){
		
		session_start();
		if (isset($_SESSION['access_token'])) {
			echo "I have the token NIGGA";
		}
		else
		{		
			$this->login();
		}
		
		//$this->load->view('google_authentication', $data);

	}
	
	public function login(){
		echo "Nigga";
	
		$client = new Google_Client();
		$oauth_creds = APPPATH.'third_party/oauth-credentials.json';
		$client->setAuthConfigFile($oauth_creds);
		$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/yt/codeigniter/index.php/youtube/login');
		$client->addScope(
		  [
		   Google_Service_YouTube::YOUTUBE,
		   Google_Service_YouTube::YOUTUBE_READONLY,
		   Google_Service_YouTubeAnalytics::YT_ANALYTICS_READONLY
		  ]
		);
		
		if (! isset($_GET['code'])) {
		   $auth_url = $client->createAuthUrl();
		   $data['redirect_uri'] = $auth_url;
		   //$this->load->helper( $auth_url  ,'location', 301);
		   //header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
	   } else {
		  $client->authenticate($_GET['code']);
		  $_SESSION['access_token'] = $client->getAccessToken();
		  error_log("at login LEVEL access token ". $_SESSION['access_token']);
		  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/yt/codeigniter/index.php/youtube/analytics';
		  $data['redirect_uri'] = $redirect_uri;
		  
		  
		  //$this->load->helper( $redirect_uri  ,'location', 301);
		  //header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
	   }
	   $this->load->view('youtube/oauth', $data );
	   	   
	}  
	
	public function logout(){
		unset($_SESSION['access_token']);
		echo "Logged out nigga";
		
	}   


}
