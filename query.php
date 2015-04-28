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

      <div class="row top30">
        <div class="col-md-3">
          <label for="edu">Query by Education:</label>
          <select class="form-control" id="edu" name = "edu" value = <?php echo $educa; ?>>
            <option>High School/GED</option>
            <option>2-Year College/Tecnical School</option>
            <option>4-Year College</option>
            <option>Graduate School</option>
          </select>
        </div>
      </div>
        <div class="row top5">
          <div class="col-md-3">
            <button type="submit" class="btn btn-primary" name = "query_education" value="query_education">Submit</button>
          </div>
        </div>

        <div class="row top30">
          <div class="col-md-3">
            <label for="country">Query by Country of Origin:</label>
            <select class="form-control" id="country" name = "country" value = <?php echo $cou; ?>>
              <?php include_once("country_dropdown.php"); ?>
            </select>
          </div>
        </div>
          <div class="row top5">
            <div class="col-md-3">
              <button type="submit" class="btn btn-primary" name = "query_country" value="query_country">Submit</button>
            </div>
          </div>

        <div class="row top30">
          <div class = "col-md-3">
            <label for="aState">Query by State:</label>
            <select class="form-control" id="aState" name = "aState" value = <?php echo $st; ?>>
              <?php include_once("states_dropdown.php"); ?>
            </select>
          </div>
        </div>
        <div class="row top5">
          <div class="col-md-3">
            <button type="submit" class="btn btn-primary" name = "query_state" value="query_state">Submit</button>
          </div>
        </div>


        <!---------------------->
        <!--Example MySQL query-->
        <!---------------------->

        <!--select MFname, MLname, MEmail, MOccupation from Member where McountryOfOrigin like "United States"
        select MFname, MLname, MEmail, MOccupation from Member where MEducation like "Undergrad"
        select MFname, MLname, MEmail, MOccupation from Member where MState like "Texas"-->


        <div class="row" >
          <div class="col-md-12" >
            <form action= "profile.php" name="members" method = "POST">
              <div class="table-responsive">
                <table class="table table-striped" style="width:auto" >
                  <thead>
                    <tr>
                      <th><input type="radio" name="everything" hidden></th>
                      <!-- <th>Email</th> -->
                      <th>Name</th>
                      <th>Social ID</th>
                      <th>Website</th>
                      <th>Interest</th>
                      <th>Organization</th>
                      <th>Occupation</th>
                      <th>Education</th>
                      <th>Country of Origin</th>
                      <th>DOB</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while($row5 = mysql_fetch_assoc($res)){
                      echo '<tr>';
                      $mEmail =$row5["MEmail"];
                      // echo '<td><a href="profile.php">Profile</a></td>';
                      echo "<td>".'<input type="radio" name="va[]" value="'.$mEmail.'">'."</td>";
                      // echo "<td>".$mEmail."</td>";
                      echo "<td>".$row5["MFname"]." ".$row5["MLname"]."</td>";
                      echo "<td>".$row5["MSocialID"]."</td>";
                      echo "<td>".$row5["MWebsite"]."</td>";
                      echo "<td>".$row5["MFieldofInterest"]."</td>";
                      echo "<td>".$row5["MOrginization"]."</td>";
                      echo "<td>".$row5["MOccupation"]."</td>";
                      echo "<td>".$row5["MEducation"]."</td>";
                      echo "<td>".$row5["MCountryOfOrigin"]."</td>";
                      echo "<td>".$row5["MDateofBirth"]."</td>";
                      echo "</tr>";
                    }
                    ?>
                  </table>
                </div>

                  <!-- <div class="row top5" >
                    <div class="col-md-12" >
                      <button type="submit" class="btn btn-primary" value="Submit1" name = "Submit1">Look</button>
                    </div>
                  </div> -->

                </form>
              </div>
          </div><!-- row -->

    </div><!--CONTAINER-->





    <?php
  //   $forDel;
  //   if(isset($_POST['ve'])){
  //     if (is_array($_POST['ve'])) {
  //       foreach($_POST['ve'] as $value){
  //         //echo $value."+";
  //         $forDel[] = $value;
  //
  //       }
  //     } else {
  //       $value = $_POST['ve'];
  //       //echo $value."|";
  //     }
  //   }
  //
  //
  //   $sqlForDel;
  //   for($x=0; $x<count($forDel);$x++){
  //     //$sql2 = 'DELETE FROM EVENT WHERE EID = "'.$forDel[$x].'";';
  //     //echo $sql2;//debug code $
  //     mysql_query($sql2);
  //     //mysql_query($sql);
  //     $sqlForDel[] = $sql;
  //   //echo $forDel[$x]."|";//debug code $
  // }

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
