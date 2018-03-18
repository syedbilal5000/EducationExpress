<?php
include("controller.php");
$objController=new Controller();
echo "Hello<br>";
if(isset($_POST['signup']))
{
    echo "";
	$first_name=$_POST['first_name'];
    $last_name=$_POST["last_name"];
	$username=$_POST['username'];
    $email=$_POST["email"];
	if($_POST["create"] == $_POST["confirm"])
		$password=$_POST["create"];
	$dob=$_POST['dob'];
    $gender=$_POST["gender"];
	$contact=$_POST['contact'];
    $location=$_POST["location"];
	echo $first_name . '<br>';
	echo $last_name . '<br>';
	echo $username . '<br>';
	echo $email . '<br>';
	echo $password . '<br>';
	echo $dob . '<br>';
	echo $gender . '<br>';
	echo $contact . '<br>';
	echo $location . '<br>';
	$result=$objController->add_user($first_name, $last_name, $username, $email, $password, $dob, $gender, $contact, $location);
    echo $result;
}
?>
<html>
    <head>
        <title>Signup</title>
        <!-- <link rel="stylesheet" href="css/Mainbody.css"/>
        <link rel="stylesheet" href="css/mycss.css"/> -->
    </head>
</html>