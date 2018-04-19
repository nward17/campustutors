<?php
    // Check if the user is logged in, if not redirect to sign in page
    require_once("php/check_login.php");

    // Otherwise load the header
    include "header.php";
?>

<div class="all-elements">
    <div class="snap-drawers">
        <div class="snap-drawer snap-drawer-left">
            <div class="sidebar-header">
                <a href="#" class="sidebar-logo" style="background-image: url(images/profiles/<?php echo $_SESSION['image']; ?>);"></a>
                <span class="sidebar-message">Welcome back, <?php echo $_SESSION['first_name']; ?>!</span>
                <a href="#" class="sidebar-close"><i class="fas fa-times"></i></a>
            </div>
            <div class="sidebar-breadcrumb">
                Navigation
            </div>
            <ul class="sidebar-menu">
                <li><a href="index.php"><i class="fas fa-home"></i>Search for a Tutor<i class="fas fa-last fa-circle"></i></a></li>
                <li><a href="arrowchat/mobile/"><i class="fas fa-envelope"></i>Messages<i class="fas fa-last fa-circle"></i></a></li>
                <li><a href="profile.php"><i class="fas fa-user"></i>Edit Profile<i class="fas fa-last fa-circle"></i></a></li>
                <li><a href="php/signout.php"><i class="fas fa-sign-out-alt"></i>Sign Out<i class="fas fa-last fa-circle"></i></a></li>
                <li><a href="app" target="_blank"><i class="fab fa-android" style="color: #AAC050;"></i>Download the App<i class="fas fa-last fa-circle"></i></a></li>
            </ul>
        </div>
    </div>
    
    <div id="content" class="snap-content splash">
        <div class="header">
            <a href="#" class="open-nav"><i class="fas fa-bars hamburger-icon"></i></a>
            <div style="text-align: center;">
                <a href="#" class="header-logo"></a>
                <a href="arrowchat/mobile/" class="header-messages">
                    <i class="fas fa-comment" style="margin-top: 18px;"></i>
                    <span class="notification"></span>
                </a>
            </div>
        </div>
        <div class="content content-page">
            <div class="container">
                <p style="height: 200px;">
                    <span class="search-course-wrapper">
                        <input type="text" class="search-course form-control" id="searchCourseHome" placeholder="Start typing a course...">
                    </span>
                </p>

                <div class="requestsContainer"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    // Request the user and initiate a chat between the tutor and tutee
    function requestTutor(tutorID, courseID, courseTag) {

        var requestedTutor = jQuery.ajax({
            url: "php/API.php",
            data: {action: 'requestTutor', tutorID: tutorID, courseID: courseID},
            type: "POST"
        });

        jQuery.when(requestedTutor).done(function (sessionCount) {
            // Open chat whether session already exists or not
            jqac.arrowchat.chatWith(tutorID);

            // No active session exists, send initial correspondence
            if (sessionCount == 0) {
                jqac.arrowchat.sendMessage(tutorID, "Hi! Would you be able to tutor me in " + courseTag + "?");
            }
        });
    }

    (function($) {
        $(function() {

            // Populate the search box with courses
            $.ajax({
                type: "POST",
                dataType: "text",
                url: "php/API.php",
                cache : false,
                data: {action: "getCourses"},
                success: function(resp) {
                    var courses = JSON.parse(resp);
                    var options = {
                        data: courses,
                        getValue: "course",
                        list: {
                            maxNumberOfElements: 100,
                            showAnimation: {
                                type: "slide"
                            },
                            hideAnimation: {
                                type: "slide"
                            },
                            // Get the tutors
                            onChooseEvent: function() {
                                var courseID = $(".search-course").getSelectedItemData().id;
                                var courseTag = $(".search-course").getSelectedItemData().tag;

                                // Set value of input box to course tag
                                $("#searchCourseHome").val(courseTag);

                                $.ajax({
                                    type: "POST",
                                    dataType: "text",
                                    url: "php/API.php",
                                    cache : false,
                                    data: {action: "findTutors", courseTag: courseTag},
                                    success: function(resp) {
                                        var tutors = JSON.parse(resp);

                                        // Clear container
                                        $(".requestsContainer").html("");
                                        
                                        // Loop through tutors and print them to the screen
                                        for (var i = 0; i < tutors.length; i++) {
                                            var tutor = tutors[i];

                                            var tutorBlock =
                                            '' + 
                                            '<div id="tutor-' + tutor.id + '" class="module form-module tutorBlock">' +
                                                '<div class="profile-image-container leftInnerBlock">' +
                                                    '<img class="profile-image tutorImage" src="images/profiles/' + tutor.image + '">' +
                                                    '<span class="tutorName">' + tutor.first_name + '</span>' +
                                                '</div>' +
                                                '<div class="rightInnerBlock">' +
                                                    '<div id="starRating"> '+ (tutor.rating / 20) + ' </div>' +
                                                    '<div class="rating-container">' +
                                                        '<span id="rating" class="stars-container stars-' + tutor.rating + ' tutorRating">★★★★★</span>' +
                                                        '<br>' +
                                                        '<div id="sessions" class="tutorSessions">' + tutor.completed_sessions + ' sessions</div>' +
                                                        '<p class="tutorRateContainer"><i class="fas fa-usd"></i> <span class="tutorRate">' + tutor.hourly_rate + '</span> /hour</p>' +
                                                        '<button class="btn-login" style="font-size: 10pt; font-weight: bold; width: 125px; text-align: center;" type="button" onclick="requestTutor(' + tutor.id + ', \'' + courseID + '\', \'' + courseTag + '\');">Request</button>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>' +
                                            '';

                                            $(".requestsContainer").append(tutorBlock);
                                        }
                                    }
                                });
                            }
                        }
                    };
                    $(".search-course").easyAutocomplete(options);

                    // Sort the results based on the search term
                    $("#searchCourseHome").on("input", function() {

                        // Convert search to lowercase
                        var searchText = $(this).val().toLowerCase();
                        var courseList = options.data;

                        courseList.sort((a, b) => {
                            // Convert to lowercase
                            var course1 = a.course.toLowerCase();
                            var course2 = b.course.toLowerCase();

                            if (course1.startsWith(searchText) && course2.startsWith(searchText)) return course1.localeCompare(course2);
                            else if (course1.startsWith(searchText)) return -1;
                            else if (course2.startsWith(searchText)) return 1;
                             
                            return course1.localeCompare(course2);
                        });
                    });
                }
            });
        });

        // Check for unread messages
        checkForUnreadMessages();
        function checkForUnreadMessages() {
            $.ajax({
                url: "php/API.php",
                data: {action: 'checkForUnreadMessages'},
                type: "POST",
                success: function(resp) {
                    if (resp > 0) {
                        $(".notification").css('display', 'block');
                        $(".notification").html(resp);
                    }
                    setTimeout(function(){
                        checkForUnreadMessages();
                    }, 3000);
                }
            });
        }
    })(jQuery);
</script>

</body>