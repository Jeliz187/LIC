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

        //echo "<p> Got Somthing</p>";//debug code $
        $testOne = "Golden";

        if(isset($_POST['va'])){
          if (is_array($_POST['va'])) {
            foreach($_POST['va'] as $value){
              // echo $value."+";
              $for = $value;
            }
          }
        }
        else{
          $for = $_SESSION['username'];
        }

          //display search
          $w = $for;
          $search = "SELECT * FROM Member WHERE MEmail = '".$w."'";
          //echo $search;//debug code $
          $res = mysql_query($search);
          $row=mysql_fetch_array($res);
          $firName = $row['MFname'];
          $lasName = $row['MLname'];
          $eMail = $row['MEmail'];
          $cou = $row['MCountryOfOrigin'];
          $zoid = $row['MSocialID'];
          $educa = $row['MEducation'];
          $traba = $row['MOccupation'];
          $site = $row['MWebsite'];
          $interest = $row['MFieldofInterest'];
          $org = $row['MOrginization'];
          $dob = $row['MDateofBirth'];
          $aStreet = $row['MStreetAddress'];
          $aCity = $row['MCity'];
          $aState = $row['MState'];
          $aZip = $row['MZip'];

    			$data = $row['MPicture'];
    			echo '<img src="data:image/jpeg;base64,' . base64_encode( $row['data'] ) . '" />';

          // $pic = $row['MPicture'];
          $tel = $row['MPhone'];

          // $uspass = $row['MPassword'];//Only the owner of profile needs to now

          $_SESSION["pEmail"] = $eMail;//current profile on table
    ?>

<body>
  <div class="container">
    <table class="table table-striped">
      <thead>
      </thead>
      <tbody>
        <tr>
          <td>Name</td>
          <td> <?php echo $firName." ".$lasName; ?></td>
        </tr>
      <tr>
          <td>Email</td>
          <td> <?php echo $eMail; ?></td>
      </tr>
      <tr>
          <td>Social ID</td>
          <td> <?php echo $zoid; ?></td>
        </tr>
        <tr>
          <td>Education</td>
          <td> <?php echo $educa; ?></td>
        </tr>
        <tr>
          <td>Occupation</td>
          <td> <?php echo $traba; ?></td>
        </tr>
        <tr>
          <td>Website</td>
          <td> <?php echo $site; ?></td>
        </tr>
        <tr>
          <td>Main Interest</td>
          <td> <?php echo $interest; ?></td>
        </tr>
        <tr>
          <td>Organization</td>
          <td> <?php echo $org; ?></td>
        </tr>
        <tr>
          <td>DOB</td>
          <td> <?php echo $dob; ?></td>
        </tr>
        <tr>
          <td>Address</td>
          <td> <?php echo $aStreet.", ".$aCity.", ".$aState.", ".$aZip; ?></td>
        </tr>
        <td>Phone Number</td>
        <td> <?php echo $tel; ?></td>
      </tr>
      </tbody>
    </table>
    <?php
    if($_SESSION["usertype"] == 2 || ($_SESSION['username'] == $_SESSION['pEmail'])){//type 2 is admin
    echo '<form action= "manUser.php" method = "POST">';
    echo '<input type="hidden" class="form-control"  id="pEmail" name = "pEmail" placeholder = '.$eMail.'>';
    echo '<button type="submit" class="btn btn-primary" value="Submit2" name = "Submit2">Edit</button>';
    echo '</form>';
  }
  ?>
  </div>
<?php
    mysqli_close($connection);
  ?>
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
