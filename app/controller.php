<?php
include 'db.php';
Class Controller extends DBClass
{
    function __construct() {
        if(!isset($this->db)){
            // Connect to the database
            //session_start();
            $conn = $this->db_connect();
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
    function view_user($username, $password)
    {
        $sql="SELECT * from user WHERE username='$username' AND password='$password'";
        $result = $this->db->query($sql);
        return $result;
    }
	function add_user($first_name, $last_name, $username, $email, $password, $dob, $gender, $contact, $location)
    {
        $sql="INSERT INTO user (first_name, last_name, username, email, password, dob, gender, contact, location) 
		VALUES ('$first_name', '$last_name', '$username', '$email', '$password', '$dob', '$gender', '$contact', '$location')";
        if($this->db->query($sql) == TRUE) {
			$query = "SELECT user_id FROM user WHERE email = '".$email."'";
			$result = $this->db->query($query);
			$user = $result->fetch_assoc();
			return $user['user_id'];
		}
		else
			return "Error: " . $sql . "<br>" . $this->$db->error;
    }
	function check_user($user, $type)
	{
		if($type==1) {
			$query = "SELECT username from user where username = '".$user."'";
			$result = $this->db->query($query);
			if($result->num_rows>0)
				return 0;
			else
				return 1;
		}
		else {
			$query = "SELECT username from user where email = '".$user."'";
			$result = $this->db->query($query);
			if($result->num_rows>0)
				return 0;
			else
				return 1;
		}
	}
    function user($userData = array())
	{
        if(!empty($userData)){
            //Check whether user data already exists in database
            $prevQuery = "SELECT * FROM user WHERE email = '".$userData['email']."'";
            $prevResult = $this->db->query($prevQuery);
            if($prevResult->num_rows > 0){
                //Update user data if already exists
                $query = "UPDATE user SET first_name = '".$userData['first_name']."', last_name = '".$userData['last_name']."', email = '".$userData['email']."', modified = '".date("Y-m-d h:i:sa")."' WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
                $update = $this->db->query($query);
            }else{
                //Insert user data
                $query = "INSERT INTO user SET oauth_provider = '".$userData['oauth_provider']."', oauth_uid = '".$userData['oauth_uid']."', first_name = '".$userData['first_name']."', last_name = '".$userData['last_name']."', email = '".$userData['email']."', created = '".date("Y-m-d h:i:sa")."', modified = '".date("Y-m-d h:i:sa")."'";
                $insert = $this->db->query($query);
            }
            
            //Get user data from the database
            $query = "SELECT user_id FROM user WHERE email = '".$userData['email']."'";
			$result = $this->db->query($query);
			//echo $result;
            $user = $result->fetch_assoc();
        }
        
        return $user['user_id'];
    }
}