<?php
//Start the Session
session_start();
$_SESSION["userType"] = "admin";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="pathway_style.css">
</head>

  <!-- <ul class= "nav nav-pills">
    <li><a href ="welcome.php"> Home </a></li>
      <li><a href="reports2.php"> Reports </a></li>
      <li><a href="manUser.php"> Manage User </a></li>
      <li><a href="oppor.php"> Opportunities </a></li>
      <li class="active"><a href="event2.php"> Events </a></li>
      <li><a href="achive.php"> Opportunities </a></li>
      <li><a href="profile.php"> Profile </a></li>
      <li><a href="logout.php">Log Out</a></li>
    </ul> -->

  <?php
  //echo "<p> Going In</p>";//debug code $
  $host='earth.cs.utep.edu';
  $user='cs_vosanchez';
  $password='dogK9';
  $database='cs4342team4sp15';
  $connection = mysql_connect($host, $user, $password);
  if(!$connection){
    die('Could not connect: '. mysql_error());
    //echo "<p>Hit a Wall</p>";//debug code %
  }
  mysql_query("use cs4342team4sp15");//changing DB
  $result = mysql_query("SHOW COLUMNS FROM Member");

  if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
  }

  ?>

  <body>


    <?php
      include_once ('navbar.php');
      include_once ('jumbotron.php');
    ?>



    <div class="container">

      <div class="row" >
        <div class="col-md-4">
          <h1>EVENTS</h1>
        </div>
      </div>

    <?php
    if(isset($_POST['select'])){
      if(isset($_POST['va'])){
        if (is_array($_POST['va'])) {
          foreach($_POST['va'] as $value){
            // echo $value."+";
            $for = $value;
          }
        }
      }
    $s_eid = $for;
    $search = "SELECT * FROM Event WHERE E_ID = '".$s_eid."'";

    // echo $search;debug code $
    $sre = mysql_query($search);
    $row = mysql_fetch_assoc($sre);
    $sName = $row['EName'];
    $sVenue = $row['EVenue'];
    // echo $sVenue;debug code $
    $sDate = $row['EDate'];
    $sTime = $row['ETime'];
    $sRsvp = $row['ERSVP'];
    $sDetail = $row['EDetail'];

    $search2 = "SELECT * FROM Sponsored_By WHERE E_ID = '".$s_eid."'";
    $sre2 = mysql_query($search2);
    $row2 = mysql_fetch_assoc($sre2);
    $s_sEmail = $row2['SEmail'];

    $search3 = "SELECT * FROM Sponsor WHERE SEmail = '".$s_sEmail."'";
    $sre3 = mysql_query($search3);
    $row3 = mysql_fetch_assoc($sre3);
    $s_sTel = $row3['SPhone'];
    $s_sWebsite = $row3['SWebsite'];
    }
    ?>

             <div class="row" >
               <div class="col-md-6">
                 <form action="event_BE.php" method = "post">

                   <label for="e_id">Event ID</label>
                   <?php if($s_eid != ""){
                     echo '<input type="text" class="form-control" id="e_id" name = "e_id" value = '.$s_eid.' readonly>';
                   }else{
                     echo '<input type="text" class="form-control" id="e_id" name = "e_id" value = '.$s_eid.'>';
                   }
                   ?>


                   <label for="ename">Event Name</label>
                   <input type ="text" class="form-control" id="ename" name = "ename" value = <?php echo $sName; ?>>

                   <label for="evenue">Venue:</label>
                   <input type="text" class="form-control" id="evenue" name = "evenue" value = <?php echo $sVenue; ?>>

                   <label for="edate">Date:</label>
                   <input type="date" class="form-control" id="edate" name = "edate" value = <?php echo $sDate; ?>>

                   <label for="etime">Time:</label>
                   <input type="time" class="form-control" id="etime" name = "etime" value = <?php echo $sTime; ?>>

                   <label for="ersvp">RSVP:</label>
                   <div class="radio">
                    <?php
                    if(isset($_POST['select']) && $sRsvp == "RSVP Required"){
                      echo '<input type="radio" name="ersvp" value="RSVP Required" checked>Yes	<br>';
                      echo '<input type="radio" name="ersvp" value="No RSVP Required">No';
                    }
                    else if(isset($_POST['select']) && $sRsvp == "No RSVP Required"){
                      echo '<input type="radio" name="ersvp" value="RSVP Required">Yes	<br>';
                      echo '<input type="radio" name="ersvp" value="No RSVP Required checked" >No';
                    }
                    else{
                    echo '<input type="radio" name="ersvp" value="RSVP Required">Yes	<br>';
                    echo '<input type="radio" name="ersvp" value="No RSVP Required" >No';
                  }
                  ?>

                   </div>


                   <label for="edesc">Detail:</label>
                   <input type ="text" class="form-control" id="edesc" name = "edesc" value = <?php echo $sDetail; ?>>

                   <label for="sname">Sponsored by:</label>
                   <input type ="email" class="form-control" id="semail" name = "semail" value = <?php echo $s_sEmail; ?>>

                   <label for="stel">Phone:</label>
                   <input type ="text" class="form-control" id="stel" name = "stel" value = <?php echo $s_sTel; ?>>

                   <label for="sWeb">Website:</label>
                   <input type ="text" class="form-control" id="sWeb" name = "sWeb" value = <?php echo $s_sWebsite; ?>>

                   <div class="row">
                     <div class="col-md-8">
                       <?php
                       if($_SESSION["usertype"] == 2 && isset($_POST['select'])){//type 2 is admin

                          //  echo '<button type="submit" class="btn btn-default" name="add" value="add">Add</button>';

                           echo '<button type="submit" class="btn btn-primary" name = "edit" value="edit">Edit</button>';

                           echo '<button type="submit" class="btn btn-danger" name="delete" value="delete">Delete</button>';
                       }
                       else{
                         echo '<button type="submit" class="btn btn-default" name="add" value="add">Add</button>';
                       }
                       ?>
                     </div>
                   </div>
                </form>
              </div>
           </div>




            <?php
            include_once ('event_BE.php');
            mysqli_close($connection); ?>


      <footer class="pathway-footer">
        <p><h4>Built by Pathway Inc.</h4></p>
      </footer>

      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

      <!-- Latest compiled JavaScript -->
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>



  </body>
</html>
