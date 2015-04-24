<?php
//Start the Session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="pathway_style.css">
  <style>
  .center {
    margin-left: auto;
    margin-right: auto;
    width: 90%;
  }
  </style>
</head>
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

      <div class="row">
        <div class="col-md-12">
          <h1>ACHIEVEMENTS</h1>
        </div>
      </div>

      <?php
       if($_SESSION["usertype"] == "2"){ ?>

      <div class="row top30" >
        <div class="col-md-6">
          <form action="achive.php" method = "POST">

           <label for="aID">Achievement ID:</label>
           <input type="text" class="form-control" id="aID" name = "aID">

           <label for="aDate">Date:</label>
          <input type="date" class="form-control" id="aDate" name = "aDate">

           <label for="aType">Type of Achivement:</label>
           <input type="text" class="form-control" id="aType" name = "aType">

           <label for="aEmail">Member Email:</label>
           <input type="email" class="form-control" id="aEmail" name = "aEmail">
         </div> <!--Column-->
        </div> <!--Row-->

       <div class="row top5" >
        <div class="col-md-6">
          <button type="Submit" class="btn btn-primary" value="Submit">Add</button>
          </form>
       </div> <!--Column-->
      </div> <!--Row-->
      <?php } ?>


       <?php
        //Adding new opportunity
        $aEmail = $_POST['aEmail'];
        $aType = $_POST['aType'];
        $aDate = $_POST['aDate'];
        $aID = $_POST['aID'];


        $newA = "INSERT INTO Achievement VALUES ('".$aID."', '".$aDate."', '".$aType."', '".$aEmail."');";

        echo $newAchievement;//debug code $
        if($aID > 0){
          mysql_query($newA);
        }


          $sql = "SELECT * FROM Achievement";
          $result = mysql_query($sql);

          ?>

          <div class="row top30">
            <div class="col-md-12">
              <!-- <form action= "achive.php" method = "POST"> -->
                <div class="table-responsive">
                  <table class="table table-striped" style="width:auto" id="opp">
                    <thead>
                      <tr>
                        <!-- <th><input type="checkbox" name="everything" onClick="toggle(this)"></th> -->
                        <th>ID</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Email</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      while($row = mysql_fetch_assoc($result)){
                        $row2 = mysql_fetch_assoc($result2);
                        echo "<tr>";
                        echo "<td>".$row["A_ID"]."</td>";
                        echo "<td>".$row["ADate"]."</td>";
                        echo "<td>".$row["AType"]."</td>";
                        echo "<td>".$row["MEmail"]."</td>";
                        echo "</tr>";
                      }


                      ?>
                    </tbody>
                  </table>

                  <!-- <div class="row">
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-danger btn-block" style="width:40%" value="Submit">Delete</button>
                    </div>
                  </div> -->

                </div>
              </form>
            </div>
          </div>
        </div>


      <?php
      $forDel;
      if(isset($_POST['ve'])){
        if (is_array($_POST['ve'])) {
          foreach($_POST['ve'] as $value){
            //echo $value."+";
            $forDel[] = $value;

          }
        } else {
          $value = $_POST['ve'];
          //echo $value."|";
        }
      }


      $sqlForDel;
      for($x=0; $x<count($forDel);$x++){
        //$sql2 = 'DELETE FROM EVENT WHERE EID = "'.$forDel[$x].'";';
        //echo $sql2;//debug code $
        mysql_query($sql2);
        //mysql_query($sql);
        $sqlForDel[] = $sql;
      //echo $forDel[$x]."|";//debug code $
    }

      mysqli_close($connection);
      ?>

      <footer class="pathway-footer">
        <p><h4>Built by Pathway Inc.</h4></p>
      </footer>


    </div> <!--Container-->
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


  </body>
  </html>
