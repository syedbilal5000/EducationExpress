<?php
class DBClass
{
    public $conn;
    function db_connect()
    {
        session_start();
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "education_express";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error)
            die("Connection failed: " . $conn->connect_error);
        
        return $conn;
    }
}