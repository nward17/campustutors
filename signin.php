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
                    <!--
                    <div class="toggle">
                        <i class="fa fa-times fa-pencil"></i>
                    </div>
                    -->
                    <div class="form">
                        <h2>Sign in</h2>
                        <form id="signin">
                            <input type="email" id="email" placeholder=".edu Email" required>
                            <input type="password" id="password" placeholder="Password" required>
                            <span id="invalidLogin">Invalid email or password!<br><br></span>
                            <input class="btn-login signInButton" type="submit" value="Sign in">
                        </form>
                    </div>
                    <!--
                    <div class="form">
                        <h2>Create an account</h2>
                        <form id="register">
                            <input type="email" id="email" placeholder=".edu Email" required>
                            <input type="password" id="password" placeholder="Password" required>
                            <input type="password" id="confirmPassword" placeholder="Confirm Password" required>
                            <span id="passwordMatch">Passwords do not match!<br><br></span>
                            <input class="btn-login registerButton" type="submit" value="Register">
                        </form>
                    </div>
                    -->
                    <div class="forgot-password"><a href="#">Forgot your password?</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    (function($) {
        $(document).ready(function() {

            /* Credit: https://andytran.me/ */
            // Toggle Function
            $('.toggle').click(function(){
                // Switches the Icon
                $(this).children('i').toggleClass('fa-pencil');
                // Switches the forms  
                $('.form').animate({
                    height: "toggle",
                    'padding-top': 'toggle',
                    'padding-bottom': 'toggle',
                    opacity: "toggle"
                }, "slow");
            });
            /* End Credit */

            // Call Android function to update device id
            function updateDevice(userID) {
                if (typeof app !== 'undefined') {
                    // User is using an Android device
                    app.updateDevice(userID);
                }
                return false;
            }

            // Disable the snapper on the login page
            snapper.disable();

            // Stop form submission
            $('#signin').submit(function(event) {
                event.preventDefault();
                signIn();
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
                            var userID = response;

                            // Assign user id to device
                            updateDevice(userID);

                            window.location.href = "index.php";
                        } else if (response == "failure") {
                            $("#invalidLogin").show();
                        }
                    }
                });
            }
        });
    })(jQuery);
</script>

</body>