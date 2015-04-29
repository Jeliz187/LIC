<?php
//Start the Session
session_start();
//inclued
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

      <div class="row top30">

        <!-- By Education -->
        <form action="queryView.php" method = "POST">
        <div class="col-md-3">
          <label for="edu">Query by Education:</label>
          <select class="form-control" name = "edu">
            <?php
              $esql = "SELECT MEducation FROM Member GROUP BY MEducation;";
              $res3 = mysql_query($esql);
              while($row = mysql_fetch_assoc($res3)){
                //do something with the contents of $row
                $ed = $row['MEducation'];
                echo "<option value=".$ed.">".$ed."</option>";
              }
            ?>
          </select>
        </div>
      </div>
        <div class="row top5">
          <div class="col-md-3">
            <button type="submit" class="btn btn-primary" name = "subEdu" value="subEdu">Submit</button>
          </div>
        </div>
      </form>

      <!-- By Country of Origin -->
      <form action="queryView.php" method = "POST">
        <div class="row top30">
          <div class="col-md-3">
            <label for="country">Query by Country of Origin:</label>
            <select class="form-control" id="country" name = "country">
              <?php
                $ssql = "SELECT MCountryOfOrigin FROM Member GROUP BY MCountryOfOrigin;";
                $res3 = mysql_query($ssql);
                while($row = mysql_fetch_assoc($res3)){
                  //do something with the contents of $row
                  $co = $row['MCountryOfOrigin'];
                  echo "<option value=".$co.">".$co."</option>";
                }
              ?>
            </select>
          </div>
        </div>
          <div class="row top5">
            <div class="col-md-3">
              <button type="submit" class="btn btn-primary" name = "subCon" value="subCon">Submit</button>
            </div>
          </div>
        </form>

        <!-- By State -->
        <form action="queryView.php" method = "POST">
        <div class="row top30">
          <div class = "col-md-3">
            <label for="aState">Query by State:</label>
            <select class="form-control" name = "aState">
              <?php
                $ssql = "SELECT MState FROM Member GROUP BY MState;";
                $res3 = mysql_query($ssql);
                while($row = mysql_fetch_assoc($res3)){
                    //do something with the contents of $row
                    $st = $row['MState'];
                    echo "<option value=".$st.">".$st."</option>";
                }
              ?>
            </select>
          </div>
        </div>
        <div class="row top5">
          <div class="col-md-3">
            <button type="submit" class="btn btn-primary" name = "subSt" value="subSt">Submit</button>
          </div>
        </div>
      </form>

      <!-- By Interest -->
      <form action="queryView.php" method = "POST">
      <div class="row top30">
        <div class = "col-md-3">
          <label for="aState">Query by Interest:</label>
          <select class="form-control" name = "fieldInterest">
            <?php
              $isql = "SELECT MFieldofInterest FROM Member GROUP BY MFieldofInterest;";
              $res3 = mysql_query($isql);
              while($row = mysql_fetch_assoc($res3)){
                  //do something with the contents of $row
                  $fi = $row['MFieldofInterest'];
                  echo "<option value=".$fi.">".$fi."</option>";
              }
            ?>
          </select>
        </div>
      </div>
      <div class="row top5">
        <div class="col-md-3">
          <button type="submit" class="btn btn-primary" name = "filInt" value="filInt">Submit</button>
        </div>
      </div>
    </form>

    <!-- By Occupation -->
    <form action="queryView.php" method = "POST">
    <div class="row top30">
      <div class = "col-md-3">
        <label for="aState">Query by Occupation:</label>
        <select class="form-control" name = "occupa">
          <?php
            $ocsql = "SELECT MOccupation FROM Member GROUP BY MOccupation;";
            $res3 = mysql_query($ocsql);
            while($row = mysql_fetch_assoc($res3)){
                //do something with the contents of $row
                $oc = $row['MOccupation'];
                echo "<option value=".$oc.">".$oc."</option>";
            }
          ?>
        </select>
      </div>
    </div>
    <div class="row top5">
      <div class="col-md-3">
        <button type="submit" class="btn btn-primary" name = "ocup" value="ocup">Submit</button>
      </div>
    </div>
  </form>
    </div><!--CONTAINER-->





    <?php
    mysqli_close($connection);
    ?>

    <footer class="pathway-footer top30">
      <p><h4>Built by Pathway Inc.</h4></p>
    </footer>


  </div> <!--Container-->
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


</body>
</html>
