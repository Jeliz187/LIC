<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="pathway_style.css">

    <?php
    //Start the Session
    session_start();
    ?>

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
</head>

<body>

  <?php
  include_once ('navbar.php');
  include_once ('jumbotron.php');
  ?>

    <div class="container">
      <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
         <form class="form-signin" action="login_verify.php" method="post">

           <h2 class="form-signin-heading">Please sign in</h2>

           <div class="row top17">
             <div class="col-sm-12">
               <label for="inputUsername" class="sr-only">Email</label>
               <input type="text" name="uname" class="form-control" placeholder="Email" required autofocus>
             </div>
           </div>

           <div class="row top17">
             <div class="col-sm-12">
               <label for="inputPassword" class="sr-only">Password</label>
               <input type="password" name="pass" class="form-control" placeholder="Password" required>
             </div>
           </div>

           <div class="row top17">
             <div class="col-sm-4">
               <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
             </div>
           </div>

         </form>
      </div>
       <div class="col-sm-4"></div>


     </div><!--ROW-->
   </div> <!-- /container -->
   
   <footer class="pathway-footer top30">
     <p><h4>Built by Pathway Inc.</h4></p>
   </footer>


    <!-- <div id="header">
    <h1>Login</h1>
    </div>
    <body>
    <form action="test.php" method="post">
    Username: <input type="text" name="uname"><br>
    Password: <input type="text" name="pass"><br>
    <input type="submit"> -->

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


</body>



</html>
