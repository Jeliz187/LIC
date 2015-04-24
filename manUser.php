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

if($_POST["Submit1"]){
  // echo "first Loop";//debug code $
  if(isset($_POST['va'])){
    if (is_array($_POST['va'])) {
      foreach($_POST['va'] as $value){
        // echo $value."+";
        $for = $value;
      }
    }
  }
}
if($_POST["Submit2"]){
  if(isset($_POST['pEmail'])){
    $for = $_SESSION["pEmail"];
    // echo "Mech works: ".$for;//debug code $
  }
}
//display search
$w = $for;
$search = "SELECT * FROM Member WHERE MEmail = '".$w."'";
// echo $search;//debug code $
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
$uspass = $row['MPassword'];
$edob = $row['MDateofBirth'];
$street = $row['MStreetAddress'];
$zip = $row['MZip'];
$st = $aState = $row['MState'];
$city = $row['MCity'];
$inter = $row['MFieldofInterest'];
$org = $row['MOrginization'];
$tel = $row['MPhone'];
$etype = $row['MType'];
?>

<body>
  <div class="container">
    <h3>Member Sign Up</h3>
    <form action="manUser_BE.php" method = "POST" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-6">
          <label for="fname">First Name :</label>
          <input type="text" class="form-control" id="fname" name = "fname" value=<?php echo $firName; ?>>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <label for="lname">Last Name:</label>
          <input type="text" class="form-control" id="lname" name = "lname" value = <?php echo $lasName; ?>>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <label for="Email address">Email:</label>
          <input type="email" class="form-control" id="email" name = "email" value = <?php echo $eMail; ?>>
        </div>
      </div>

      <div class="row">
        <div class = "col-md-6">
          <label for="pass">Password:</label>
          <input type="password" class="form-control" name = "pass" value = <?php echo $uspass; ?>>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <label for="bday">Birthdate:</label>
          <input type="date" class="form-control" id="bday" name = "bday" value = <?php echo $edob; ?>>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <label for="country">Country of Origin:</label>
          <input type="text" class="form-control" id="contry" name = "country" value = <?php echo $cou; ?>>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <label for="socId">Social ID:</label>
          <input type="text" class="form-control" id="socId" name = "socId" value = <?php echo $zoid; ?>>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <label for="edu">Education (select one):</label>
          <select class="form-control" id="edu" name = "edu" value = <?php echo $educa; ?>>
            <option>High School/GED</option>
            <option>2-Year College/Tecnical School</option>
            <option>4-Year College</option>
            <option>Graduate School</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <label for="job">Occupation:</label>
          <input type="text" class="form-control" id="job" name = "job" value = <?php echo $traba; ?>>
        </div>
      </div>

      <div class="row">

        <div class = "col-md-3">
          <label for="street" >Street:</label>
          <input type="text" class="form-control" id="aStreet" name = "aSTreet" value = <?php echo $street; ?>>
        </div>
      </div>

      <div class="row">
        <div class = "col-md-3">
          <label for="azip">Zip:</label>
          <input type="text" class="form-control" id="azip" name = "azip" value = <?php echo $zip; ?>>
        </div>

        <div class = "col-md-3">
          <label for="aState">State:</label>
          <select class="form-control" id="aState" name = "aState" value = <?php echo $st; ?>>
            <option value="AL">AL</option>
            <option value="AK">AK</option>
            <option value="AZ">AZ</option>
            <option value="AR">AR</option>
            <option value="CA">CA</option>
            <option value="CO">CO</option>
            <option value="CT">CT</option>
            <option value="DE">DE</option>
            <option value="DC">DC</option>
            <option value="FL">FL</option>
            <option value="GA">GA</option>
            <option value="HI">HI</option>
            <option value="ID">ID</option>
            <option value="IL">IL</option>
            <option value="IN">IN</option>
            <option value="IA">IA</option>
            <option value="KS">KS</option>
            <option value="KY">KY</option>
            <option value="LA">LA</option>
            <option value="ME">ME</option>
            <option value="MD">MD</option>
            <option value="MA">MA</option>
            <option value="MI">MI</option>
            <option value="MN">MN</option>
            <option value="MS">MS</option>
            <option value="MO">MO</option>
            <option value="MT">MT</option>
            <option value="NE">NE</option>
            <option value="NV">NV</option>
            <option value="NH">NH</option>
            <option value="NJ">NJ</option>
            <option value="NM">NM</option>
            <option value="NY">NY</option>
            <option value="NC">NC</option>
            <option value="ND">ND</option>
            <option value="OH">OH</option>
            <option value="OK">OK</option>
            <option value="OR">OR</option>
            <option value="PA">PA</option>
            <option value="RI">RI</option>
            <option value="SC">SC</option>
            <option value="SD">SD</option>
            <option value="TN">TN</option>
            <option value="TX">TX</option>
            <option value="UT">UT</option>
            <option value="VT">VT</option>
            <option value="VA">VA</option>
            <option value="WA">WA</option>
            <option value="WV">WV</option>
            <option value="WI">WI</option>
            <option value="WY">WY</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class = "col-md-6">
          <label for="aCity">City:</label>
          <input type="text" class="form-control" id="aCity" name = "aCity" value = <?php echo $city; ?>>
        </div>
      </div>

      <div class="row">
        <div class = "col-md-6">
          <label for="web">Website:</label>
          <input type="text" class="form-control" id="web" name = "web" value = <?php echo $site; ?>>
        </div>
      </div>

      <div class="row">
        <div class = "col-md-6">
          <label for="interest">Main Field Of Interest:</label>
          <input type="text" class="form-control" name = "interest" value = <?php echo $inter; ?>>
        </div>
      </div>

      <div class="row">
        <div class = "col-md-6">
          <label for="orginization">Orginization:</label>
          <input type="text" class="form-control" name = "orginization" value = <?php echo $org; ?>>
        </div>
      </div>

      <div class="row">
        <div class = "col-md-6">
          <label for="mtel">Telephone:</label>
          <input type="text" class="form-control" name = "mtel" value = <?php echo $tel; ?>>
        </div>
      </div>


      <div class="row">
        <?php
        if($_SESSION["usertype"] == 2 && !$_POST["Submit2"]){
          // echo "Problem1";//debug code
          echo '<div class = "col-md-3">';
          echo ' <label for="mType">Type Of Member:</label>';
          echo '</div>';
          echo '<div class = "col-md-3">';
          echo ' <label class = "radio-inline">';
          echo '   <input type="radio" name="mType" value="Regular">  Regular';
          echo ' </label>';
          echo ' <label class = "radio-inline">';
          echo '   <input type="radio" name="mType" value="Admin">  Admin';
          echo ' </label>';
          echo '</div>';
        }
        else if($_SESSION["usertype"] == 2 && $_POST["Submit2"]){
          // echo "Problem2.1";//debug code $
          if($etype == "Regular"){
            // echo "Problem2.2";
            echo '<div class = "col-md-3">';
            echo ' <label for="mType">Type Of Member:</label>';
            echo '</div>';
            echo '<div class = "col-md-3">';
            echo ' <label class = "radio-inline">';
            echo '   <input type="radio" name="mType" value="Regular" checked readonly>  Regular';
            echo ' </label>';
            echo ' <label class = "radio-inline">';
            echo '   <input type="radio" name="mType" value="Admin" >  Admin';
            echo ' </label>';
            echo '</div>';
          }
          else if($etype == "Admin" ){
            // echo "Problem2.3";//debug code
            echo '<div class = "col-md-3">';
            echo ' <label for="mType">Type Of Member:</label>';
            echo '</div>';
            echo '<div class = "col-md-3">';
            echo ' <label class = "radio-inline">';
            echo '   <input type="radio" name="mType" value="Regular">  Regular';
            echo ' </label>';
            echo ' <label class = "radio-inline">';
            echo '   <input type="radio" name="mType" value="Admin" checked>  Admin';
            echo ' </label>';
            echo '</div>';
          }
        }
        else{
          echo '   <input type="radio" name="mType" value = "Regular" checked hidden>';
        }

        ?>
      </div>

      <table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
        <tr>
          <td width="246">
          <input type="hidden" name="MAX_FILE_SIZE" value="9000000">
          <input name="userfile" type="file" id="userfile">
          </td>
        <!-- <td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td> -->
        </tr>
      </table>

      <!-- Submit Button Group -->
      <div class="row">
        <div class = "col-md-3s">
          <?php
          if($_SESSION["usertype"] == 2){//type 2 is admin
            echo '<button type="submit" class="btn btn-primary" name = "edit" value="edit">Edit</button>';
            echo '<button type="submit" class="btn btn-danger" name="delete" value="delete">Delete</button>';
            echo '<button type="submit" class="btn btn-default" name="add" value="add">Add</button>';
          }
          else if($_SESSION["usertype"] == 1){
            echo '<button type="submit" class="btn btn-primary" name="edit" value="edit">Submit</button>';
          }
          else{
            echo '<button type="submit" class="btn btn-primary" name="add" value="add">Submit</button>';
          }
          ?>
        </div>
      </div>
      <br>
    </form>
  </div> <!--CONTAINER-->
