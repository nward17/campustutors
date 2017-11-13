<?php
    if(!defined('access')) {
        die('Direct access not permitted.');
    } else {

    	// Credentials for MySQL server
        $host = "localhost";
        $username = "campustutors";
        $password = "@Tutor!";
 
 		// Set up the connection object for MySQL
        $conn = new PDO("mysql:host=$host;dbname=campustutors", $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }