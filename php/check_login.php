<?php
	// Check to make sure the user is logged in
	session_start();
	if (!isset($_SESSION['email'])) {
	    return header("Location: signin.php");
	}