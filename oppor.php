<?php
//Start the Session
session_start();
include_once ('oppor_BE.php');
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
    //edit section
    if(isset($_POST['select'])){
      if(isset($_POST['va'])){
        if (is_array($_POST['va'])) {
          foreach($_POST['va'] as $value){
            // echo $value."+";
            $for = $value;
          }
        }
      }
    }
    else{
      $for = $_SESSION['tempOpp'];
      $_SESSION['tempOpp']= "";
    }

      $s_oid = $for;
      $search = "SELECT * FROM Opportunity WHERE O_ID = '".$s_oid."'";
      // echo $search;//debug code $
      $sre = mysql_query($search);
      $row = mysql_fetch_assoc($sre);
      $sType = $row["OType"];
      $sStart = $row["OStart"];
      $sDead = $row["OApp_dealine"];
      $sGPA = $row["OGPA"];
      $sRec = $row["OReccommendation"];
      $sDesc = $row["ODescription"];

  ?>


      <div class="row">
        <div class="col-md-12">
          <h3>Add an Opportunity</h3>
        </div>
      </div>



      <div class="row" >
        <div class="col-md-6">
          <form action="oppor_BE.php" method = "POST">
            <?php
            //shows opportunity id when in edit mode
            if($s_oid != ""){
              echo '<label for="o_id">Opportunity ID :</label>';
              echo '<input type="text" class="form-control" id="o_id" name = "o_id" value ='.$s_oid.' readonly>';
            }else{
              // echo '<input type="text" class="form-control" id="o_id" name = "o_id" value ='.$s_oid.'>';
            }
            ?>

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
          </div>
        </div>
        <div class="row top5" >
            <?php
            if($_SESSION["usertype"] == 2 && isset($_POST['select'])){//type 2 is admin

                // echo '<button type="submit" class="btn btn-default" name="add" value="add">Add</button>';

                echo '<div class="col-md-1">';
                echo '<button type="submit" class="btn btn-primary" name = "edit" value="edit">Edit</button>';
                echo '</div>';

                echo '<div class="col-md-1">';
                echo '<button type="submit" class="btn btn-danger" name="delete" value="delete">Delete</button>';
                echo '</div>';
            }
            else{
              echo '<div class="col-md-1">';
              echo '<button type="submit" class="btn btn-default" name="add" value="add">Add</button>';
              echo '</div>';
            }
            ?>
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
