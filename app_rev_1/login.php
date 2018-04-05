<?php
include("controller.php");
$objController=new Controller();
echo "Hello<br>";
if(isset($_POST['login']))
{
    echo "";
	$username=$_POST['username'];
    $password=$_POST["password"];
    $result=$objController->view_user($username, $password);
    if($result->num_rows>0)
    {
        $row = $result->fetch_assoc();
        $_SESSION['id']=$row['user_id'];
        if($row['user_id']!="")
        {
            $_SESSION['user_id']=$row['user_id'];
            echo "$username Logged In!!!<br>";
        }
        else
        {
            //$_SESSION['admin']=true;
            echo "Admin Logged In!!!";
            
        }
    }
    else
        echo "Invalid Username/Password<br><a href='index.php'>Try Again</a>";
}
?>
<html>
    <head>
        <title>Home</title>
        <!-- <link rel="stylesheet" href="css/Mainbody.css"/>
        <link rel="stylesheet" href="css/mycss.css"/> -->
    </head>
</html>