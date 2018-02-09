<?php
	session_start();

	if(isset($_POST) && !empty($_POST)) {
		define('access', true);
		include('database.php');

	    $action = $_POST['action'];
	    switch($action) {
	    	case 'signIn' : signIn(); break;
	        case 'getUser' : getUser(); break;
	        case 'changeUserRate' : changeUserRate(); break;
	        case 'getCourses' : getCourses(); break;
	        case 'getCoursesForProfile' : getCoursesForProfile(); break;
	        case 'updateCourseTags' : updateCourseTags(); break;
	        case 'findTutors' : findTutors(); break;
	        case 'requestTutor' : requestTutor(); break;
	        case 'getSessionInformation' : getSessionInformation(); break;
	        case 'updateSession' : updateSession(); break;
	        case 'checkForUnreadMessages' : checkForUnreadMessages(); break;
	        case 'insertDeviceID' : insertDeviceID(); break;
	        case 'updateDeviceID' : updateDeviceID(); break;
	        case 'newMessagePushNotification' : newMessagePushNotification(); break;
	    }
	} else die('Direct access not permitted.');

	function signIn() {
		global $conn;

		// Get the email and password
		$email = $_POST['email'];
		$password = $_POST['password'];

		// Stop MySQL injection
		$email = stripslashes($email);
		$password = stripslashes($password);

		// Check the login
		$stmt = $conn->prepare("SELECT * FROM users WHERE email = :email ORDER BY id DESC LIMIT 1");
        $stmt->execute(array(':email' => $email));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
       	
       	// Get the user
       	$user = $rows[0];

       	// Check if the password matches
        if (password_verify($password, $user['password'])) {
        	$_SESSION['id'] = $user['id'];
        	$_SESSION['email'] = $user['email'];
        	$_SESSION['first_name'] = $user['first_name'];
        	$_SESSION['image'] = $user['image'];

        	echo $user['id'];
        } else {
        	echo 'failure';
        }
	}

	function getUser() {
		global $conn;

		// Get the user's email
		$email = $_SESSION['email'];

		// Grab user data for the user profile page
		$stmt = $conn->prepare("SELECT *, `universities`.name as university_name, `universities`.state as university_state, `universities`.city as university_city FROM users JOIN universities ON `users`.universities_id = universities.`id` WHERE email = :email ORDER BY `users`.id DESC LIMIT 1");
        $stmt->execute(array(':email' => $email));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows[0]);
	}

	function changeUserRate() {
		global $conn;

		// Get the new hourly rate
		$new_rate = $_POST['newRate'];

		// Get the user's email
		$email = $_SESSION['email'];

		// Update the user's rate
		$stmt = $conn->prepare("UPDATE users SET hourly_rate = :hourly_rate WHERE email = :email");
        $stmt->execute(array(':email' => $email, ':hourly_rate' => $new_rate));
	}

	function getCourses() {
		global $conn;

		// Get the user's email
		$email = $_SESSION['email'];

		// Grab course data for the homepage
		$stmt = $conn->prepare("SELECT `courses`.id, CONCAT(abbreviation, ' ', `number`) as tag, CONCAT(abbreviation, ' ', `number`, ' - ', `courses`.name) as course FROM courses JOIN degrees ON `courses`.degrees_id = `degrees`.id WHERE `degrees`.universities_id = (SELECT `users`.universities_id FROM users WHERE email = :email) ORDER BY abbreviation ASC, `number` ASC");
        $stmt->execute(array(':email' => $email));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
	}

	function getCoursesForProfile() {
		global $conn;

		// Get the user's email
		$email = $_SESSION['email'];

		// Grab course data for the user profile page
		$stmt = $conn->prepare("SELECT CONCAT(abbreviation, ' ', `number`) as course FROM courses JOIN degrees ON `courses`.degrees_id = `degrees`.id WHERE `degrees`.universities_id = (SELECT `users`.universities_id FROM users WHERE email = :email) ORDER BY abbreviation ASC, `number` ASC");
        $stmt->execute(array(':email' => $email));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
	}

	function updateCourseTags() {
		global $conn;

		// Get the new course tags as a comma separated string
		$course_tags = implode(',', $_POST['tags']);

		// Get the user's email
		$email = $_SESSION['email'];

		// Update the user's course tags
		$stmt = $conn->prepare("UPDATE users SET course_tags = :course_tags WHERE email = :email");
        $stmt->execute(array(':email' => $email, ':course_tags' => $course_tags));
	}

	function findTutors() {
		global $conn;

		// Get the course tag
		$course_tag = $_POST['courseTag'];

		// Get the user's email
		$email = $_SESSION['email'];

		// Grab a list of tutors based on the course id
		$stmt = $conn->prepare("SELECT id, first_name, image, rating, hourly_rate, completed_sessions FROM users WHERE FIND_IN_SET(:course_tag, course_tags) > 0 AND email != :email ORDER BY rating DESC");
		$stmt->execute(array(':email' => $email, ':course_tag' => $course_tag));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
	}

	function requestTutor() {
		global $conn;

		// Get the tutor id
		$tutor_id = $_POST['tutorID'];

		// Get the course tag
		$course_id = $_POST['courseID'];

		// Get the user's email
		$email = $_SESSION['email'];

		// Check if a session already exists for the tutor and tutee
		$stmt = $conn->prepare("SELECT id FROM requests WHERE ((tutor_id = :tutor_id AND tutee_id = (SELECT `users`.id FROM users WHERE email = :email)) OR (tutor_id = (SELECT `users`.id FROM users WHERE email = :email) AND tutee_id = :tutor_id)) AND (status = 0 OR status = 1)");
		$stmt->execute(array(':tutor_id' => $tutor_id, ':email' => $email));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $row_count = count($rows);
        
        if ($row_count == 0) {
        	// Create a session for the tutor and tutee
			$stmt = $conn->prepare("INSERT INTO requests (tutor_id, tutee_id, courses_id) VALUES (:tutor_id, (SELECT `users`.id FROM users WHERE email = :email), :course_id)");
	        $stmt->execute(array(':tutor_id' => $tutor_id, ':email' => $email, ':course_id' => $course_id));
        }

        // Return row count to JS so we know if a session already exists
        echo $row_count;
	}

	function getSessionInformation() {
		global $conn;

		// Get id of current user
		$user_id = $_SESSION['id'];

		// Get id of other user that is being chatted with
		$other_user_id = $_POST['otherUserID'];

		// Grab the correct session
		$stmt = $conn->prepare("SELECT * FROM requests WHERE ((tutor_id = :user_id AND tutee_id = :other_user_id) OR (tutor_id = :other_user_id AND tutee_id = :user_id)) ORDER BY id DESC LIMIT 1");
		$stmt->execute(array(':user_id' => $user_id, ':other_user_id' => $other_user_id));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Add some formatted information for JS to parse
        foreach($rows as $key => $value) {
        	$tutor_id = $rows[$key]['tutor_id'];
        	$tutee_id = $rows[$key]['tutee_id'];
        	$status = $rows[$key]['status'];

        	if ($tutor_id == $user_id) {
        		$rows[$key]['tutor'] = 'Yes';
        	} else if ($tutee_id == $user_id) {
        		$rows[$key]['tutor'] = 'No';
        	}
        }

        // *Should* only ever be one active session for a particular tutor and tutee
        echo json_encode($rows[0]);
	}

	function updateSession() {
		global $conn;

		// Get the session action
		$session_action = $_POST['sessionAction'];

		// Get the id of the session that is to be updated
		$session_id = $_POST['sessionID'];

		switch ($session_action) {
		    case "cancel-session":
		    	// Delete the chat between tutor and tutee
		        deleteChat($session_id);
		        $status = 3;
		        break;
		    case "start-session":
		        $status = 1;
		        break;
		    case "stop-session":
		    	// Delete the chat between tutor and tutee
		        deleteChat($session_id);
		        $status = 2;
		        break;
		}

		// Update the session wih the new status
		$stmt = $conn->prepare("UPDATE requests SET status = :status WHERE id = :session_id");
        $stmt->execute(array(':status' => $status, ':session_id' => $session_id));
	}

	function deleteChat($session_id) {
		global $conn;

		// Get the tutor and tutee for the session
		$stmt = $conn->prepare("SELECT tutor_id, tutee_id FROM requests WHERE id = :session_id");
        $stmt->execute(array(':session_id' => $session_id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $tutor_id = $row['tutor_id'];
        $tutee_id = $row['tutee_id'];

        // Delete the Arrowchat session between tutor and tutee
		$stmt = $conn->prepare("UPDATE arrowchat_status SET focus_chat = NULL WHERE (userid = :tutor_id AND focus_chat = :tutee_id) OR (userid = :tutee_id AND focus_chat = :tutor_id)");
        $stmt->execute(array(':tutor_id' => $tutor_id, ':tutee_id' => $tutee_id));

        // Delete the Arrowchat messages between tutor and tutee
        $stmt = $conn->prepare("DELETE FROM arrowchat WHERE (`from` = :tutor_id AND `to` = :tutee_id) OR (`from` = :tutee_id AND `to` = :tutor_id)");
        $stmt->execute(array(':tutor_id' => $tutor_id, ':tutee_id' => $tutee_id));
	}

	function checkForUnreadMessages() {
		global $conn; 

		// Get id of current user
		$user_id = $_SESSION['id'];

		// Select unread messages
		$stmt = $conn->prepare("SELECT id FROM arrowchat WHERE `to` = :user_id AND user_read = 0");
        $stmt->execute(array(':user_id' => $user_id));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) > 0) {
        	echo count($rows);
        } else {
        	echo 0;
        }
	}

	// Insert the device ID of the Android or iOS device into the database
	function insertDeviceID() {
		global $conn;

		// Get the device id
		$device_id = $_POST['deviceID'];

		// Insert the id
		$stmt = $conn->prepare("INSERT INTO mobile_devices (device_id) VALUES (:device_id)");
		$stmt->execute(array(':device_id' => $device_id));
	}

	// Update the device ID of the Android or iOS device to include the user id
	function updateDeviceID() {
		global $conn;

		// Get id of current user
		$user_id = $_POST['userID'];

		// Get the device id
		$device_id = $_POST['deviceID'];

		// Update the device with the user id
		$stmt = $conn->prepare("UPDATE mobile_devices SET user_id = :user_id WHERE device_id = :device_id");
		$stmt->execute(array(':user_id' => $user_id, ':device_id' => $device_id));
	}

	// Send a push notification when a message is sent
	function newMessagePushNotification($to, $message) {
		global $conn;

		// Get the Firebase API key
		global $api_key;

		// Get id of current user
		$from = $_SESSION['id'];

		// Get from user
		$stmt = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
        $stmt->execute(array(':user_id' => $from));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Get the from user's name
		$from_name = $row['first_name'];

		// Get devices
		$stmt = $conn->prepare("SELECT * FROM mobile_devices WHERE user_id = :user_id");
        $stmt->execute(array(':user_id' => $to));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

		// Get the device id
		$device_id = $row['device_id'];

		// Set up the notification message
		$notification = array
		(
			'title' => $from_name . ' has sent you a new message!',
			'body'	=> $message,
			'icon'	=> 'myicon',
			'sound' => 'mySound'
		);

		$fields = array 
		(
			'to'			=> $device_id,
			'notification'	=> $notification
		);

		$headers = array
		(
			'Authorization: key=' . $api_key,
			'Content-Type: application/json'
		);

		// Are you silly? I'm still gonna send it.
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
		curl_setopt($ch,CURLOPT_POST, true);
		curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		curl_close($ch);
	}