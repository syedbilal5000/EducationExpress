<?php
session_start();
include 'controller.php';
$objController=new Controller();
echo "Hello, ";
if(isset($_POST['login']))
{
    echo session_status();;
	$username=$_POST['username'];
    $password=$_POST["password"];
    $result=$objController->view_user($username, $password);
    if($result->num_rows>0)
    {
        $row = $result->fetch_assoc();
        $_SESSION['uid']=$row['user_id'];
        if($row['user_id']!="")
        {
            $_SESSION['user_id']=$row['user_id'];
            //session_start();
            echo "$username Logged In!!!<br>";
        }
        else
        {
            //$_SESSION['admin']=true;
            echo "Admin Logged In!!!";
            
        }
		$_SESSION['first_name'] = $row['first_name']; 
		$_SESSION['last_name'] = $row['last_name']; 
		$_SESSION['email'] = $row['email'];
		$_SESSION['login']='yes';
    }
    else
        echo "Invalid Username/Password<br><a href='index.php'>Try Again</a>";
	header('Location: index.php');
}
?>
<html>
    <head>
        <title>Home</title>
        <!-- <link rel="stylesheet" href="css/Mainbody.css"/>
        <link rel="stylesheet" href="css/mycss.css"/> -->
    </head>
</html>