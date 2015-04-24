<!DOCTYPE html>
<html>
<title>Members</title>
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

<body>
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
  $search = "SELECT * FROM Member;";
  //echo $search;//debug code $
  $res = mysql_query($search);
  ?>

  <div class="container">

      <div class="row">
        <div class="col-md-12">
          <h3>All Members</h3>
        </div>
      </div>


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

                <div class="row top5" >
                  <div class="col-md-12" >
                    <button type="submit" class="btn btn-primary" value="Submit1" name = "Submit1">Look</button>
                  </div>
                </div>

              </form>
            </div>
        </div><!-- row -->
    </div><!-- container -->

      <?php
      mysqli_close($connection);
      ?>


      <footer class="pathway-footer top30">
        <p><h4>Built by Pathway Inc.</h4></p>
      </footer>

      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

      <!-- Latest compiled JavaScript -->
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


    </body>

  </html>
