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
			$client = $_SESSION['client'];
			if ($client->isAccessTokenExpired()) {
   				 $client->refreshToken($_SESSION['refresh_token']);
   				 $_SESSION['access_token'] = $client->access_token; //refreshing token
  			}
			echo "I have the token NIGGA";
			$data['likha_denge'] = $this->youtubeApiCall();
		}
		else
		{	
			
			$data['authUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/yt/codeigniter/index.php/youtube/login';
			
			//$this->login();
		}
		
		$data['base'] = 'http://' . $_SERVER['HTTP_HOST'] . '/yt/codeigniter';
		$data['logout'] = $data['base'] . '/index.php/youtube/logout';
		
		$this->load->view('templates/youtube_header');
		$this->load->view('youtube/viewlogin', $data);
		if( isset($data['likha_denge']) )
			$this->load->view('youtube/videoList', $data );
		$this->load->view('templates/youtube_footer');
		

	}
	
	public function login(){
		echo "Nigga";
	
		$client = new Google_Client();
		$oauth_creds = APPPATH.'third_party/google/vendor/oauth-credentials.json';
		$client->setAuthConfigFile($oauth_creds);
		$client->setAccessType('offline');
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
		  $access_token = $client->getAccessToken();
		  $tokens_decoded = json_decode($access_token);
    	  $refreshToken = $tokens_decoded->refresh_token;
		  $data['redirect_uri'] = 'http://' . $_SERVER['HTTP_HOST'] . '/yt/codeigniter/index.php/youtube/analytics';
		  $_SESSION['access_token'] = $access_token;
		  $_SESSION['refresh_token'] = $refreshToken;
		  
	   }
	   
	   $_SESSION['client'] = $client;
	   $this->load->view('youtube/oauth', $data );
	   	   
	}  
	
	public function logout(){
		if(isset($_SESSION['access_token'])){
			unset($_SESSION['access_token']);
			$client = $_SESSION['client'];
			$client->revokeToken(); //remove this line for direct unhindered access after reception of first token
			
			unset($_SESSION['client']);
		}
		else{
			echo "nothing to destroy";
		}
		session_write_close(); 
		//session_destroy();
		echo "Logged out nigga";
		$this->load->helper('url');
		redirect('http://' . $_SERVER['HTTP_HOST'] . '/yt/codeigniter/index.php/youtube/analytics', 'location', 301);
			
	}   
	
	private function youtubeApiCall(){
		$client = $_SESSION['client'];
		$client->setAccessToken($_SESSION['access_token']);
		$youtube = new Google_Service_YouTubeAnalytics($client);
		$youtubeData = new Google_Service_YouTube($client);
		
		/*
			$part = "id";
			$opt = array(
						'mine' => true
					  );
		    $response = $youtubeData->channels->listChannels($part, $opt);
			echo $response->getitems()[0]["id"];
		  //$id = "channel==" . $response->getitems()[0]["id"]; //gets the id, i can use MINE instead
	  */
	  $id = "channel==MINE";
	  $start_date = "2009-03-15";
	  $end_date = "2015-11-16";
	  $metrics = "likes,views,shares,comments";
	  $optParams = [
							"dimensions" => "video",  //get video wise likes and views
							"sort" => "-views",       //descending order
							"max-results" => 200      // max results returned, should be sufficient
					];
	  
	  $response = $youtube->reports->query( $id, $start_date, $end_date, $metrics, $optParams );
	  //echo json_encode($response);
	  
	  $this->load->model('youtube_channel');
	  $this->youtube_channel->processAnalyticsResponse( $response );

	  // Youtube Data API
	  $videoIDList = $this->youtube_channel->getVideoIds();
	  
	  $part = "snippet";
	  $opt = array(
					'id' => $videoIDList
				  );
	  $response = $youtubeData->videos->listVideos($part, $opt);
	  $this->youtube_channel->processVideoIds( $response );
	  
	  
	  
	  $likha_denge = $this->youtube_channel->viewVideoData();
	  return $likha_denge;
	}


	public function dashboard($value='')
	{
		$this->load->view('youtube/index');
	}



	public function getVideoDataAJAX($value='')
	{
		$response = $this->youtubeApiCall(); //will fetch all video data of logged in user
		$data['json'] = json_encode($response);  
		echo json_encode($data);   //somehow only double json encoding works. Lord JS works in mysterious ways

	}





	public function ajaxTest($value='')
	{
		$str = [

				"name"=>"superman",
				"city"=>"metropolis",
				"age"=>200
			];

		$data["json"] = json_encode($str);
		echo json_encode($data);
	}


	public function Test($value='')
	{
		$this->load->view('youtube/test');
	}


}
