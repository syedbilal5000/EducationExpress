<?php
include ("DBClass.php");
Class Controller extends DBClass
{
    public $conn;
    function __construct() {
        $this->conn = $this->db_connect();
    }
    function view_user($username, $password)
    {
        $sql="SELECT * from user WHERE username='$username' AND password='$password'";
        $result = $this->conn->query($sql);
        return $result;
    }
	function add_user($first_name, $last_name, $username, $email, $password, $dob, $gender, $contact, $location)
    {
        $sql="INSERT INTO user (first_name, last_name, username, email, password, dob, gender, contact, location) 
		VALUES ('$first_name', '$last_name', '$username', '$email', '$password', '$dob', '$gender', '$contact', '$location')";
        if($this->conn->query($sql) == TRUE)
			return true;
		else
			return "Error: " . $sql . "<br>" . $this->$conn->error;
		/*
		if($this->conn->query($sql) == TRUE)
			return "Successfully insert";
		else
			return "Error: " . $sql . "<br>" . $this->conn->error;
		*/
    }
}