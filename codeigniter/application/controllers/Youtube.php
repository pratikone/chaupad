<?php

require_once APPPATH.'third_party/google/vendor/autoload.php';

class Youtube extends CI_Controller{

	
	public function __construct(){
			parent::__construct();
		
			if (session_status() == PHP_SESSION_NONE) {
				session_start();  //defining here as a fix to avoid session clearing during redirection
			}
    }


	public function analytics( $page=' ' ){
		if (session_status() == PHP_SESSION_NONE)
				session_start();

			
		if( $page == 'old' ){
			if (isset($_SESSION['access_token'])) {
				$client = $_SESSION['client'];
				if ($client->isAccessTokenExpired()) {
	   				 $client->refreshToken($_SESSION['refresh_token']);
	   				 $_SESSION['access_token'] = $client->getAccessToken(); //refreshing token
	  			}
				echo "I have the token NIGGA";
				$data['likha_denge'] = $this->youtubeApiCall( [$this, "youtubeVideosApiCall"] );
			}
			else
			{	
				
				$data['authUrl'] = base_url() . 'index.php/youtube/login';
				
				//$this->login();
			}
			
			
			$data['logout'] = base_url() . '/index.php/youtube/logout';
			
			$this->load->view('templates/youtube_header');
			$this->load->view('youtube/viewlogin', $data);
			if( isset($data['likha_denge']) )
				$this->load->view('youtube/videoList', $data );
			$this->load->view('templates/youtube_footer');
		}
		else{

			//dashboard flow
			if (isset($_SESSION['access_token'])) {
				$client = $_SESSION['client'];
				if ($client->isAccessTokenExpired()) {
	   				 $client->refreshToken($_SESSION['refresh_token']);
	   				 $_SESSION['access_token'] = $client->getAccessToken(); //refreshing token
	  			}
				//$data['likha_denge'] = $this->youtubeApiCall( false );
				
				redirect( base_url() . 'index.php/youtube/dashboard', 'location', 301);
			}
			else
			{	
				
				$data['authUrl'] = base_url() . 'index.php/youtube/login';

				//$this->login();
			}
			
			$data['logout'] = base_url() . 'index.php/youtube/logout';
			
			$this->load->view('templates/youtube_header');
			$this->load->view('youtube/viewlogin', $data);
			if( isset($data['likha_denge']) )
				$this->load->view('youtube/videoList', $data );
			$this->load->view('templates/youtube_footer');
		}





	}
	
	public function login(){
		echo "Nigga";
	
		$client = new Google_Client();
		$oauth_creds = APPPATH.'third_party/google/vendor/oauth-credentials.json';
		$client->setAuthConfigFile($oauth_creds);
		$client->setAccessType('offline');
		$client->setRedirectUri( base_url() . 'index.php/youtube/login');
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
    	  $refresh_token = $tokens_decoded->refresh_token;
		  $data['redirect_uri'] =  base_url() . 'index.php/youtube/analytics';
		  $_SESSION['access_token'] = $access_token;
		  $_SESSION['refresh_token'] = $refresh_token;
		  
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
		redirect( base_url() . '/index.php/youtube/analytics', 'location', 301);
			
	}   
	
	private function youtubeApiCall( callable $apiCall ){
		  $client = $_SESSION['client'];
		  $client->setAccessToken($_SESSION['access_token']);
		  $youtube = new Google_Service_YouTubeAnalytics($client);
		  $youtubeData = new Google_Service_YouTube($client);
		
		  //using callbacks
		  $this->load->model('youtube_channel');
		  return $apiCall($youtube, $youtubeData); //return appropriate function
		  
	}

	public function youtubeChannelApiCall($youtube, $youtubeData)
	{
		  $id = "channel==MINE";
		  $start_date = "2005-03-15";
		  $end_date = date('Y-m-d');
		  $metrics = "likes,views,shares,comments";
		  $optParams = [];
		  $channel_response = $youtube->reports->query( $id, $start_date, $end_date, $metrics, $optParams ); //blank array for channel response	
	  	  $this->youtube_channel->processChannelResponse( $channel_response );
	  	  $likha_denge = $this->youtube_channel->viewChannelData();
	      return $likha_denge;
	  	
	}

	public function youtubeChannelMonthlyApiCall($youtube, $youtubeData)
	{
		  $id = "channel==MINE";
		  $start_year = date('Y', strtotime("-1 year", time())); 
		  $start_month = date('m', strtotime("-1 year", time()));
  		  $end_year = date('Y'); 
		  $end_month = date('m');
		  $date = "01";
		  
		  $start_date = "$start_year-$start_month-$date";
		  $end_date = "$end_year-$end_month-$date";

		  $metrics = "likes,views,shares";
		  $optParams = [
								"dimensions" => "month",  //get video wise likes and views
								"sort" => "month",
								"max-results" => 200      // max results returned, should be sufficient
						];
		  $channel_response = $youtube->reports->query( $id, $start_date, $end_date, $metrics, $optParams ); 
		  $this->youtube_channel->processChannelMonthlyResponse($channel_response);
		  
	  	  $likha_denge = $this->youtube_channel->monthlyChannelList;
	      return $likha_denge;
	  	
	}





	public function youtubeVideosApiCall($youtube, $youtubeData)
	{
		  $id = "channel==MINE";
		  $start_date = "2005-03-15";
		  $end_date = date('Y-m-d');
		  $metrics = "likes,views,shares,comments";
		  $optParams = [
								"dimensions" => "video",  //get video wise likes and views
								"sort" => "-views",       //descending order
								"max-results" => 200      // max results returned, should be sufficient
						];
		  
	  	$response = $youtube->reports->query( $id, $start_date, $end_date, $metrics, $optParams );	
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
		$response = $this->youtubeApiCall([$this, "youtubeVideosApiCall"]); //will fetch all video data of logged in user
		$data['json'] = json_encode($response);  
		echo json_encode($data);   //somehow only double json encoding works. Lord JS works in mysterious ways
	}

	public function getChannelDataAJAX($value='')
	{
		$response = $this->youtubeApiCall([$this, "youtubeChannelApiCall"]); //will fetch all video data of logged in user
		$data['json'] = json_encode($response);  
		echo json_encode($data);   //somehow only double json encoding works. Lord JS works in mysterious ways
	}

	public function getChannelMonthlyDataAJAX($value='')
	{
		$response = $this->youtubeApiCall([$this, "youtubeChannelMonthlyApiCall"]); //will fetch all video data of logged in user

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


	public function test($value='')
	{
		$this->load->view('youtube/test');
	}


}
