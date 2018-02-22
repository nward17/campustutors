<?php

	/*
	|| #################################################################### ||
	|| #                             ArrowChat                            # ||
	|| # ---------------------------------------------------------------- # ||
	|| #    Copyright �2010-2012 ArrowSuites LLC. All Rights Reserved.    # ||
	|| # This file may not be redistributed in whole or significant part. # ||
	|| # ---------------- ARROWCHAT IS NOT FREE SOFTWARE ---------------- # ||
	|| #   http://www.arrowchat.com | http://www.arrowchat.com/license/   # ||
	|| #################################################################### ||
	
	Modified by Nicolas Ward
	- Commented out search bar and settings button
	- Modified home button by adding "Home" text
	- Removed online users and idle users section, created current sessions section
	- Added cancel session, start session, and stop session buttons
	- Added AJAX to get and set session information
	*/
	
	// ########################## INCLUDE BACK-END ###########################
	require_once (dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'bootstrap.php');

	if (preg_match('#public/mobile#', $_SERVER['REQUEST_URI']))
		$home_url = "../../../";
	else
		$home_url = "../../";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title><?php echo $language[145]; ?></title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
		<meta name="apple-touch-fullscreen" content="yes" />
		
		<link rel="apple-touch-icon" href="images/apple-touch-icon.png"/> 
		<link rel="stylesheet" href="<?php echo $base_url; ?><?php echo AC_FOLDER_PUBLIC; ?>/mobile/includes/css/jquery-mobile.css" />
		<link type="text/css" rel="stylesheet" id="arrowchat_css" media="all" href="<?php echo $base_url; ?><?php echo AC_FOLDER_PUBLIC; ?>/mobile/includes/css/style.css?version=1" charset="utf-8" />
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

		<script type="text/javascript" src="<?php echo $base_url; ?><?php echo AC_FOLDER_INCLUDES; ?>/js/jquery.js"></script>
		<script type="text/javascript" charset="utf-8" src="<?php echo $base_url; ?><?php echo AC_FOLDER_PUBLIC; ?>/mobile/includes/js/jquery-mobile.js"></script>
		<script type="text/javascript" src="<?php echo $base_url; ?><?php echo AC_FOLDER_INCLUDES; ?>/js/jquery-ui.js"></script>
		<script type="text/javascript" src="<?php echo $base_url; ?>external.php?type=djs" charset="utf-8"></script> 
		<script type="text/javascript" src="<?php echo $base_url; ?>external.php?type=mjs" charset="utf-8"></script>
	</head>
    <body>

    	<script>
    		jQuery(window).load(function() {

    			// Check for active tutoring sessions
    			jQuery.ajax({
                    type: "POST",
                    dataType: "text",
                    url: "../../php/API.php",
                    cache : false,
                    data: {action: "checkForSessions"},
                    success: function(numberOfSessions) {
                    	if (numberOfSessions == 0) {
                    		jQuery("#buddylist-container-recent").append('<li data-theme="c" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c" style="border-bottom: 0px;"><div class="ui-btn-inner ui-li"><div class="ui-btn-text" id="arrowchat_userlist_2"><div class="mobile_avatar"></div><span class="list_name">No active tutoring sessions found.</span></a></div><span class="ui-icon ui-icon-arrow-r ui-icon-shadow"></span></div></li>');
                    	}
               		}
            	});

    			// Popup confirmation on session action
    			jQuery(".session-action").click(function() {
    				var sessionAction = jQuery(this).attr("id");
    				var title = "";
    				switch(sessionAction) {
					    case "cancel-session":
					        title = "Are you sure you want to cancel your request?";
					        break;
					    case "start-session":
					        title = "Are you sure you want to start the tutoring session?";
					        break;
					    case "stop-session":
					        title = "Are you sure you want to stop the tutoring session?";
					        break;
					}
    				jQuery("#popupConfirmation").find(".ui-title").html(title);
    				jQuery("#popupConfirmation").popup("open");
    			});

    			// Update session depending on session action
    			jQuery("#confirmSessionAction").click(function() {
    				var otherUserID = jQuery(".chat_user_content").attr('id').split("_")[2];
			        var sessionAction = jQuery(".session-action").attr("id");
			        var sessionID = jQuery(".session-action").attr("data-session-id");

			        jQuery.ajax({
	                    type: "POST",
	                    dataType: "text",
	                    url: "../../php/API.php",
	                    cache : false,
	                    data: {action: "updateSession", sessionAction: sessionAction, sessionID: sessionID},
	                    success: function(resp) {
	                    	// If request is canceled or session is stopped, refresh the page
	                    	if (sessionAction == "cancel-session" || sessionAction == "stop-session") {
                				window.location = window.location.pathname;
                			}
	                    }
                	});
			    });
			});

    		// On chat open, check the session status
    		jQuery(document).on('pagecontainershow', function (e, ui) {
			    var activePage = jQuery(':mobile-pagecontainer').pagecontainer('getActivePage').attr('id');
			    if(activePage == 'page2') {
			    	setTimeout(function() {
					    var otherUserID = jQuery(".chat_user_content").attr('id').split("_")[2];
						checkSession(otherUserID);
					}, 300);
			    }
			});

    		// Check for a session status update
			function checkSession(otherUserID) {
				jQuery.ajax({
                    type: "POST",
                    dataType: "text",
                    url: "../../php/API.php",
                    cache : false,
                    data: {action: "getSessionInformation", otherUserID: otherUserID},
                    success: function(resp) {
                    	var session = JSON.parse(resp);
                    	var sessionStatus = session['status'];
                    	var isTutor = session['tutor'];

                    	jQuery(".session-action").attr("data-session-id", session['id']);

                    	// Session has not been started yet
                    	if (sessionStatus == 0) {
                    		// Tutor can start the session
                    		if (isTutor == "Yes") {
                    			jQuery(".session-action").attr("id", "start-session");
                    			jQuery(".session-action").html("Start Session");
                    		// Tutee can cancel their request
                    		} else {
                    			jQuery(".session-action").attr("id", "cancel-session");
                    			jQuery(".session-action").html("Cancel Request");
                    		}
                    	// Session has been started, tutor or tutee can stop session
                    	} else if (sessionStatus == 1) {
                    		jQuery(".session-action").attr("id", "stop-session");
                    		jQuery(".session-action").html("Stop Session");
                    	} else if (sessionStatus == 2 || sessionStatus == 3) {
                    		// Session was stopped or the request was canceled
                    		window.location = window.location.pathname;
                    	}

                    	// Check for session update every 2 seconds
                    	setTimeout(function(){
	                        checkSession(otherUserID);
	                    }, 2000);
                    }
            	});
			}
    	</script>

        <div data-role="page" id="page1">
            <div data-theme="b" data-role="header" data-position="fixed" data-tap-toggle="false">
                <h3>
                    <!--<input type="text" name="search" class="mobile_search" data-theme="a" placeholder="<?php echo $language[12]; ?>" />-->
                </h3>
				<a data-role="button" id="home-button" data-iconshadow="false" data-iconpos="notext" data-ajax="false" data-theme="b" href="<?php echo $home_url; ?>" data-shadow="false" data-corners="false">
					Home
				</a>

				<!--<a id="settings-button" data-iconpos="notext" data-iconshadow="false" data-theme="b" data-rel="dialog" data-transition="slidedown" href="#settings-page" data-icon="gear" data-shadow="false" data-corners="false"></a>-->
            </div>
            <div data-role="content">
            	<!--
				<ul id="buddylist-container-chatroom" data-role="listview" data-divider-theme="c" data-inset="false"></ul>
				-->
				<ul id="buddylist-container-recent" data-role="listview" data-divider-theme="c" data-inset="false"></ul>
				<!--
                <ul id="buddylist-container-available" data-role="listview" data-divider-theme="c" data-inset="false"></ul>
				<ul id="buddylist-container-away" data-role="listview" data-divider-theme="c" data-inset="false"></ul>
				-->
            </div>
        </div>
		<div data-role="page" id="page2">
            <div data-theme="b" data-role="header" data-position="fixed" data-tap-toggle="false">
                <h3 id="username-header">
					<div id="name-header">
						<?php echo $language[110]; ?>
					</div>
					<div id="status-header">
						<?php echo $language[19]; ?>
						
					</div>
                </h3>
                <a data-role="button" id="back-button" data-direction="reverse" data-transition="slide" data-theme="b" href="#page1" data-icon="arrow-l" data-iconshadow="false" data-iconpos="left" class="back_buttons">
					<?php echo $language[113]; ?>
				</a>

				<!-- Session Action Button -->
				<a class="session-action" data-rel="popup" data-position-to="window" data-transition="pop" style="text-decoration: none;"></a>

				<!-- Confirmation Popup for Session Actions -->
				<div data-role="popup" id="popupConfirmation" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width: 400px;">
				    <div role="main" class="ui-content">
				        <h3 class="ui-title">Are you sure you want to start this session?</h3>
				        <a href="#" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b" style="color: #0084FF;" data-rel="back">Cancel</a>
				        <a href="#" id="confirmSessionAction" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b" style="color: #0084FF;" data-rel="back" data-transition="flow">Yes</a>
				    </div>
				</div>

            </div>
            <div data-role="content" class="chat_user_content">
            </div>
            <div data-theme="d" data-role="footer" data-position="fixed" data-tap-toggle="false">
                <div data-role="fieldcontain">
					<div style="width:100%; float:left; margin-top:-5px;padding-right:0px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing: border-box;margin-bottom:3px">
						<div class="arrowchat_giphy_box">
							<div class="arrowchat_giphy_image_wrapper"></div>
							<label class="arrowchat_giphy_search_wrapper">
								<input type="text" class="arrowchat_giphy_search" placeholder="<?php echo $language[214]; ?>" value="" tabindex="0" />
								<div class="giphy_cancel"><?php echo $language[222]; ?></div>
							</label>
						</div>
					</div>
					<input id="textinput1" placeholder="<?php echo $language[208]; ?>" value="" type="text" />
					<div class="msg_controls">
						<div id="arrowchat_upload_button"><div id="arrowchat_chatroom_uploader"> </div></div>
						<div class="arrowchat_giphy_button"> </div>
						<div class="arrowchat_smiley_button"> </div>
					</div>
				</div>
				<a id="send_button" data-role="button" data-inline="true" data-transition="none" data-theme="b" href="javascript:;" style="position:absolute;top:14px;right:10px">
					<?php echo $language[114]; ?>
				</a>
				<div class="smiley_box_wrapper" id="smiley_box_wrapper2"></div>
            </div>
		</div>
		<div data-role="page" id="page3">
			<div data-role="panel" data-theme="a" data-position="right" id="user-panel">
				<ul id="chatroom-users-list" data-role="listview" data-divider-theme="c" data-inset="false"></ul>
			</div>
            <div data-theme="b" data-role="header" data-position="fixed" data-tap-toggle="false">
                <h3 id="chatroom-header">
					<?php echo $language[128]; ?>
                </h3>
                <a data-role="button" id="back-button-chatroom" data-direction="reverse" data-transition="slide" data-theme="b" href="#page1" data-icon="arrow-l" data-iconshadow="false" data-iconpos="left" class="back_buttons">
					<?php echo $language[113]; ?>
				</a>
				<a data-role="button" id="users-button-chatroom" data-display="push" data-theme="b" data-icon="bars" href="#user-panel" data-iconpos="notext"></a>
            </div>
            <div data-role="content" class="chat_room_content">
            </div>
            <div data-theme="d" data-role="footer" data-position="fixed" data-tap-toggle="false">
                <div data-role="fieldcontain">
					<div style="width:100%; float:left; margin-top:-5px;padding-right:0px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing: border-box;margin-bottom:3px">
						<div class="arrowchat_giphy_box2">
							<div class="arrowchat_giphy_image_wrapper2"></div>
							<label class="arrowchat_giphy_search_wrapper2">
								<input type="text" class="arrowchat_giphy_search2" placeholder="<?php echo $language[214]; ?>" value="" tabindex="0" />
								<div class="giphy_cancel2"><?php echo $language[222]; ?></div>
							</label>
						</div>
					</div>
					<input id="textinput2" maxlength="<?php echo $chatroom_message_length; ?>" placeholder="<?php echo $language[208]; ?>" value="" type="text" />
					<div class="msg_controls2">
						<div id="arrowchat_upload_button2"><div id="arrowchat_chatroom_uploader2"> </div></div>
						<div class="arrowchat_giphy_button2"> </div>
						<div class="arrowchat_smiley_button2"> </div>
					</div>
				</div>
				<a id="send_button_chatroom" data-role="button" data-inline="true" data-iconshadow="false" data-transition="none" data-theme="b" href="javascript:;" style="position:absolute;top:14px;right:10px">
					<?php echo $language[114]; ?>
				</a>
				<div class="smiley_box_wrapper" id="smiley_box_wrapper3"></div>
            </div>
		</div>
		<div data-role="page" id="password-page">
			<div data-theme="b" data-role="header" data-tap-toggle="false">
				<h1><?php echo $language[128]; ?></h1>
			</div>
			<div data-theme="d" data-role="content" id="chatroom-message">
				<label for="room-password"><?php echo $language[138]; ?></label>
				<input type="text" name="room-password" id="room-password" value="" />
				<a href="#page3" data-theme="b" data-role="button" id="submit-chatroom-password"><?php echo $language[139]; ?></a>
			</div>
		</div>
		<div data-role="dialog" id="user-error">
			<div data-theme="b" data-role="header" data-tap-toggle="false">
				<h1><?php echo $language[110]; ?></h1>
			</div>
			<div data-theme="d" data-role="content" id="user-error-content"></div>
		</div>
		<div data-role="dialog" id="chatroom-error">
			<div data-theme="b" data-role="header" data-tap-toggle="false">
				<h1><?php echo $language[128]; ?></h1>
			</div>
			<div data-theme="d" data-role="content" id="chatroom-error-content"></div>
		</div>
		<div data-role="dialog" id="user-options">
			<div data-theme="b" data-role="header" data-tap-toggle="false">
				<h1></h1>
			</div>
			<div data-theme="d" data-role="content" id="user-options-content"></div>
		</div>
		<div id="arrowchat_user_upload_queue" class="arrowchat_users_upload_queue"></div>
		<div class="arrowchat_message_box">
			<div class="arrowchat_message_box_wrapper">
				<div class="message_avatar"></div>
				<div class="message_info_wrapper">
					<div class="message_username"></div>
					<div class="message_msg"></div>
				</div>
				<div class="arrowchat_clearfix"></div>
			</div>
		</div>
		<div data-role="page" id="settings-page">
			<div data-theme="b" data-role="header" data-tap-toggle="false">
				<h1><?php echo $language[129]; ?></h1>
			</div>
			<div data-theme="d" data-role="content">
				<div style="margin-bottom:60px" id="chatroom-settings-container">
					<div style="float:left; width: 60%; margin-top: 11px; font-size:18px">
						<?php echo $language[130]; ?>
					</div>
					<div style="float:right;">
						<form>
							<select name="flip-show-chatroom" id="flip-show-chatroom" data-role="slider">
								<option value="off"><?php echo $language[133]; ?></option>
								<option value="on"><?php echo $language[132]; ?></option>
							</select>
						</form>
					</div>
				</div>
				<div>
					<div style="float:left; width: 60%; margin-top: 11px; font-size:18px">
						<?php echo $language[131]; ?>
					</div>
					<div style="float:right;">
						<form>
							<select name="flip-show-idle" id="flip-show-idle" data-role="slider">
								<option value="off"><?php echo $language[133]; ?></option>
								<option value="on"><?php echo $language[132]; ?></option>
							</select>
						</form>
					</div>
					<div class="arrowchat_clearfix"></div>
				</div>
				<div>
					<div style="float:left; width: 60%; margin-top: 11px; font-size:18px">
						<?php echo $language[211]; ?>
					</div>
					<div style="float:right;">
						<form>
							<select name="flip-hide-mobile" id="flip-hide-mobile" data-role="slider">
								<option value="off"><?php echo $language[133]; ?></option>
								<option value="on"><?php echo $language[132]; ?></option>
							</select>
						</form>
					</div>
					<div class="arrowchat_clearfix"></div>
				</div>
				<div>
					<div style="float:left; width: 60%; margin-top: 11px; font-size:18px">
						<?php echo $language[96]; ?>
					</div>
					<div style="float:right;">
						<form>
							<select name="unblock-mobile" id="unblock-mobile" data-mini="true" data-inline="true">
								<option value="0"><?php echo $language[118]; ?></option>
							</select>
						</form>
					</div>
					<div class="arrowchat_clearfix"></div>
				</div>
				<div id="change-name-wrapper" style="display:none">
					<div style="float:left; width: 60%; margin-top: 11px; font-size:18px">
						<?php echo $language[244]; ?>
					</div>
					<div style="float:right;">
						<form>
							<input maxlength="25" style="width:120px;margin-top:5px;" type="text" name="change-name" id="change-name" data-mini="true" data-theme="b" />
						</form>
					</div>
					<div class="arrowchat_clearfix"></div>
				</div>
			</div>
		</div>
    </body>
</html>