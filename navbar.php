<?php
//Start the Session
session_start();
?>
<nav class="navbar navbar-fixed-top navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
  </div>
    <div id="navbar" class="navbar-collapse collapse">
        <!-- If they are not a user they can Sign up-->
        <!-- <ul class= "nav nav-pills">
        <li><a href =""> Home </a>
        <li><a href="reports2.php"> Reports </a></li>
        <li class="active"><a href="manUser.php"> Add User </a></li>
        <li><a href="oppor.php"> Add Opportunity </a></li>
        <li><a href="event2.php"> Events </a></li>
        <li><a href="achive.php"> Achivements </a></li>
        <li><a href="profile.php"> Profile </a></li>
        <li><a href="logout.php">Log Out</a></li>
        </ul> -->

        <?php

        if($_SESSION["usertype"] == 1){//Regular Users
          echo '<div>';
          echo '  <ul class="nav navbar-nav">';
          echo '   <li><a href ="welcome.php"> Home </a>';
          echo '   <li><a href="opporView.php"> Opportunities </a></li>';
          echo '   <li><a href="eventView.php"> Events </a></li>';
          echo '   <li><a href="achiveView.php"> Achievements </a></li>';
          echo '   <li><a href="about.php"> About Us </a></li>';
          echo '   <li><a href="allUsers.php">Members</a></li>';
          echo '  </ul>';
          echo '  <ul class="nav navbar-nav navbar-right">';
          echo '<li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>';
          echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>';
          // $_SESSION["userName"] = $_POST['uname'];
          // $_SESSION["isUser"] = TRUE;
         }
         else if($_SESSION["usertype"] == 2){//Admin Users
           echo '<div>';
           echo '  <ul class="nav navbar-nav">';
           echo '   <li><a href ="welcome.php"> Home </a>';
           echo '   <li><a href="opporView.php"> Opportunities </a></li>';
           echo '   <li><a href="eventView.php"> Events </a></li>';
           echo '   <li><a href="achiveView.php"> Achievements </a></li>';
           echo '   <li><a href="about.php"> About Us </a></li>';
           echo '   <li><a href="allUsers.php">Members</a></li>';
           echo '   <li class="dropdown">';
           echo '     <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin <span class="caret"></span></a>';
           echo '     <ul class="dropdown-menu" role="menu">';
           echo '       <li><a href="reports2.php"> Reports </a></li>';
           echo '       <li><a href="manUser.php"> Manage Users </a></li>';
           echo '     </ul>';
           echo '   </li>';
           echo '  </ul>';
           echo '  <ul class="nav navbar-nav navbar-right">';
           echo '<li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>';
           echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>';
          //  $_SESSION["userName"] = $_POST['uname'];
          //  $_SESSION["isAdmin"] = TRUE;
          }
          else {
            echo '<div>';
            echo '  <ul class="nav navbar-nav">';
            echo '   <li><a href ="welcome.php"> Home </a>';
            echo '   <li><a href="eventView.php"> Events </a></li>';
            echo '   <li><a href="achiveView.php"> Achievements </a></li>';
            echo '   <li><a href="about.php"> About Us </a></li>';
            echo '  </ul>';
            echo '  <ul class="nav navbar-nav navbar-right">';
            echo '    <li><a href="manUser.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
            echo '    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
          }?>
        </ul>
      </div>
    </div>
  </div>
</nav>
