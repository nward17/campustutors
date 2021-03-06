<?php
	// Start the PHP session
	session_start();

	// Only run the API if POST data exists
	if(isset($_POST) && !empty($_POST)) {
		define('access', true);
		include('database.php');

	    $action = $_POST['action'];

	    // Call correct API function depending on POST
	    switch($action) {
	    	case 'getUniversities' : getUniversities(); break;
	    	case 'register' : register(); break;
	    	case 'signIn' : signIn(); break;
	        case 'getUser' : getUser(); break;
	        case 'changeProfileImage' : changeProfileImage(); break;
	        case 'changeUserRate' : changeUserRate(); break;
	        case 'getCourses' : getCourses(); break;
	        case 'getCoursesForProfile' : getCoursesForProfile(); break;
	        case 'updateCourseTags' : updateCourseTags(); break;
	        case 'findTutors' : findTutors(); break;
	        case 'requestTutor' : requestTutor(); break;
	        case 'getSessionInformation' : getSessionInformation(); break;
	        case 'updateTutorRating' : updateTutorRating(); break;
	        case 'updateSession' : updateSession(); break;
	        case 'checkForUnreadMessages' : checkForUnreadMessages(); break;
	        case 'insertDeviceID' : insertDeviceID(); break;
	        case 'checkForSessions' : checkForSessions(); break;
	    }
	}

	// Register a new user
	function register() {
		global $conn;

		// Stop MySQL injection
		$university_id = stripslashes($_POST['universityID']);
		$email = stripslashes($_POST['email']);
		$password = password_hash(stripslashes($_POST['password']), PASSWORD_DEFAULT);
		$first_name = stripslashes($_POST['firstName']);
		$last_name = stripslashes($_POST['lastName']);

		// Check for active sessions
		$stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(array(':email' => $email));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) > 0) {
        	// Account already exists for the email
        	echo count($rows);
        } else {
        	// Insert the account
        	$stmt = $conn->prepare("INSERT INTO users (universities_id, email, password, first_name, last_name, account_creation) VALUES (:universities_id, :email, :password, :first_name, :last_name, NOW())");
	    	$stmt->execute(array(':universities_id' => $university_id, ':email' => $email, ':password' => $password, ':first_name' => $first_name, ':last_name' => $last_name));
        	echo 0;
        }
	}

	// Authenticate and sign in a user
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

        	// Image exists
			if(getimagesize('../images/profiles/' . $user['image']) !== false) {
				$_SESSION['image'] = $user['image'];
			} else {
				$_SESSION['image'] = 'placeholder.png';
			}

        	echo $user['id'];
        } else {
        	echo 'failure';
        }
	}

	// Get user information for the edit profile page
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

	// Change a user's profile picture
	function changeProfileImage() {
		global $conn;

		// Get the new profile image
		$profile_image = $_FILES['image'];

		// Get the user's email
		$email = $_SESSION['email'];

		$destination = '../images/profiles/';
		$file_name = $email . '.' . strtolower(pathinfo($profile_image['name'], PATHINFO_EXTENSION));
		$full_path = $destination . $file_name;

		// Image is valid
		if(getimagesize($profile_image["tmp_name"]) !== false) {
			// Delete old profile picture
			foreach (glob($destination . $email . '*.*') as $filename) {
    			unlink($filename);
			}

			// Move the file to the profiles directory
			move_uploaded_file($profile_image["tmp_name"], $full_path);
		}

		// Update the user's profile image
		$stmt = $conn->prepare("UPDATE users SET image = :image WHERE email = :email");
        if ($stmt->execute(array(':email' => $email, ':image' => $file_name))) {
        	$_SESSION['image'] = $file_name;
        }
	}

	// Change the hourly rate of a user
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

	// Get a list of universities for the registration page
	function getUniversities() {
		global $conn;

		// Grab list of universities
		$stmt = $conn->prepare("SELECT id, name, abbreviation FROM universities");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
	}

	// Get a list of courses so a user can search for a tutor by course
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

	// Get a list of courses that a user can tutor in
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

	// Update the courses that a user wants to tutor in
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

	// Get a list of tutors based on a course for the home page
	function findTutors() {
		global $conn;

		// Get the course tag
		$course_tag = $_POST['courseTag'];

		// Get the user's email
		$email = $_SESSION['email'];

		// Grab a list of tutors based on the course id
		$stmt = $conn->prepare("SELECT id, first_name, IFNULL(image, 'placeholder.png') as image, rating, hourly_rate, completed_sessions FROM users WHERE FIND_IN_SET(:course_tag, course_tags) > 0 AND email != :email ORDER BY rating DESC");
		$stmt->execute(array(':email' => $email, ':course_tag' => $course_tag));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
	}

	// Create a tutoring session between a tutee and tutor
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

	// Get tutoring session information such as the status and who is the tutor
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

	// Update the rating for a tutor after a session has ended
	function updateTutorRating() {
		global $conn;

		// Get the tutors id
		$tutor_id = $_POST['tutorID'];

		// Get the rating
		$rating = $_POST['rating'];

		$stmt = $conn->prepare("UPDATE users SET rating = (((completed_sessions - 1) * rating) / (completed_sessions)) + (:rating / completed_sessions) WHERE id = :tutor_id");
	    $stmt->execute(array(':rating' => $rating, ':tutor_id' => $tutor_id));
	}

	// Update the status of a tutoring session
	// status of 0 = session has been requested
	// status of 1 = session has started
	// status of 2 = session has ended
	// status of 3 = session was canceled
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
			// Session is finished
		    case "stop-session":

				// Get the tutor for the session
				$stmt = $conn->prepare("SELECT tutor_id FROM requests WHERE id = :session_id");
		        $stmt->execute(array(':session_id' => $session_id));
		        $row = $stmt->fetch(PDO::FETCH_ASSOC);

		        // Get the tutor and tutee ids
		        $tutor_id = $row['tutor_id'];

		        // Increment the tutors number of completed sessions
				$stmt = $conn->prepare("UPDATE users SET completed_sessions = (completed_sessions + 1) WHERE id = :tutor_id");
        		$stmt->execute(array(':tutor_id' => $tutor_id));

        		// Delete the chat between tutor and tutee
		        deleteChat($session_id);
		        $status = 2;
		        break;
		}

		// Update the session wih the new status
		$stmt = $conn->prepare("UPDATE requests SET status = :status WHERE id = :session_id");
        $stmt->execute(array(':status' => $status, ':session_id' => $session_id));
	}

	// Delete the chat between and tutor and tutee
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

	// Checks for unread messages for the currently logged in user
	// Used for the chat bubble in the navbar
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

		// Get id of current user
		$user_id = $_POST['userID'];

		// Get the device id
		$device_id = $_POST['deviceID'];

		// Delete all devices for user (could be an old device, app reinstall?)
		// Even if it isn't a new device, we delete it and insert it again regardless
		$stmt = $conn->prepare("DELETE FROM mobile_devices WHERE user_id = :user_id");
		$stmt->execute(array(':user_id' => $user_id));

		// Insert the device id and user id if it doesn't exist, otherwise update existing device id with user id
		$stmt = $conn->prepare("INSERT INTO mobile_devices (user_id, device_id) VALUES (:user_id, :device_id) ON DUPLICATE KEY UPDATE user_id = IF(VALUES(user_id) = 0, user_id, VALUES(user_id))");
		$stmt->execute(array(':user_id' => $user_id, ':device_id' => $device_id));
	}

	// Send a push notification when a message is sent
	// NOTE: This function is accessed directly from Arrowchat's send_message.php
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

		// Send the notification
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

	// Check if the current user has any active sessions
	function checkForSessions() {
		global $conn;

		// Get id of current user
		$user_id = $_SESSION['id'];

		// Check for active sessions
		$stmt = $conn->prepare("SELECT id FROM requests WHERE (tutor_id = :user_id OR tutee_id = :user_id) AND (status = 0 OR status = 1)");
        $stmt->execute(array(':user_id' => $user_id));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) > 0) {
        	echo count($rows);
        } else {
        	echo 0;
        }
	}