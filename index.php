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
                <li><a href="https://www.nicolasward.com/campustutors/profile.php"><i class="fa fa-user"></i>Edit Profile<i class="fa fa-last fa-circle"></i></a></li>
                <li><a href="https://www.nicolasward.com/campustutors/php/signout.php"><i class="fa fa-sign-out"></i>Sign out<i class="fa fa-last fa-circle"></i></a></li>
            </ul>
        </div>
    </div>
    
    <div id="content" class="snap-content splash">
        <div class="header">
            <a href="#" class="open-nav"><i class="fa fa-navicon hamburger-icon"></i></a>
            <a href="#" class="header-logo"></a>
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
                            // Get the tutors
                            onChooseEvent: function() {
                                var courseTag = $(".search-course").getSelectedItemData().tag;
                                $.ajax({
                                    type: "POST",
                                    dataType: "text",
                                    url: "php/API.php",
                                    cache : false,
                                    data: {action: "findTutors", courseTag: courseTag},
                                    success: function(resp) {
                                        var tutors = JSON.stringify(resp, null, 2); 
                                        $(".requestsContainer").html(tutors);
                                    }
                                });
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