<?php
//Start the Session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>

<?php
    $host='earth.cs.utep.edu';
    $user='cs_vosanchez';
    $password='dogK9';
    $database='cs_vosanchez';
    $connection = mysql_connect($host, $user, $password);
    if(!$connection){
    die('Could not connect: '. mysql_error());
    }
    mysql_close($connection);
    ?>

    <div class="container">
        <div class="jumbotron">
            <h1>Pathway Inc.</h1>
        </div>
        <ul class= "nav nav-pills">
	       <li class="active"><a href =""> Home </a>
            <?php
                if($_POST['uname'] == 'admin' && $_POST['pass']== 'admin1'){
                    echo '<li><a href="reports2.php"> Reports </a></li>';
                    echo '<li><a href="manUser.php"> Add User </a></li>';
                    echo '<li><a href="event.php"> Events </a></li>';
                    echo '<li><a href="oppor.php"> opportunities </a></li>';
                    echo '<li><a href="logout.php">Log Out</a></li>';
                    $_SESSION["userName"] = $_POST['uname'];
                    $_SESSION["isUser"] = TRUE;
                }
                if($_POST['uname'] == 'user' && $_POST['pass']== 'user1'){
                    echo '<li><a href="logout.php">Log Out</a></li>';
                    $_SESSION["userName"] = $_POST['uname'];
                    $_SESSION["isUser"] = TRUE;
                }
                if(!$_SESSION["isUser"]){
                    echo '<li><a href="login.php">Login</a></li>';
                }
            ?>
        </ul>
    </div>
<body>
      <p>Pardon our dust. Under Construction</p>


</body>
</html>
