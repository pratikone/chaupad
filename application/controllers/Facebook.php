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
			/*
			if ($client->isAccessTokenExpired()) {
   				 $client->refreshToken($_SESSION['refresh_token']);
   				 $_SESSION['access_token'] = $client->getAccessToken(); //refreshing token
  			}
  			*/
			//$data['likha_denge'] = $this->youtubeApiCall( false );
			
			redirect( base_url() . 'index.php/facebook/oldDashboard', 'location', 301);
			echo "token in da house";
		}
		else
		{	
			
			$data['authUrl'] = base_url() . 'index.php/facebook/login';

			//$this->login();
		}
		
		$data['logout'] = base_url();// . 'index.php/youtube/logout';
		
		$this->load->view('templates/youtube_header');
		//$this->load->view('youtube/viewlogin', $data);
		$this->load->view('youtube/viewNewlogin', $data);
		if( isset($data['likha_denge']) )
			$this->load->view('youtube/videoList', $data );
		$this->load->view('templates/youtube_footer');
	}    


	public function login(){
		echo "Nigga";
		$client = new Facebook\Facebook([
			'app_id' => '558049591013252',
			'app_secret' => '6678bbf4ef0bfad674601faee955a507',
			'default_graph_version' => 'v2.2',
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



	}   

	public function facebookPageLikesApiCall($page_id=0, $page_access_token)
	{
      try {
      	$client = $_SESSION['client'];
		$result = $client->get('/'.$page_id.'/insights/page_fans', $page_access_token);
		return $result->getDecodedBody();

		} catch(Exception $e) {
		echo $e;
		}
	}


}
?>