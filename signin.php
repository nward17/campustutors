<?php
    // Start the session so we can check for a logged in user
    session_start();

    // If user is already logged in, redirect to home
    if (isset($_SESSION['email'])) {
        header("Location: index.php");
    }

    // Otherwise load the header
    include "header.php";
?>
   
<div class="all-elements">
    <div id="content" class="snap-content splash">
        <div class="content content-page">
            <div class="container">
                <div class="module form-module">
                    <div class="toggle">
                        <i class="fas fa-times fa-user-plus"></i>
                    </div>
                    <div class="form">
                        <h2>Sign in</h2>
                        <form id="signin">
                            <input type="email" id="email" class="mobileInput" placeholder=".edu Email" required>
                            <input type="password" id="password" class="mobileInput" placeholder="Password" required>
                            <span id="invalidLogin">Invalid email or password!<br><br></span>
                            <input class="btn-login signInButton" type="submit" value="Sign in">
                        </form>
                    </div>
                    <div class="form" style="display: none;">
                        <h2>Create an account</h2>
                        <form id="register">
                            <input type="text" id="firstName" class="mobileInput" placeholder="First Name" required>
                            <input type="text" id="lastName" class="mobileInput" placeholder="Last Name" required>
                            
                            <div class="form-group">
                                <select id="university" class="form-control" required><option value="">Select your university</option></select>
                            </div>

                            <input type="email" id="emailRegister" class="mobileInput" placeholder=".edu Email" required>
                            <input type="password" id="passwordRegister" class="mobileInput" placeholder="Password" oninput="checkPasswords()" required>
                            <input type="password" id="confirmPassword" class="mobileInput" placeholder="Confirm Password" oninput="checkPasswords()" required>
                            <span id="accountExists">Account already exists!<br><br></span>
                            <input class="btn-login registerButton" type="submit" value="Register">
                        </form>
                    </div>
                    <div class="forgot-password"><a href="#">Forgot your password?</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    (function($) {

        $(document).ready(function() {

            // Populate the auto-complete university list
            $.ajax({
                type: "POST",
                dataType: "text",
                url: "php/API.php",
                cache : false,
                data: {action: "getUniversities"},
                success: function(resp) {
                    var universities = JSON.parse(resp);

                    for (var i = 0 ; i < universities.length; i++) {
                        $("#university").append("<option value=" + universities[i].id + ">" + universities[i].name + "</option>");
                    }
                }
            });

            /* Credit: https://andytran.me/ */
            // Toggle Function
            $('.toggle').click(function(){
                // Switches the Icon
                $(this).children('i').toggleClass('fa-user-plus');
                // Switches the forms  
                $('.form').animate({
                    height: "toggle",
                    'padding-top': 'toggle',
                    'padding-bottom': 'toggle',
                    opacity: "toggle"
                }, "slow");
            });
            /* End Credit */

            // Disable the snapper on the login page
            snapper.disable();

            // Stop form submission
            $('#signin').submit(function(event) {
                event.preventDefault();
                signIn();
            });
            $('#register').submit(function(event) {
                event.preventDefault();
                register();
            });

            // Handle a user sign in
            function signIn() {
                var email = $("#email").val();
                var password = $("#password").val();

                $.ajax({
                    url: "php/API.php",
                    data: {action: 'signIn', email: email, password: password},
                    type: "POST",
                    success: function (response) {
                        if (response != "failure") {
                            window.location.href = "index.php";
                        } else if (response == "failure") {
                            $("#invalidLogin").show();
                        }
                    }
                });
            }

            // Handle a user registration
            function register() {
                var firstName = $("#firstName").val();
                var lastName = $("#lastName").val();
                var universityID = $("#university").val();
                var email = $("#emailRegister").val();
                var password = $("#passwordRegister").val();

                $.ajax({
                    url: "php/API.php",
                    data: {action: 'register', firstName: firstName, lastName: lastName , universityID: universityID, email: email, password: password},
                    type: "POST",
                    success: function (response) {
                        if (response == 0) {
                            window.location.reload();
                        } else {
                            // Account already exists for email
                            $("#accountExists").show();
                        }
                    }
                });
            }
        });

    })(jQuery);

    // Check to make sure the passwords match for registration
    function checkPasswords() {
        if (jQuery("#passwordRegister").val() != jQuery("#confirmPassword").val()) {
            jQuery("#confirmPassword")[0].setCustomValidity('Passwords do not match!');
        } else {
            jQuery("#confirmPassword")[0].setCustomValidity('');
        }
    }
</script>

</body>