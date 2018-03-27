<?php
    // Check if the user is logged in, if not redirect to sign in page
    require_once("php/check_login.php");

    // Otherwise load the header
    // include "header.php";
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
                <li><a href="map.php"><i class="fas fa-map-marker-alt"></i>Locate a Tutor<i class="fas fa-last fa-circle"></i></a></li>
                <li><a href="arrowchat/mobile/"><i class="fas fa-envelope"></i>Messages<i class="fas fa-last fa-circle"></i></a></li>
                <li><a href="profile.php"><i class="fas fa-user"></i>Edit Profile<i class="fas fa-last fa-circle"></i></a></li>
                <li><a href="php/signout.php"><i class="fas fa-sign-out-alt"></i>Sign Out<i class="fas fa-last fa-circle"></i></a></li>
            </ul>
        </div>
    </div>
    
    <div id="content" class="snap-content splash">
        <div class="header">
            <a href="#" class="open-nav"><i class="fas fa-bars hamburger-icon"></i></a>
            <div style="text-align: center;">
                <a href="#" class="header-logo"></a>
                <a href="arrowchat/mobile/" class="header-messages">
                    <i class="fas fa-comment" style="margin-top: 15px;"></i>
                    <span class="notification"></span>
                </a>
            </div>
        </div>
        <div class="content content-page">
            <div class="container">
                <div id="map" style="height: 100%;"></div>
            </div>
        </div>
    </div>
</div>

<script>
      var map, infoWindow;

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 6
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9eNjRRX-abij3lWbotJkDvRyrponBi_M&callback=initMap"></script>

</body>