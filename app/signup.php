<?php
session_start();
include("controller.php");
$objController=new Controller();
if(isset($_POST['signup']))
{
    echo "";
	$first_name=$_POST['first_name'];
    $last_name=$_POST["last_name"];
	$username=$_POST['username'];
    $email=$_POST["email"];
	if($_POST["create"] == $_POST["confirm"])
		$password=$_POST["create"];
	if(empty($_POST['dob']))
		$dob=NULL;
	else
		$dob=$_POST['dob'];
	if(empty($_POST['gender']))
		$gender=NULL;
	else
		$gender=$_POST['gender'];
	if(empty($_POST['contact']))
		$contact=NULL;
	else
		$contact=$_POST['contact'];
	if(empty($_POST['location']))
		$location=NULL;
	else
		$location=$_POST['location'];
	$check_username=$objController->check_user($username,1);
	$check_email=$objController->check_user($email,2);
	if($check_username==1 && $check_email==1) {
		$result=$objController->add_user($first_name, $last_name, $username, $email, $password, $dob, $gender, $contact, $location);
		echo '<script type="text/javascript">alert("' . $result . '")</script>';
		$_SESSION['first_name'] = $first_name; 
		$_SESSION['last_name'] = $last_name; 
		$_SESSION['email'] = $email;
		$_SESSION['uid'] = $result;
		$_SESSION['login']='yes';
		header('Location: index.php');
	}
	elseif($check_username==0) {
		echo '<script type="text/javascript">alert("Username already taken.")</script>';
		
		//header('Location: signup.php');
	}
	elseif($check_email==0) {
		echo '<script type="text/javascript">alert("Email already taken.")</script>';
		
		//header('Location: signup.php');
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Education Express</title>
	</head>
	<body>
		<form action="" method="POST">
			<div>
				<b>First Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
				<input type="text" name="first_name" id="first_name" />
			</div>
			<div>
				<b>Last Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
				<input type="text" name="last_name" id="last_name" />
			</div>
			<div>
				<b>Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
				<input type="text" name="username" id="username" />
			</div>
			<div>
				<b>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
				<input type="text" name="email" id="email" />
			</div>
			<div>
				<b>Create a password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
				<input type="password" name="create" id="create" />
			</div>
			<div>
				<b>Confirm your password</b>
				<input type="password" name="confirm" id="confirm" />
			</div>
			<div>
				<b>Date of Birth&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
				<input type="text" name="dob" id="dob" />
			</div>
			<div>
				<b>Gender&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
				<!-- <input type="radio" name="gender" id="gender" /> -->
				<input id="myRadio1" type="radio" name="gender" value="male" /> Male
				<input id="myRadio2" type="radio" name="gender" value="female" /> Female<br>
			</div>
			<div>
				<b>Contact&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
				<input type="text" name="contact" id="contact" />
			</div>
			<div>
				<b>Location&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
				<input type="text" name="location" id="location" />
			</div>
			<div>
				<input type="submit" name="signup"  value="Signup">
			</div>
			
		</form>
	</body>
</html>