<?php

    // Don't run the configuration if direct access to the file is being made
    if(!defined('access')) {
        die('Direct access not permitted.');
    } else {

    	// Firebase API key
    	$api_key = 'AAAAp8zEV4Q:APA91bFq4O-5sxIQBg_hnALCI-ZM1SjSIE7YQunTNpbtyEhpcq9p0V8QFy4vlFSsNCL6KeNTvPaYjOEm0Vd_AKM_j0SKCdATqFpAOI-osEZ1oo6fgs5RxTdmRnUcbkctn3oLuDSf4rnw';

        // Credentials for MySQL server
        $host = 'localhost';
        $username = 'campustutors';
        $password = '@Tutor!';
 
 		// Set up the connection object for MySQL
        $conn = new PDO("mysql:host=$host;dbname=campustutors", $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }