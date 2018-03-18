<?php 


	$username= $_POST["uname"];
	$password= $_POST["psw"];


 	$conn= mysqli_connect("localhost","root","","education express");
 	if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 	$sql="select * from teacher";
 	$result = $conn->query($sql);

 	while($row = $result->fetch_assoc()) {
        if ($row["email"] == $username && $row["password"] == $password) {
        	$myfile = fopen("../welcome/welcome.html", "r") or die("Unable to open file!");
            echo fread($myfile,filesize("../welcome/welcome.html"));
            fclose($myfile);
        } 
    }

$conn->close();
	
 ?>


