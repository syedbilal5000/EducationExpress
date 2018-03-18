<?php 




	$firstname= $_POST["fname"];
	$lastname= $_POST["lname"];
	$email=$_POST["email"];
	$password=$_POST["password"];
	$confirmpassword=$_POST["confirmpassword"];
	$birthday=$_POST["bday"];
	$gender=$_POST["gender"];
	$contact=$_POST["phone"];
	$location=$_POST["location"];

	$conn= mysqli_connect("localhost","root","","education express");
	if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }

 	$sql="INSERT INTO teacher (firstname, lastname, birthdate, gender, contact, email, password, confirmpassword, location, teacher_id)
VALUES ('$firstname', '$lastname', '$birthday', '$gender', '$contact', '$email', '$password', '$confirmpassword', '$location', NULL)";


if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();




 ?>