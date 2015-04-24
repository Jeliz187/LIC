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
  mysql_query("use cs4342team4sp15");//changing DB
  $result = mysql_query("SHOW COLUMNS FROM Opportunity;");
  //echo $result;
  if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
  }

  ?>

  <body>

    <div class="container">


      <div class="row">
        <div class="col-md-12">
          <h1>OPPORTUNITIES</h1>
        </div>
      </div>

<?php
  if($_SESSION["usertype"] == 2){
    ?>

    <div class="row" >
      <div class="col-md-4">
        <form action="oppor.php" method = "POST">
          <label for="o_id">Search ID :</label>
          <input type="text" class="form-control"name = "sId">
        </div>
      </div>
      <div class="row top5">
        <div class="col-md-4">
          <button type="submit" class="btn btn-primary btn-block" style="width:20%" value="modify" name="modify">Modifiy</button>
        </div>
      </div>
    </form>
  <?php } ?>

  <?php
    //edit section
    if(isset($_POST['modify'])){
      $s_oid = $_POST['sId'];
      $search = "SELECT * FROM Opportunity WHERE O_ID = '".$s_oid."'";
      //echo $search;
      $sre = mysql_query($search);
      $row = mysql_fetch_assoc($sre);
      $sType = $row["OType"];
      $sStart = $row["OStart"];
      $sDead = $row["OApp_dealine"];
      $sGPA = $row["OGPA"];
      $sRec = $row["OReccommendation"];
      $sDesc = $row["ODescription"];
      $isEdit = true;
    }
  ?>


      <div class="row">
        <div class="col-md-12">
          <h3>Add an Opportunity</h3>
        </div>
      </div>



      <div class="row" >
        <div class="col-md-6">
          <form action="oppor_BE.php" method = "POST">

            <label for="o_id">Opportunity ID :</label>
            <input type="text" class="form-control" id="o_id" name = "o_id" value = <?php echo $s_oid; ?>>

            <label for="oType">Type of Opportunity:</label>
            <input type="text" class="form-control" id="oType" name = "oType" value = <?php echo $sType; ?>>

            <label for="app_dead">Application Deadline:</label>
            <input type="date" class="form-control" id="app_dead" name = "app_dead" value = <?php echo $sDead; ?>>

            <label for="start_date">Start Date:</label>
            <input type="date" class="form-control" id="start_date" name = "start_date" value = <?php echo $sStart; ?>>

            <label for="req">Requirement GPA:</label>
            <input type ="text" class="form-control" id="req1" name = "req1" value = <?php echo $sGPA; ?>>

            <div class="row">
              <div class="col-md-6">
                <label for="req2">Recommendation:</label>
                  <select class="form-control" name = "req2" value = <?php echo $sRec; ?>>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
              </div>
            </div>

            <label for="desc">Description:</label>
            <input type ="text" class="form-control" id="desc" name = "desc" value = <?php echo $sDesc; ?>>

            <?php
            if($isEdit){
              echo '<input type="checkbox" name="o_edit" value="1">Confirm Edit';
            }
            ?>
          </div>
        </div>
        <div class="row top5" >
          <div class="col-md-6">
            <button type="Submit" class="btn btn-primary" value="submit" name="submit">Add</button>
          </form>
        </div>
      </div>


      <?php
      $sql = "SELECT * FROM Opportunity";
      $result = mysql_query($sql);
        ?>
        <script language="JavaScript">
        function toggle(source) {
          checkboxes = document.getElementsByName('ve');
          for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
          }
        }
        </script>
        <script type = "text/javascript">


        </script>
        <div class="row">
          <div class="col-md-12">
            <h3>Manage Opportunities</h3>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <form action= "oppor_BE.php" method = "POST">
              <div class="table-responsive">
                <table class="table table-striped" style="width:auto" id="opp">
                  <thead>
                    <tr>
                      <th><input type="checkbox" name="everything" onClick="toggle(this)"></th>
                      <th>ID</th>
                      <th>Type</th>
                      <th>Start</th>
                      <th>Application Deadline</th>
                      <th>Required GPA</th>
                      <th>Recommendation</th>
                      <th>Created by</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while($row = mysql_fetch_assoc($result)){
                      echo "<tr>";
                        $opp_id =$row["O_ID"];
                        echo "<td>".'<input type="checkbox" name="ve[]" value="'.$opp_id.'" >'."</td>";
                        echo "<td>".$opp_id."</td>";
                        echo "<td>".$row["OType"]."</td>";
                        echo "<td>".$row["OStart"]."</td>";
                        echo "<td>".$row["OApp_dealine"]."</td>";
                        echo "<td>".$row["OGPA"]."</td>";
                        echo "<td>".$row["OReccommendation"]."</td>";
                        echo "<td>".$row["MEmail"]."</td>";
                        echo "<td>".$row["ODescription"]."</td>";
                        echo "</tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <button type="submit" class="btn btn-danger btn-block" style="width:20%" value="delete" name="delete">Delete</button>
              </form>
            </div>
          </div>

      <?php
      $s_oid = $_POST['sId'];
      $search = "SELECT * FROM Opportunity WHERE O_ID = '".$s_oid."'";
      //echo $search;
      $sre = mysql_query($search);
      $row = mysql_fetch_assoc($sre);
      $sType = $row["OType"];
      $sStart = $row["OStart"];
      $sDead = $row["OApp_dealine"];
      $sGPA = $row["OGPA"];
      $sRec = $row["OReccommendation"];
      $sDesc = $row["ODescription"];
      $isEdit = true;
      header('Location:oppor.php');
      include_once ('oppor_BE.php');
      mysqli_close($connection); ?>
    </div>

    <footer class="pathway-footer top30">
      <p><h4>Built by Pathway Inc.</h4></p>
    </footer>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


  </body>
</html>
