<?php
	session_start();
	include 'controller.php';
	$objController=new Controller();
	if(isset($_SESSION['login']))
	{
		header('Location: home.php');
	}
	else
	{
		session_unset();
	}
?>
<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
	<head>
		<title>Education Express</title>
	</head>
	<body>
		<div>
			<h3>Member Login</h3>
			<form action="login.php" method="POST">
				<div>
					<b>Username</b>
					<input type="text" name="username" id="username" />
				</div>
				<div>
					<b>Password</b>
					<input type="password" name="password" id="password" />
				</div>
				<div>
					<input type="submit" name="login"  value="Login">
				</div>
			</form>
		</div><br>
		<?php
			echo '<a href="loginFB.php"><img src="img/loginfb.png" alt="Login with Facebook" width=222></a><br>';
			include_once 'loginG.php';
			if(isset($_GET['code'])){
				$gClient->authenticate($_GET['code']);
				$_SESSION['token'] = $gClient->getAccessToken();
				header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
			}
			if (isset($_SESSION['token'])) {
				$gClient->setAccessToken($_SESSION['token']);
			}
			if ($gClient->getAccessToken()) 
			{
				$gpUserProfile = $google_oauthV2->userinfo->get();
				$_SESSION['oauth_provider'] = 'Google'; 
				$_SESSION['oauth_uid'] = $gpUserProfile['id']; 
				$_SESSION['first_name'] = $gpUserProfile['given_name']; 
				$_SESSION['last_name'] = $gpUserProfile['family_name']; 
				$_SESSION['email'] = $gpUserProfile['email'];
				$_SESSION['login']='yes';
				$gUserData = array(
					'oauth_provider'=> 'Google',
					'oauth_uid'     => $gpUserProfile['id'],
					'first_name'    => $gpUserProfile['given_name'],
					'last_name'     => $gpUserProfile['family_name'],
					'email'         => $gpUserProfile['email']
				);
				$user=$objController->user($gUserData);
				$_SESSION['uid']=$user;
			} else {
				$authUrl = $gClient->createAuthUrl();
				$output= '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="img/loging.png" alt="Sign in with Google+" width=222/></a>';
			}
			echo $output;
		?>
		<div>
			<br><b><a href='signup.php'>SignUp</a></b>
		</div>
	</body>
</html>