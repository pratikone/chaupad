<?php
/*
* TODO : Refresh token fails sometime. Atleast I should make the app to logout when Google_Auth_Exception is thrown
* TODO : Bread icon for side navigation is not working. Maybe due to some cleanup of code
* TODO : Add formatting option to convert big value to K and M etc
*/

require_once APPPATH.'third_party/google/vendor/autoload.php';
require_once 'Facebook.php';
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

class Youtube extends CI_Controller{

	public $num_of_videos = 5; //to be changed in formatting.js too
	public function __construct(){
			parent::__construct();
		
			if (session_status() == PHP_SESSION_NONE) {
				session_start();  //defining here as a fix to avoid session clearing during redirection
			}
    }


	public function analytics( $page=' ' ){
		if (session_status() == PHP_SESSION_NONE)
				session_start();
			
		//dashboard flow
		if (isset($_SESSION['access_token'])) {
			$client = $_SESSION['client'];
			$this->youtubeTokenCheck($client);
			//$data['likha_denge'] = $this->youtubeApiCall( false );
			
			// redirect( base_url() . 'index.php/youtube/dashboard', 'location', 301);
			$this->dashboard();
		}
		else
		{	
			
			$data['authUrl'] = base_url() . 'index.php/youtube/login';
			$this->load->view('templates/youtube_header');
			$data['logout'] = base_url();// . 'index.php/youtube/logout';
			//$this->load->view('youtube/viewlogin', $data);
			$this->load->view('youtube/viewNewlogin', $data);
			if( isset($data['likha_denge']) )
				$this->load->view('youtube/videoList', $data );
			$this->load->view('templates/youtube_footer');
		}

	}
	
	public function login(){
		$client = new Google_Client();
		$oauth_creds = APPPATH.'third_party/google/oauth-credentials.json';
		$client->setAuthConfigFile($oauth_creds);
		$client->setAccessType('offline');
		$client->setRedirectUri( base_url() . 'index.php/youtube/login');
		$client->addScope(
		  [
		   Google_Service_YouTube::YOUTUBE,
		   Google_Service_YouTube::YOUTUBE_READONLY,
		   Google_Service_YouTubeAnalytics::YT_ANALYTICS_READONLY,
		   Google_Service_Oauth2::USERINFO_EMAIL,
		   Google_Service_Oauth2::USERINFO_PROFILE
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
		
		if(isset($_SESSION['fb_access_token'])){
			redirect( base_url() . 'index.php/facebook/logout', 'location', 301);
		}
		else if(isset($_SESSION['access_token'])){
			unset($_SESSION['access_token']);
			unset($_SESSION['refresh_token']);
			$client = $_SESSION['client'];
			$client->revokeToken(); //remove this line for direct unhindered access after reception of first token
			
			unset($_SESSION['client']);
		}
		else{
			echo "nothing to destroy";
		}
		session_write_close(); 
		//session_destroy();
		$this->load->helper('url');
		redirect( base_url(), 'location', 301);
			
	}   
	
	private function youtubeApiCall( callable $apiCall, $opts=[] ){
		  $client = $_SESSION['client'];
		  $this->youtubeTokenCheck($client);

		  $youtube = new Google_Service_YouTubeAnalytics($client);
		  $youtubeData = new Google_Service_YouTube($client);
		  $OAuth2Data = new Google_Service_Oauth2($client); //used for fetching logged in user info

		  //using callbacks
		  $this->load->model('youtube_channel');
		  return $apiCall($youtube, $youtubeData, $OAuth2Data, $opts); //return appropriate function
		  
	}

	public function youtubeTokenCheck($client){
      if ($client->isAccessTokenExpired()) {
		 	$client->refreshToken($_SESSION['refresh_token']);
		 	$access_token = $client->getAccessToken(); //refreshing token
		 	$_SESSION['access_token'] = $access_token;
		    $tokens_decoded = json_decode($access_token);
    	    $refresh_token = $tokens_decoded->refresh_token;
	  }
	}


	public function youtubeChannelApiCall($youtube, $youtubeData, $OAuth2Data, $opts=[])
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


	public function youtubeChannelSubscribersApiCall($youtube, $youtubeData, $OAuth2Data, $opts=[])
	{
		  $id = "channel==MINE";
		  $start_date = date('Y-m', strtotime("-1 year", time())) . "-01"; //first day of that month
		  $end_date = date('Y-m') . "-01"; //first day of that month
		  $metrics = "subscribersGained";
		  $optParams = [
		  					"dimensions" => "month",
							"sort" => "month"
		  				];
		  $channel_response = $youtube->reports->query( $id, $start_date, $end_date, $metrics, $optParams ); //blank array for channel response	
	  	  $this->youtube_channel->processChannelSubscribersResponse( $channel_response );
	  	  $likha_denge = $this->youtube_channel->viewChannelSubscribersData();
	      return $likha_denge;
	  	
	}


	public function youtubeChannelMonthlyApiCall($youtube, $youtubeData, $OAuth2Data, $opts=[])
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

	public function youtubeVideoMonthlyApiCall($youtube, $youtubeData, $OAuth2Data, $opts=[])
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
								"filters" => "video==" . $opts["video_id"]      // max results returned, should be sufficient
						];
		  $channel_response = $youtube->reports->query( $id, $start_date, $end_date, $metrics, $optParams ); 
		  $this->youtube_channel->processChannelMonthlyResponse($channel_response);
		  
	  	  $likha_denge = $this->youtube_channel->monthlyChannelList;
	      return $likha_denge;
	  	
	}

