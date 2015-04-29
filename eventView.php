<?php
//Start the Session
session_start();
//inclued
include_once ('event_BE.php');
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
<?php
include_once ('navbar.php');
include_once ('jumbotron.php');
?>

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
//echo "<p> Still In</p>";//debug code $
//echo "<p> Still Good</p>";//debug code $
mysql_query("use cs4342team4sp15");//changing DB
$result = mysql_query("SHOW COLUMNS FROM Member");
if (!$result) {
  echo 'Could not run query: ' . mysql_error();
  exit;
}


if(isset($_POST['va'])){
  if (is_array($_POST['va'])) {
    foreach($_POST['va'] as $value){
      // echo $value."+";
      $for = $value;
    }//end foreach
  }//end if
}//end if

$sql = "SELECT * FROM Event";
$sql2 = "SELECT * FROM Sposored_By";
$sql3 = "SELECT * FROM Sponsor";
$result = mysql_query($sql);
$result2 = mysql_query($sql2);
$result3 = mysql_query($sql3);
?>

<body>
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <h3>Events</h3>
      </div>
    </div>

    <div class="col-md-6">
      <?php if($_SESSION["usertype"] == "2"){?>
        <form action="event2.php" method = "POST">
          <button type="submit" class="btn btn-primary btn-block" style="width:20%" name = "new" value="new">New Event</button>
        </form>
        <?php }//if close ?>
      </div>
        <div class="col-md-12">
          <?php
            //allows switch of form behavior beween admin and regular
            if($_SESSION["usertype"] == "2"){
              // echo '<form action="oppor.php" method = "post">';
              echo '<form action="event_BE.php" method = "post">';
            }
            else{
              echo '<form action="event_BE.php" method = "post">';
            }
            ?>
            <div class="table-responsive">
              <table class="table table-striped" style="width:auto" id="opp">
                <thead>
                  <tr>
                    <?php if($_SESSION["usertype"] == "2"){ echo "<th></th>";} ?>
                    <th>ID</th>
                    <th>Name</th>
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
                    $eve_id =$row['E_ID'];
                    if($_SESSION["usertype"] == "2" || $_SESSION["usertype"] == "1"){//only admins can select
                      echo "<td>".'<input type="radio" name="va[]" value="'.$eve_id.'" >'."</td>";
                    }
                    echo "<td>".$eve_id."</td>";
                    echo "<td>".$row['EName']."</td>";
                    $ev = $row['EVenue'];
                    echo "<td>".$ev."</td>";
                    echo "<td>".$row['EDate']." @ ".$row["ETime"]."</td>";
                    echo "<td>".$row['ERSVP']."</td>";
                    $de = $row['EDetail'];
                    echo '<td>'.$de.'</td>';
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
                  <button type="submit" class="btn btn-primary btn-block" style="width:40%" value="attend" name="attend" >attend </button>
                  <button type="submit" class="btn btn-warning btn-block" style="width:40%" value="select" name="select" > Select </button>
                  <button type="submit" class="btn btn-danger btn-block" style="width:40%" value="drop" name="drop" >Drop </button>
                </div>
                </div>
              </form>
            <?php
              }//end of if
              else {
            ?>
              <div class="row">
                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary btn-block" style="width:40%" value="apply" name="apply" >Apply </button>
                  <button type="submit" class="btn btn-danger btn-block" style="width:40%" value="drop" name="drop" >Drop </button>
                </div>
              </div>
            </form>
        <?php
        }//end of else
            mysqli_close($connection);
            ?>

          </div>
        </div>
      </div>

      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

      <!-- Latest compiled JavaScript -->
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


    </body>

    <footer class="pathway-footer">
      <p><h4>Built by Pathway Inc.</h4></p>
    </footer>

    </html>
