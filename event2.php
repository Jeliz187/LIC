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

  <?php if($_SESSION["usertype"] == "2"){?>
    <form action="event2.php" method = "POST">

      <label for="sId">Search ID :</label>
      <input type="text" class="form-control"name = "sId">

      <button type="submit" class="btn btn-default btn-block" style="width:20%" name = "mod" value="Submit3">Modifiy</button>
    </form>
    <?php
    if(isset($_POST['select'])){
      $forDel;
      if(isset($_POST['va'])){
        if (is_array($_POST['va'])) {
          foreach($_POST['va'] as $value){
            // echo $value."+";
            $forDel[] = $value;
          }
        } else {
          $forDel[] = $_POST['va'];
          //echo $value."|";
        }
      }
    $s_eid = $_POST['sId'];
    $search = "SELECT * FROM Event WHERE E_ID = '".$s_eid."'";
    $search2 = "SELECT * FROM Sposored_By WHERE E_ID = '".$s_eid."'";
    // echo $search;debug code $
    $sre = mysql_query($search);
    $row = mysql_fetch_assoc($sre);
    $sName = $row['EName'];
    $sVenue = $row['EVenue'];
    $sDate = $row['EDate'];
    $sTime = $row['ETime'];
    $sRsvp = $row['ERSVP'];
    $sDetail = $row['EDetail'];

    $sre2 = mysql_query($search2);
    $row2 = mysql_fetch_assoc($sre2);
    $s_sEmail = $row2['SEmail'];

    $search3 = "SELECT * FROM Sponsor WHERE SEmail = '".$s_sEmail."'";

    $sre3 = mysql_query($search3);
    $row3 = mysql_fetch_assoc($sre3);
    $s_sTel = $row3['SPhone'];
    $s_sWebsite = $row3['SWebsite'];



    $isEdit = true;
  }
    ?>

             <div class="row" >
               <div class="col-md-4">
                 <form action="event_BE.php" method = "post">

                   <label for="e_id">Event ID :</label>
                   <input type="text" class="form-control" id="e_id" name = "e_id" value = <?php echo $s_eid; ?>>

                   <label for="ename">Event Name</label>
                   <input type ="text" class="form-control" id="ename" name = "ename" value = <?php echo $sName; ?>>

                   <label for="evenue">Venue:</label>
                   <input type="text" class="form-control" id="evenue" name = "evenue" value = <?php echo $sVenue; ?>>

                   <label for="edate">Date:</label>
                   <input type="date" class="form-control" id="edate" name = "edate" value = <?php echo $sDate; ?>>

                   <label for="etime">Time:</label>
                   <input type="time" class="form-control" id="etime" name = "etime" value = <?php echo $sTime; ?>>

                   <div class="radio">
                     <label><input type="radio" id="ersvp" name="ersvp" value = <?php echo $sRsvp; ?>>RSVP</label>
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
                       if($_SESSION["usertype"] == 2){//type 2 is admin
                         echo '<button type="submit" class="btn btn-primary" name = "edit" value="edit">Edit</button>';
                         echo '<button type="submit" class="btn btn-danger" name="delete" value="delete">Delete</button>';
                         echo '<button type="submit" class="btn btn-default" name="add" value="add">Add</button>';
                       }
                       ?>
                       <!-- <button type="Submit" class="btn btn-primary" value="submit" name="submit" >Add</button> -->
                     </div>
                   </div>
                </form>
              </div>
           </div>
    <?php  } ?>



          <?php
          $sql = "SELECT * FROM Event";
          $sql2 = "SELECT * FROM Sposored_By";
          $sql3 = "SELECT * FROM Sponsor";
          $result = mysql_query($sql);
          $result2 = mysql_query($sql2);
          $result3 = mysql_query($sql3);
          ?>
        <div class="row">
          <div class="col-md-12">
            <form method = "post">
              <div class="table-responsive">
                <table class="table table-striped" style="width:auto" id="opp">
                  <thead>
                    <tr>
                      <?php if($_SESSION["usertype"] == "2"){ echo "<th></th>";} ?>
                      <th>ID</th>
                      <th>Venue</th>
                      <th>Date @ Time</th>
                      <th>RSVP</th>
                      <th>Detail</th>
                      <th>Sponsor</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      while($row = mysql_fetch_assoc($result)){
                        echo "<tr>";
                        $eve_id =$row["E_ID"];
                        if($_SESSION["usertype"] == "2"){//only admins can select
                        echo "<td>".'<input type="radio" name="va[]" value="'.$eve_id.'" >'."</td>";
                        }
                        echo "<td>".$eve_id."</td>";
                        echo "<td>".$row["EVenue"]."</td>";
                        echo "<td>".$row["EDate"]." @ ".$row["ETime"]."</td>";
                        echo "<td>".$row["ERSVP"]."</td>";
                        echo "<td>".$row["EDetail"]."</td>";
                        $sql4 = "SELECT SEmail FROM Sponsored_By Where E_ID=".$eve_id.";";
                        $res2 = mysql_query($sql4) ;
                        $row2 = mysql_fetch_assoc($res2);
                        echo "<td>".$row2["SEmail"]."</td>";
                        echo "</tr>";
                      }
                    ?>

                  </tbody>
                </table>
              </div>
              <?php if($_SESSION["usertype"] == "2"){ ?>
                <div class="row">
                  <div class="col-md-2">
                    <button type="submit" class="btn btn-defalut btn-block" style="width:40%" value="select" name="select" > Select </button>
                  </div>
                </div>
              <?php } ?>
            </form>

            <?php
            include_once ('event_BE.php');
            mysqli_close($connection); ?>

          </div>
        </div>
      </div>

      <footer class="pathway-footer">
        <p><h4>Built by Pathway Inc.</h4></p>
      </footer>

      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

      <!-- Latest compiled JavaScript -->
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>



  </body>
</html>