	public function youtubeVideosApiCall($youtube, $youtubeData, $OAuth2Data, $opts)
	{
		  $id = "channel==MINE";
		  $start_date = "2005-03-15";
		  $end_date = date('Y-m-d');
		  $metrics = "likes,views,shares,comments";
		  $optParams = [
								"dimensions" => "video",  //get video wise likes and views
								"sort" => "-views",       //descending order
								"max-results" => $this->num_of_videos,
								"start-index" => $opts["index"]
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

	public function youtubeChannelCountriesApiCall($youtube, $youtubeData, $OAuth2Data, $opts)
	{
		  $id = "channel==MINE";
		  $start_year = date('Y', strtotime("-1 year", time())); 
		  $start_month = date('m', strtotime("-1 year", time()));
  		  $end_year = date('Y'); 
		  $end_month = date('m');
		  $date = "01";
		  
		  $start_date = "$start_year-$start_month-$date";
		  $end_date = "$end_year-$end_month-$date";
		  $metrics = "views";
		  $optParams = [
								"dimensions" => "country",  //get video wise likes and views
								"sort" => "-views",       //descending order
								"max-results" => 200     // max results returned, should be sufficient
						];

	  	$response = $youtube->reports->query( $id, $start_date, $end_date, $metrics, $optParams );	

	    // Youtube Data API
	    $likha_denge = $this->youtube_channel->processChannelCountriesResponse($response);
	    return $likha_denge;	
	}


	public function youtubeExternalVideoPublicDataApiCall($youtube, $youtubeData, $OAuth2Data, $opts)
	{
	    // Youtube Data API
	    $videoID = $opts["video_id"];
	  
	    $part = "snippet,statistics";
	    $opt = array(
		  			'id' => $videoID
		  		  );
	    $response = $youtubeData->videos->listVideos($part, $opt);
	    $this->youtube_channel->processExternalVideoResponse($response);
	    $likha_denge = $this->youtube_channel->viewVideoData();
	    return $likha_denge;	
	}	

	public function youtubeExternalChannelPublicDataApiCall($youtube, $youtubeData, $OAuth2Data, $opts)
	{
	    // Youtube Data API
	    $channelID = $opts["channel_id"];
	  
	    $part = "snippet,statistics";
	    $opt = array(
		  			'id' => $channelID
		  		  );
	    $response = $youtubeData->channels->listChannels($part, $opt);
	    $this->youtube_channel->processExternalChannelResponse($response);
	    $likha_denge = $this->youtube_channel->viewChannelData();
	    return $likha_denge;	
	}	

	public function youtubeExternalChannelVideoPublicDataAggregatorApiCall($youtube, $youtubeData, $OAuth2Data, $opts)
	{

		$likha_denge = [];
		$opt["video_id"] = $opts["video_id"];
		$response = $this->youtubeExternalVideoPublicDataApiCall($youtube, $youtubeData, $OAuth2Data, $opt);
		$likha_denge["video"] = $response;

		//channel id has been set up the function above it.
		$opt["channel_id"] = $this->youtube_channel->channel_id;
		$response = $this->youtubeExternalChannelPublicDataApiCall($youtube, $youtubeData, $OAuth2Data, $opt);
		$likha_denge["channel"] = $response;

		// error_log(json_encode($likha_denge));
		return $likha_denge;

	}


public function googleOAuth2ProfileApiCall($youtube, $youtubeData, $OAuth2Data, $opts=[])
	{

	    $response = $OAuth2Data->userinfo->get();
	    $this->youtube_channel->processGoogleProfileResponse( $response );
	    $likha_denge =   $this->youtube_channel->viewGoogleProfileData();
	    return $likha_denge;	
	}

	public function dashboard($value='')
	{
		$this->load->view('youtube/index', $value);
	}

	public function facebook($value='')
    {
        redirect( base_url() . 'index.php/facebook/analytics', 'location', 301);
    }


	public function getVideoDataAJAX($value='1')
	{
		$opts = ["index" => $value];
		$response = $this->youtubeApiCall([$this, "youtubeVideosApiCall"], $opts); //will fetch all video data of logged in user
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

	public function getVideoMonthlyDataAJAX($value='')
	{
		$opts["video_id"] = $value;
		$response = $this->youtubeApiCall([$this, "youtubeVideoMonthlyApiCall"], $opts); //will fetch all video data of logged in user

		$data['json'] = json_encode($response);  
		echo json_encode($data);   //somehow only double json encoding works. Lord JS works in mysterious ways
	}


	public function getGoogleProfileDataAJAX($value='')
	{
		$response = $this->youtubeApiCall([$this, "googleOAuth2ProfileApiCall"]); //will fetch all video data of logged in user

		$data['json'] = json_encode($response);  
		echo json_encode($data);   //somehow only double json encoding works. Lord JS works in mysterious ways
	}

	public function getGoogleChannelSubscribersDataAJAX($value='')
	{
		$response = $this->youtubeApiCall([$this, "youtubeChannelSubscribersApiCall"]); //will fetch all video data of logged in user
		$data['json'] = json_encode($response);  
		echo json_encode($data);   //somehow only double json encoding works. Lord JS works in mysterious ways
	}

	public function getYoutubeChannelCountriesAJAX($value='')
	{
		$response = $this->youtubeApiCall([$this, "youtubeChannelCountriesApiCall"]); //will fetch all video data of logged in user
		$data['json'] = json_encode($response);  
		echo json_encode($data);   //somehow only double json encoding works. Lord JS works in mysterious ways
	}

	public function getYoutubeExternalVideoPublicDataAJAX($value='')
	{
		$opts["video_id"] = $value;
		$response = $this->youtubeApiCall([$this, "youtubeExternalVideoPublicDataApiCall"], $opts); //will fetch all video data of logged in user
		$data['json'] = json_encode($response);  
		echo json_encode($data);   //somehow only double json encoding works. Lord JS works in mysterious ways
	}

	public function getYoutubeExternalChannelPublicDataAJAX($value='')
	{
		$opts["channel_id"] = $value;
		$response = $this->youtubeApiCall([$this, "youtubeExternalChannelPublicDataApiCall"], $opts); //will fetch all video data of logged in user
		$data['json'] = json_encode($response);  
		echo json_encode($data);   //somehow only double json encoding works. Lord JS works in mysterious ways
	}

	public function youtubeExternalChannelVideoPublicDataAggregatorAJAX($value='')
	{
		$opts["video_id"] = $value;
		$response = $this->youtubeApiCall([$this, "youtubeExternalChannelVideoPublicDataAggregatorApiCall"], $opts); //will fetch all video data of logged in user
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

	public function testPage($value='')
	{
		$this->load->view('youtube/'. $value);	
	}

	public function test($value='')
	{
		$this->load->view('youtube/test');

	}


}
