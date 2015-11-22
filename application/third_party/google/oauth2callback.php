<?php
require_once 'vendor/autoload.php';

session_start();

$client = new Google_Client();
$oauth_creds = './oauth-credentials.json';
$client->setAuthConfigFile($oauth_creds);
$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/yt/codeigniter/application/third_party/google/oauth2callback.php');
$client->addScope(
  [
   Google_Service_YouTube::YOUTUBE,
   Google_Service_YouTube::YOUTUBE_READONLY,
   Google_Service_YouTubeAnalytics::YT_ANALYTICS_READONLY
  ]
);


if (! isset($_GET['code'])) {
  $auth_url = $client->createAuthUrl();
  header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/yt/codeigniter/application/third_party/google/index.php';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}
?>
