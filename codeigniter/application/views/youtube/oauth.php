
Loading stuff...

<?php

if( isset($redirect_uri) ){
	error_log("what is coming here is $redirect_uri");
	if( isset($_SESSION['access_token']) )
		error_log("ACCESS TOKEN ". $_SESSION['access_token']);
	else
		error_log("NOOOOOOOOOOOOO access token");
	header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}
else{
	echo "header unset";
}



?>
