<!DOCTYPE html>
<html>
<title>Report</title>
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


        $w = $_POST["emailTwo"];
        $search = "SELECT * FROM MEMBER WHERE MEMAIL = '".$w."'";
        //echo $search;//debug code $
        $res = mysql_query($search);

        if (mysql_num_rows($res) == 0){
            //do something sensible, like tell the user no records match, etc....
        }else{
            // our query returned at least one result. loop over results and do stuff.
            while($row = mysql_fetch_assoc($res)){
                //do something with the contents of $row
                $firName = $row['MFNAME'];
                $lasName = $row['MLNAME'];
                $eMail = $row['MEMAIL'];
                $cou = $row['country'];
                $zoid = $row['MSOCIALID'];
                $educa = $row['MEDUCATION'];
                $traba = $row['MOCCUPATION'];
                $site = $row['MWEBSITE'];
            }
        }

    ?>
<div class="container">
  <div class="row">
    <div class="col-md-3">
        <form action="reports2.php" method = "POST">
          <labe for="emailTwo">Email address:</label>
            <input type="email" class="form-control" id="emailTwo" name = "emailTwo" value = "">
          <br>
          <button type="submit" class="btn btn-default" value="Submit1" name = "Submit1">Submit</button>
        </form>
    </div>
  </div>
<?php
    mysqli_close($connection);
?>

  <div class="row">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Social ID</th>
          <th>Education</th>
          <th>Occupation</th>
          <th>Website</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td> <?php echo $firName." ".$lasName; ?></td>
          <td> <?php echo $eMail; ?></td>
          <td> <?php echo $zoid; ?></td>
          <td> <?php echo $educa; ?></td>
          <td> <?php echo $traba; ?></td>
          <td> <?php echo $site; ?></td>
        </tr>

      </tbody>
    </table>
  </div>
</div>


<div class="container">
  <h3>Attending Event</h3>
  <form action="reports2.php" method = "POST">
  <select name="eventID">
    <?php
      $esql = "SELECT E_ID FROM Attends_Event GROUP BY E_ID;";
      $res3 = mysql_query($esql);
      while($row = mysql_fetch_assoc($res3)){
          //do something with the contents of $row
          $eID = $row['E_ID'];
          echo "<option value=".$eID.">".$eID."</option>";
      }
    ?>
</select>
<button type="submit" class="btn btn-default" value="Submit1" name = "Submit2">Submit</button>
</form>

<?php
$e = $_POST['eventID'];
$sql =  "SELECT MEmail FROM Attends_Event WHERE E_ID = ".$e.";";
$res2 = mysql_query($sql);
?>
<div class="row">
  <table class="table table-striped" name ="atends">
    <thead>
      <tr>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
  <?php
          // our query returned at least one result. loop over results and do stuff.
          while($row = mysql_fetch_assoc($res2)){
              //do something with the contents of $row
              echo "<tr>";
              echo "<td>".$row['MEmail']."</td>";
              echo "</tr>";
          }
      ?>
    </tbody>
  </table>
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
