<?php

require_once APPPATH.'third_party/facebook/vendor/autoload.php';

class Facebook extends CI_Controller{

	
	public function __construct(){
			parent::__construct();
		
			if (session_status() == PHP_SESSION_NONE) {
				session_start();  //defining here as a fix to avoid session clearing during redirection
			}
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


	public function testfb($value='')
	{
		$client = new Facebook\Facebook([
			'app_id' => '558049591013252',
			'app_secret' => '6678bbf4ef0bfad674601faee955a507',
			'default_graph_version' => 'v2.2',
			]);

		

		if($value == "callback"){
			$helper = $client->getRedirectLoginHelper();
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
				  // OAuth 2.0 client handler
					$oAuth2Client = $client->getOAuth2Client();

					// Exchanges a short-lived access token for a long-lived one
					$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
					$client->setDefaultAccessToken($longLivedAccessToken);
					$_SESSION['client'] = $client;
				  echo "token found";

				  $this->testapi();
				}

		}
		else{ //not logged in yet
			$helper = $client->getRedirectLoginHelper();
			$permissions = ['email', 'user_likes', 'manage_pages', 'publish_pages', 'read_insights']; // optional
			$loginUrl = $helper->getLoginUrl( base_url() . 'index.php/facebook/testfb/callback', $permissions);
			echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
		}

	}

	private function testapi($value='')
	{
		$client = $_SESSION['client'];
		try {
		  //$response = $client->get('/me');
			$response = $client->get('/me/accounts');
		  //$userNode = $response->getGraphUser();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

		//echo 'Logged in as ' . $userNode->getId();
		$formatted = $response->getDecodedBody();
		echo json_encode($formatted);
		echo "<HR>";
		$page_id = $formatted['data'][0]['id'];
		echo "id=".$page_id;
		$page_access_token = $formatted['data'][0]['access_token']; //to be done for every page
		echo "";


	      try {
	                    $attachment = array(
	                                'access_token' => $page_access_token,
	                                //'message'=> 'hello world posting like admin!',
	                                'page_id'=> $page_id
	                        );

	                     $result = $client->get('/'.$page_id.'/insights/page_positive_feedback_by_type', $page_access_token);
	                    //$result = $facebook->api('/me/feed','POST', $attachment);

	                    echo json_encode($result->getDecodedBody());

	                } catch(Exception $e) {
	                    echo $e;
	                }
	}

}


?>