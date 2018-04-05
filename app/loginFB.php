<?php
	session_start();
	include 'controller.php';
	require_once 'autoload.php';
	$objController=new Controller();
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\FacebookResponse;
	use Facebook\FacebookSDKException;
	use Facebook\FacebookRequestException;
	use Facebook\FacebookAuthorizationException;
	use Facebook\GraphObject;
	use Facebook\Entities\AccessToken;
	use Facebook\HttpClients\FacebookCurlHttpClient;
	use Facebook\HttpClients\FacebookHttpable;
	
	// Edit Following 2 Lines
	FacebookSession::setDefaultApplication( '396439150748798','5d3554746643a505ec2d7e54dc62c44a' );
	$helper = new FacebookRedirectLoginHelper('http://localhost/FYP/app/Social_Login/Social_Login/loginFB.php');
	
	try {$session = $helper->getSessionFromRedirect();} catch( FacebookRequestException $ex ) {} catch( Exception $ex ) {}
	if ( isset( $session ) ) 
	{
		$request = new FacebookRequest( $session, 'GET', '/me?fields=id,first_name,last_name,name,email' );
		$response = $request->execute();
		$graphObject = $response->getGraphObject();
		$fbid = $graphObject->getProperty('id');
		$fbfirstname = $graphObject->getProperty('first_name');
		$fblastname = $graphObject->getProperty('last_name');
		$fbfullname = $graphObject->getProperty('name');
		$fbemail = $graphObject->getProperty('email');
		if($fbemail==null || $fbemail=='' || $fbemail==' ')
		{
			$fbemail=$fbfirstname.$fblastname.$fbid.'@gmail.com';
		}
		$_SESSION['oauth_provider'] = 'Facebook'; 
		$_SESSION['oauth_uid'] = $fbid; 
		$_SESSION['first_name'] = $fbfirstname; 
		$_SESSION['last_name'] = $fblastname; 
		$_SESSION['email'] = $fbemail;
		$_SESSION['login']='yes';
		$fbUserData = array(
			'oauth_provider'=> 'Facebook',
			'oauth_uid'     => $fbid,
			'first_name'    => $fbfirstname,
			'last_name'     => $fblastname,
			'email'         => $fbemail
		);
		$user=$objController->user($fbUserData);
		$_SESSION['uid']=$user;
		header("Location: index.php");
	} 
	else 
	{
		$loginUrl = $helper->getLoginUrl();
		header("Location: ".$loginUrl);
	}
?>