<?php

require_once APPPATH.'third_party/facebook/vendor/autoload.php';

class Facebook extends CI_Controller{

	
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
			/*  TODO : token refresh logic
			if ($client->isAccessTokenExpired()) {
   				 $client->refreshToken($_SESSION['refresh_token']);
   				 $_SESSION['access_token'] = $client->getAccessToken(); //refreshing token
  			}
  			*/
			$response = $this->facebookApiCall( [$this, "ajaxTest"] );
			foreach(  $response as $fb_page  ){
                    $likha_denge[ $fb_page->page_id ] = $fb_page->page_name;
            }
            $data['likha_denge'] = $likha_denge;


			//redirect( base_url() . 'index.php/facebook/dashboard', 'location', 301);
			$this->dashboard($data);
		}
		else
		{	
			
			$data['authUrl'] = base_url() . 'index.php/facebook/login';

			//$this->login();
			$data['logout'] = base_url();// . 'index.php/youtube/logout';
			
			$this->load->view('templates/youtube_header');
			//$this->load->view('youtube/viewlogin', $data);
			$this->load->view('youtube/viewNewlogin', $data);
			$this->load->view('templates/youtube_footer');
		}
		
	}    


	public function login(){
		echo "Nigga";
		$client = new Facebook\Facebook([
			'app_id' => '558049591013252',
			'app_secret' => '6678bbf4ef0bfad674601faee955a507',
			'default_graph_version' => 'v2.5',
			]);
	
		if (! isset($_GET['code'])) {

			$helper = $client->getRedirectLoginHelper();
			$permissions = ['email', 'user_likes', 'manage_pages', 'publish_pages', 'read_insights']; // optional
			$loginUrl = $helper->getLoginUrl( base_url() . 'index.php/facebook/login', $permissions);
			$data['redirect_uri'] = $loginUrl;

	    	$this->load->view('youtube/oauth', $data );

	   } else {

			$helper = $client->getRedirectLoginHelper();
			try {
			  $access_token = $helper->getAccessToken();
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
			  // When Graph returns an error
			  echo 'Graph returned an error: ' . $e->getMessage();
			  exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
			  // When validation fails or other local issues
			  echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  exit;
			}
			if (isset($access_token)) {
				  // Logged in!
				  // Now you can redirect to another page and use the
				  // access token from $_SESSION['facebook_access_token']
				  // OAuth 2.0 client handler
					$oAuth2Client = $client->getOAuth2Client();

					// Exchanges a short-lived access token for a long-lived one
					$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($access_token);
					$client->setDefaultAccessToken($longLivedAccessToken);
					$data['redirect_uri'] =  base_url() . 'index.php/facebook/analytics';
					$_SESSION['access_token'] = (string) $longLivedAccessToken;
					$_SESSION['client'] = $client;
				  echo "token found";
				}
	   }
	   
	   $this->load->view('youtube/oauth', $data );
	   	   
	}  

