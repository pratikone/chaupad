<?php

include_once __DIR__ . '/../vendor/autoload.php';
include_once "templates/base.php";

echo pageHeader('Youtube analysis');

/*************************************************
 * Ensure you've downloaded your oauth credentials
 ************************************************/
if (!$oauth_credentials = getOAuthCredentialsFile()) {
  echo missingOAuth2CredentialsWarning();
  exit;
}

/************************************************
  Make an API request on behalf of a user. In
  this case we need to have a valid OAuth 2.0
  token for the user, so we need to send them
  through a login flow. To do this we need some
  information from our API console project.
 ************************************************/
/************************************************
 * NOTICE:
 * The redirect URI is to this page, e.g:
 * http://localhost:8080/simplefileupload.php
 ************************************************/
$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];



$client = new Google_Client();
$client->setAuthConfig($oauth_credentials);
$client->setRedirectUri($redirect_uri);
$client->addScope([
"https://www.googleapis.com/auth/youtube.readonly",
"https://www.googleapis.com/auth/youtube.force-ssl",
"https://www.googleapis.com/auth/yt-analytics.readonly",
"https://www.googleapis.com/auth/youtube",
"https://www.googleapis.com/auth/yt-analytics-monetary.readonly"
]);






/************************************************
 * When we create the service here, we pass the
 * client to it. The client then queries the service
 * for the required scopes, and uses that when
 * generating the authentication URL later.
 ************************************************/
// Define an object that will be used to make all API requests.

  //$youtube = new Google_Service_YouTubeAnalytics($client);
  $youtubeData = new Google_Service_YouTube($client);
  
/************************************************
 * If we're logging out we just need to clear our
 * local access token in this case
 ************************************************/
if (isset($_REQUEST['logout'])) {
  unset($_SESSION['access_token']);
}

/************************************************
 * If we have a code back from the OAuth 2.0 flow,
 * we need to exchange that with the
 * Google_Client::fetchAccessTokenWithAuthCode()
 * function. We store the resultant access token
 * bundle in the session, and redirect to ourself.
 ************************************************/
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token);
  // store in the session also
  $_SESSION['access_token'] = $token;

  // redirect back to the example
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

/************************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 ************************************************/
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}

/************************************************
  If we're signed in and have a request to shorten
  a URL, then we create a new URL object, set the
  unshortened URL, and call the 'insert' method on
  the 'url' resource. Note that we re-store the
  access_token bundle, just in case anything
  changed during the request - the main thing that
  might happen here is the access token itself is
  refreshed if the application has offline access.
 ************************************************/
if ($client->getAccessToken() && isset($_GET['url'])) {
  $url = new Google_Service_Urlshortener_Url();
  $url->longUrl = $_GET['url'];
  $short = $service->url->insert($url);
  $_SESSION['access_token'] = $client->getAccessToken();
}
?>

<div class="box">
<?php if (isset($authUrl)): ?>
  <div class="request">
    <a class='login' href='<?= $authUrl ?>'>Connect Me!</a>
  </div>
<?php elseif (empty($short)): ?>
  <form id="url" method="GET" action="<?= $_SERVER['PHP_SELF'] ?>">
    <input name="url" class="url" type="text">
    <input type="submit" value="Shorten">
  </form>
  <a class='logout' href='?logout'>Logout</a>

<?php endif ?>
</div>


<?php 
 if ($client->getAccessToken()){
	 
   $_SESSION['access_token'] = $client->getAccessToken();
	 try{
     
    
    $id = "channel==wDs0VWf5TWKxDD2RQHwgGg";
    $start_date = "2013-03-15";
    $end_date = "2015-11-06";
    $metrics = "likes,views";
    $optParams = array(); 
    
    /*
    $response = $youtube->reports->query( $id, $start_date, $end_date, $metrics, $optParams );
    var_dump($response);
    foreach( $response->getrows() as $row){
      echo sprintf(" <p>This data is weird : %s  %d  %s %d </p>", $response->getColumnHeaders()[0]['name'], $row[0], $response->getColumnHeaders()[1]['name'], $row[1]);
      
    }
    */
    echo "<P>";
    $part = "id";
    $opt  = array( 
      'mine' => true
    );
    
    $response = $youtubeData->channels->listChannels($part, $opt);
   
    echo $response->getitems()[0]["id"];
     echo "<BR>";
    echo json_encode($response);
    // var_dump($response);
    
    
    echo "</P>";
    

   }
   catch (Google_Service_Exception $e) {
     echo $e->getMessage();
   } catch (Google_Exception $e) {
      echo $e->getMessage();
  }
     
	 
	 echo "DONE";
	 
 }

?>







<?php
echo pageFooter(__FILE__);
