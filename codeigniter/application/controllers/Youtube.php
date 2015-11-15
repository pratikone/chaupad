<?php

require_once APPPATH.'third_party/google/vendor/autoload.php';

class Youtube extends CI_Controller{

	public function __construct(){
			parent::__construct();
		
			if (session_status() == PHP_SESSION_NONE) {
				session_start();  //defining here as a fix to avoid session clearing during redirection
			}
    }



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
		
		
		
		if (isset($_SESSION['access_token'])) {
			echo "I have the token NIGGA";
		}
		else
		{	
			$this->login();
		}
		
		

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
		   
	   } else {
		  $client->authenticate($_GET['code']);
		  $_SESSION['access_token'] = $client->getAccessToken();
		  $data['redirect_uri'] = 'http://' . $_SERVER['HTTP_HOST'] . '/yt/codeigniter/index.php/youtube/analytics';
		  
	   }
	   $this->load->view('youtube/oauth', $data );
	   	   
	}  
	
	public function logout(){
		if(isset($_SESSION['access_token'])){
			unset($_SESSION['access_token']);
		}
		else{
			echo "nothing to destroy";
		}
		session_write_close(); 
		echo "Logged out nigga";
		exit();
		
		
	}   


}
