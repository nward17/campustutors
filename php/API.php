<?php
	session_start();

	if(isset($_POST) && !empty($_POST)) {
		define('access', true);
		include('config.php');

	    $action = $_POST['action'];
	    switch($action) {
	    	case 'signIn' : signIn(); break;
	        case 'getUser' : getUser(); break;
	        case 'changeUserRate' : changeUserRate(); break;
	        case 'getCourses' : getCourses(); break;
	        case 'getCoursesForProfile' : getCoursesForProfile(); break;
	        case 'updateCourseTags' : updateCourseTags(); break;
	        case 'findTutors' : findTutors(); break;
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
        	$_SESSION['email'] = $user['email'];
        	$_SESSION['first_name'] = $user['first_name'];
        	$_SESSION['image'] = $user['image'];

        	echo 'success';
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
		$stmt = $conn->prepare("SELECT CONCAT(abbreviation, ' ', `number`) as tag, CONCAT(abbreviation, ' ', `number`, ' - ', `courses`.name) as course FROM courses JOIN degrees ON `courses`.degrees_id = `degrees`.id WHERE `degrees`.universities_id = (SELECT `users`.universities_id FROM users WHERE email = :email) ORDER BY abbreviation ASC, `number` ASC");
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

		// Grab a list of tutors based on the course id
		$stmt = $conn->prepare("SELECT id, first_name, image, rating, hourly_rate, completed_sessions FROM users WHERE FIND_IN_SET(:course_tag, course_tags) > 0 ORDER BY rating ASC");
		$stmt->execute(array(':course_tag' => $course_tag));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
	}