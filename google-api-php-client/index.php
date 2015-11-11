<?php
require_once 'vendor/autoload.php';

session_start();

$client = new Google_Client();
$oauth_creds = './oauth-credentials.json';
$client->setAuthConfigFile($oauth_creds);
$client->addScope(
  [
   Google_Service_YouTubeAnalytics::YOUTUBE,
   Google_Service_YouTubeAnalytics::YOUTUBE_READONLY,
   Google_Service_YouTubeAnalytics::YT_ANALYTICS_READONLY
  ]
);

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
  $youtube = new Google_Service_YouTubeAnalytics($client);
  $id = "channel==wDs0VWf5TWKxDD2RQHwgGg";
  $start_date = "2013-03-15";
  $end_date = "2015-11-06";
  $metrics = "likes,views";
  $optParams = array(); 
  
  $response = $youtube->reports->query( $id, $start_date, $end_date, $metrics, $optParams );
  echo json_encode($response);
  
  foreach( $response->getrows() as $row){
      echo sprintf(" <p>This data is weird : %s  %d  %s %d </p>", $response->getColumnHeaders()[0]['name'], $row[0], $response->getColumnHeaders()[1]['name'], $row[1]);
    }
    
  $response = $youtube->reports->query( $id, $start_date, $end_date, $metrics, $optParams );
  echo json_encode($response);
  
    
    
    
  
} else {
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/yt/google-api-php-client/oauth2callback.php';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}
?>
