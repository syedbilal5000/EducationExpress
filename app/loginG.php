<?php
	include_once 'src/Google_Client.php';
	include_once 'src/contrib/Google_Oauth2Service.php';
	
	// Edit Following 3 Lines
	$clientId = '862931851962-8mtjfftiivpmlk0tf0879hpneeau1ect.apps.googleusercontent.com'; //Application client ID
	$clientSecret = 'brqnrn2M3Ba_LxMyX8SN2Mtc'; //Application client secret
	$redirectURL = 'http://localhost/FYP/app/Social_Login/Social_Login/'; //Application Callback URL
	
	$gClient = new Google_Client();
	$gClient->setApplicationName('Your Application Name');
	$gClient->setClientId($clientId);
	$gClient->setClientSecret($clientSecret);
	$gClient->setRedirectUri($redirectURL);
	$google_oauthV2 = new Google_Oauth2Service($gClient);
?>