</div>

<div class="container">
  <h3>Members Who Need Acceptance</h3>
<?php
if($_SESSION["usertype"] == 2){
  $sql5 = "SELECT * FROM Member WHERE MApproved = '0';";
  // echo $sql5;
  $result5 = mysql_query($sql5);
  if($result5->num_rows >= 0){
    ?>

    <form action= "manUser_BE.php" method = "POST">
      <table class="table table-striped" style="width:auto" id="opp">
        <thead>
          <tr>
            <th><input type="checkbox" name="everything" onClick="toggle(this)"></th>
            <th>Email</th>
            <th>Name</th>
            <th>Social ID</th>
            <th>Website</th>
            <th>Interest</th>
            <th>Organization</th>
            <th>Education</th>
            <th>Country of Origin</th>
            <th>DOB</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $tempID=0;
          while($row5 = mysql_fetch_assoc($result5)){
            echo "<tr>";
            $mEmail =$row5["MEmail"];
            echo "<td>".'<input type="checkbox" name="va[]" value="'.$mEmail.'">'."</td>";
            echo "<td>".$mEmail."</td>";
            echo "<td>".$row5["MFname"]." ".$row["MLname"]."</td>";
            echo "<td>".$row5["MSocialID"]."</td>";
            echo "<td>".$row5["MWebsite"]."</td>";
            echo "<td>".$row5["MFieldofInterest"]."</td>";
            echo "<td>".$row5["MOrginization"]."</td>";
            echo "<td>".$row5["MOccupation"]."</td>";
            echo "<td>".$row5["MEducation"]."</td>";
            echo "<td>".$row5["MCountryOfOrigin"]."</td>";
            echo "<td>".$row5["MDateofBirth"]."</td>";
            echo "</tr>";
            $tempID++;
          }
          ?>
        </tbody>
      </table>
      <button type="submit" class="btn btn-primary btn-block" style="width:20%" name ="accept" value="accept">Accept</button>
    </form>
    <?php
  }
}
mysqli_close($connection);
include_once ('manUser_BE.php');
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
