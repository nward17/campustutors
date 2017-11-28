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
                <a href="#" class="sidebar-close"><i class="fa fa-times"></i></a>
            </div>
            <div class="sidebar-breadcrumb">
                Navigation
            </div>         
            <ul class="sidebar-menu">
                <li><a href="https://www.nicolasward.com/campustutors/"><i class="fa fa-home"></i>Find a Tutor<i class="fa fa-last fa-circle"></i></a></li>
                <li><a href="https://www.nicolasward.com/campustutors/arrowchat/mobile/"><i class="fa fa-envelope"></i>Messages<i class="fa fa-last fa-circle"></i></a></li>
                <li><a href="https://www.nicolasward.com/campustutors/profile.php"><i class="fa fa-user"></i>Edit Profile<i class="fa fa-last fa-circle"></i></a></li>
                <li><a href="https://www.nicolasward.com/campustutors/php/signout.php"><i class="fa fa-sign-out"></i>Sign Out<i class="fa fa-last fa-circle"></i></a></li>
            </ul>
        </div>
    </div>
    
    <div id="content" class="snap-content splash">
        <div class="header">
            <a href="#" class="open-nav"><i class="fa fa-navicon hamburger-icon"></i></a>
            <div style="text-align: center;">
                <a href="#" class="header-logo"></a>
                <a href="https://www.nicolasward.com/campustutors/arrowchat/mobile/" class="header-messages"><i class="fa fa-comment" style="margin-top: 15px;"></i></i></a>
            </div>
        </div>
        <div class="content content-page">
            <div class="container">
                <div class="module form-module">
                    <div class="form">
                        <center>
                            <div class="profile-image-container">
                                <img class="profile-image" src="images/profiles/<?php echo $_SESSION['image']; ?>">
                            </div>
                            <br>
                            <h2><span id="fullName"></span></h2>
                            <div id="starRating"></div>
                            <div class="rating-container">
                                <span id="rating" class="stars-container">★★★★★</span>
                                <div id="sessions"></div>
                            </div>
                        </center>
                        <br>
                        <p><i class="fa fa-usd"></i> <input id="rate" type="number" min="0" max="50"> /hour</p>
                        <p><i class="fa fa-university"></i> <span id="universityName"></span></p>
                        <p><i class="fa fa-map-marker"></i> <span id="universityLocation"></span></p>
                        <p style="height: 200px;">
                            <span id="tutor-text">I can tutor in...</span>
                            <span class="search-course-wrapper">
                                <input type="text" class="search-course" id="searchCourseProfile" placeholder="course...">
                            </span>
                            <textarea id="courseTags"></textarea>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    (function($) {
        $(function() {

            // Fix for mobile that scrolls the screen down so keyboard does not cover text input
            // TODO: Make global
            $("#rate").click(function() {
                setTimeout(function() {
                    $("#rate")[0].scrollIntoView();
                }, 500);
            });
            $(".search-course").click(function() {
                setTimeout(function() {
                    $(".search-course")[0].scrollIntoView();
                }, 500);
            });

            $("#rate").keyup(function(e) {
                // Get the new rate
                var newRate = $("#rate").val().trim();

                // Make sure the rate is not empty and contains only numbers
                if (newRate.match(/^[0-9]+$/) != null) {
                    $.ajax({
                        url: "php/API.php",
                        data: {action: 'changeUserRate', newRate: newRate},
                        type: "POST",
                        success: function () {}
                    });
                }
            });

            // Get the currently logged in user
            $.ajax({
                url: "php/API.php",
                data: {action: 'getUser'},
                type: "POST",
                success: function (response) {
                    var userData = JSON.parse(response);

                    // Populate the user profile page
                    $("#fullName").html(userData['first_name'] + " " + userData['last_name']);
                    $("#starRating").html(userData['rating'] / 20);
                    $("#rating").addClass("stars-"+userData['rating']);
                    $("#sessions").html(userData['completed_sessions'] + " sessions");
                    $("#rate").val(userData['hourly_rate']);
                    $("#universityName").html(userData['university_name']);
                    $("#universityLocation").html(userData['university_city'] + ", " + userData['university_state']);
                    $("#courseTags").html(userData['course_tags']);

                    // Initiate tag plugin for user courses
                    $("#courseTags").tagEditor({
                        forceLowercase: false,
                        onChange: function(field, editor, tags) {
                            $.ajax({
                                type: "POST",
                                dataType: "text",
                                url: "php/API.php",
                                cache : false,
                                data: {action: "updateCourseTags", tags: tags},
                                success: function(resp) {
                                }
                            });
                        }
                    });
                }
            });

            // Populate the search box with courses
            $.ajax({
                type: "POST",
                dataType: "text",
                url: "php/API.php",
                cache : false,
                data: {action: "getCoursesForProfile"},
                success: function(resp) {
                    var contacts = JSON.parse(resp);
                    var options = {
                        data: contacts,
                        getValue: "course",
                        list: {
                            maxNumberOfElements: 1000,
                            match: {
                                enabled: true
                            },
                            showAnimation: {
                                type: "slide"
                            },
                            hideAnimation: {
                                type: "slide"
                            },
                            onChooseEvent: function() {
                                var course = $(".search-course").getSelectedItemData().course;
                                $("#courseTags").tagEditor("addTag", course);
                            }
                        }
                    };
                    $(".search-course").easyAutocomplete(options);
                }
            });

        });
    })(jQuery);
</script>

</body>