public function dashboard($value='')
	{
		$this->load->view('facebook/index', $value);
	}


	public function ajaxTest($value='')
	{
		$str = [

				"name"=>"superman",
				"city"=>"metropolis",
				"age"=>200
			];

		$data["json"] = json_encode($str);
		//echo json_encode($data);
	}

	
	public function logout(){
		if(isset($_SESSION['access_token'])){
			unset($_SESSION['access_token']);
			//unset($_SESSION['refresh_token']);
			//$client = $_SESSION['client'];
			//$client->revokeToken(); //remove this line for direct unhindered access after reception of first token
			
			unset($_SESSION['client']);
		}
		else{
			echo "nothing to destroy";
		}
		session_write_close(); 
		//session_destroy();
		echo "Logged out nigga";
		$this->load->helper('url');
		redirect( base_url() . 'index.php/facebook/analytics', 'location', 301);
			
	}   
	


	public function facebookApiCall(callable $apiCall, $page_id="")
	{
		$client = $_SESSION['client'];
		try {
			$response = $client->get('/me/accounts');
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  return 'Graph returned an error: ' . $e->getMessage();
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  return 'Facebook SDK returned an error: ' . $e->getMessage();
		}

		$formatted = $response->getDecodedBody();
		
		$this->load->model('facebook_pages');
		$this->facebook_pages->processPageIds($formatted);

		if( $page_id == "")
			return $this->facebook_pages->pageIdandToken;

		return $apiCall( $page_id, $this->facebook_pages->pageIdandToken[ $page_id ]->page_access_token );
	}   

	public function facebookPageLikesApiCall($page_id, $page_access_token)
	{
      try {
      	if($page_id == "")
      		return "No valid page id provided";

      	$client = $_SESSION['client'];
		$result = $client->get('/'.$page_id.'/insights/page_fans', $page_access_token);
		return $result->getDecodedBody();

		} catch(Exception $e) {
			return 'Facebook SDK returned an error: ' . $e->getMessage();
		}
	}


	public function facebookPagePostsApiCall($page_id, $page_access_token)
	{
      try {
      	if($page_id == "")
      		return "No valid page id provided";

      	$client = $_SESSION['client'];
		$result = $client->get('/'.$page_id.'/posts?limit=25', $page_access_token);
		return $result->getDecodedBody();

		} catch(Exception $e) {
			return 'Facebook SDK returned an error: ' . $e->getMessage();
		}
	}

	//impressions for last 30 days
	public function facebookPageImpressionsApiCall($page_id, $page_access_token)
	{
      try {
      	if($page_id == "")
      		return "No valid page id provided";

      	$client = $_SESSION['client'];
      	$last_month = strtotime("-1 month"); 
		$today=  strtotime("today");
		$result = $client->get('/'.$page_id.'/insights/page_posts_impressions/day?since=' . $last_month . '&until=' . $today, $page_access_token);
		return $result->getDecodedBody();

		} catch(Exception $e) {
			return 'Facebook SDK returned an error: ' . $e->getMessage();
		}
	}

	//page clicks or consumption for last 30 days
	public function facebookPageClicksApiCall($page_id, $page_access_token)
	{
      try {
      	if($page_id == "")
      		return "No valid page id provided";

      	$client = $_SESSION['client'];
      	$last_month = strtotime("-1 month"); 
		$today=  strtotime("today");
		$result = $client->get('/'.$page_id.'/insights/page_consumptions/day?since=' . $last_month . '&until=' . $today, $page_access_token);
		return $result->getDecodedBody();

		} catch(Exception $e) {
			return 'Facebook SDK returned an error: ' . $e->getMessage();
		}
	}

	//page views for last 30 days
	public function facebookPageViewsApiCall($page_id, $page_access_token)
	{
      try {
      	if($page_id == "")
      		return "No valid page id provided";

      	$client = $_SESSION['client'];
      	$last_month = strtotime("-1 month"); 
		$today=  strtotime("today");
		$result = $client->get('/'.$page_id.'/insights/page_views/day?since=' . $last_month . '&until=' . $today, $page_access_token);
		return $result->getDecodedBody();

		} catch(Exception $e) {
			return 'Facebook SDK returned an error: ' . $e->getMessage();
		}
	}

	//page views for last 30 days
	public function facebookPageVideoViewsApiCall($page_id, $page_access_token)
	{
      try {
      	if($page_id == "")
      		return "No valid page id provided";

      	$client = $_SESSION['client'];
      	$last_month = strtotime("-1 month"); 
		$today=  strtotime("today");
		$result = $client->get('/'.$page_id.'/insights/page_video_views/day?since=' . $last_month . '&until=' . $today, $page_access_token);
		return $result->getDecodedBody();

		} catch(Exception $e) {
			return 'Facebook SDK returned an error: ' . $e->getMessage();
		}
	}


	//aggregator
	public function facebookPageDataAggregatorAJAX($page_id)
	{
      try {

      	$client = $_SESSION['client'];
      	//likes
     	$response = $this->facebookApiCall([$this, "facebookPageLikesApiCall"], $page_id); 
     	$lifetime_likes = $response["data"][0]["values"][2]["value"]; //3rd value is the latest one

     	//impressions or reach
     	$response = $this->facebookApiCall([$this, "facebookPageImpressionsApiCall"], $page_id); 
     	$total_impressions = 0;
     	foreach($response["data"][0]["values"] as $daily_value){
     		$total_impressions += $daily_value["value"];
     	}
		
		//page clicks
     	$response = $this->facebookApiCall([$this, "facebookPageClicksApiCall"], $page_id); 
     	$total_clicks = 0;
     	foreach($response["data"][0]["values"] as $daily_value){
     		$total_clicks += $daily_value["value"];
     	}

     	//page views
     	$response = $this->facebookApiCall([$this, "facebookPageViewsApiCall"], $page_id); 
     	$total_views = 0;
     	foreach($response["data"][0]["values"] as $daily_value){
     		$total_views += $daily_value["value"];
     	}


     	 $likha_denge = [ "lifetime_likes" => $lifetime_likes,
     					"total_impressions" => $total_impressions,
     					"total_clicks" => $total_clicks,
     					"total_views" => $total_views
     					];
	    $data['json'] = json_encode($likha_denge);    					
     	echo json_encode($data);   //somehow only double json encoding works. Lord JS works in mysterious ways

		} catch(Exception $e) {
			return 'Facebook SDK returned an error: ' . $e->getMessage();
		}
	}





	public function getFacebookPagesLikesAJAX($page_id="")
	{
		$response = $this->facebookApiCall([$this, "facebookPageLikesApiCall"], $page_id); 
		// echo json_encode($response);
		$data['json'] = json_encode($response);  
		echo json_encode($data);   //somehow only double json encoding works. Lord JS works in mysterious ways
	}

	public function getFacebookPagesPostsAJAX($page_id="")
	{
		$response = $this->facebookApiCall([$this, "facebookPagePostsApiCall"], $page_id); 
		// echo json_encode($response);
		$data['json'] = json_encode($response);  
		echo json_encode($data);   //somehow only double json encoding works. Lord JS works in mysterious ways
	}

	public function getFacebookPageImpressionsAJAX($page_id="")
	{
		$response = $this->facebookApiCall([$this, "facebookPageImpressionsApiCall"], $page_id); 
		echo json_encode($response);
		// $data['json'] = json_encode($response);  
		// echo json_encode($data);   //somehow only double json encoding works. Lord JS works in mysterious ways
	}
	
	public function getFacebookPageClicksAJAX($page_id="")
	{
		$response = $this->facebookApiCall([$this, "facebookPageClicksApiCall"], $page_id); 
		// echo json_encode($response);
		$data['json'] = json_encode($response);  
		echo json_encode($data);   //somehow only double json encoding works. Lord JS works in mysterious ways
	}


	public function getFacebookPageViewsAJAX($page_id="")
	{
		$response = $this->facebookApiCall([$this, "facebookPageViewsApiCall"], $page_id); 
		//echo json_encode($response);
		 $data['json'] = json_encode($response);  
		 echo json_encode($data);   //somehow only double json encoding works. Lord JS works in mysterious ways
	}

	public function getFacebookPageVideoViewsAJAX($page_id="")
	{
		$response = $this->facebookApiCall([$this, "facebookPageVideoViewsApiCall"], $page_id); 
		// echo json_encode($response);
		$data['json'] = json_encode($response);  
		echo json_encode($data);   //somehow only double json encoding works. Lord JS works in mysterious ways
	}

}
?>