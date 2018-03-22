<?php
	// 10 year session expiration
	ini_set('session.gc_maxlifetime', 315360000);

	// Check to make sure the user is logged in
	session_start();
	if (!isset($_SESSION['email'])) {
	    return header("Location: signin.php");
	}