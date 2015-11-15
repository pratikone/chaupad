
Loading stuff...

<?php
if (session_status() == PHP_SESSION_NONE) {
			session_start();
}
if( isset($redirect_uri) ){
	header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
	
}	
else{
	echo "header unset";
}



?>
