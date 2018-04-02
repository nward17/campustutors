<!DOCTYPE HTML>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0 minimal-ui"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="shortcut icon" type="image/png" href="images/favicon-16x16.png"/>

    <title>CampusTeachers | On-Demand Tutoring</title>

    <link href="styles/framework.css"                rel="stylesheet" type="text/css">
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <link href="styles/animate.css"                  rel="stylesheet" type="text/css">
    <link href="styles/bootstrap.min.css"            rel="stylesheet" type="text/css">
    <link href="styles/easy-autocomplete.css"        rel="stylesheet" type="text/css">
    <link href="styles/jquery.tag-editor.css"        rel="stylesheet" type="text/css">
    <link href="styles/style.css?version=6"          rel="stylesheet" type="text/css">

    <script type="text/javascript" src="scripts/jquery.js"></script>
    <script type="text/javascript" src="scripts/jqueryui.js"></script>
    <script type="text/javascript" src="scripts/popper.min.js"></script>
    <script type="text/javascript" src="scripts/bootstrap.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.easy-autocomplete.min.js"></script>
    <script type="text/javascript" src="scripts/framework.plugins.js"></script>
    <script type="text/javascript" src="scripts/jquery.tag-editor.js"></script>
    <script type="text/javascript" src="scripts/custom.js"></script>

    <!-- Arrowchat -->
    <link type="text/css" rel="stylesheet" id="arrowchat_css" media="all" href="arrowchat/external.php?type=css" charset="utf-8" />
    <script type="text/javascript" src="arrowchat/includes/js/jquery.js"></script>
    <script type="text/javascript" src="arrowchat/includes/js/jquery-ui.js"></script>
</head>
<body>

<!-- Arrowchat -->
<script type="text/javascript" src="arrowchat/external.php?type=djs" charset="utf-8"></script>
<script type="text/javascript" src="arrowchat/external.php?type=js" charset="utf-8"></script>
    
<div id="preloader">
	<div id="status">
    	<p class="center-text">
			Finding tutors...
        </p>
    </div>
</div>

<script>
    // Assign latest Android device ID to user
    if (typeof app !== 'undefined') {
        var userID = "<?php echo $_SESSION['id']; ?>";
        app.insertDeviceID(userID);
    }
</script>