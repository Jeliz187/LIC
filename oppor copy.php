<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
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
        <h1>OPPORTUNITIES</h1>
      </div>

<?php
  if($_SESSION["usertype"] == 2){
    ?>
    <form action="oppor.php" method = "POST">

      <label for="o_id">Search ID :</label>
      <input type="text" class="form-control"name = "sId">

      <button type="submit" class="btn btn-default btn-block" style="width:20%" name = "mod" value="Submit3">Modifiy</button>
    </form>
      <?php
      //edit section
      if(isset($_POST['mod'])){
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
        <h3>Add an Opportunity</h3>
      </div>



      <div class="row" >
        <form action="oppor.php" method = "POST">

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
          <button type="Submit" class="btn btn-primary" value="submit">Add</button>


        </form>
      </div>
      <!-- <?php
      //Adding new opportunity
      $o_id = $_POST['o_id'];
      $o_type = $_REQUEST['oType'];
      $ap_d = $_POST['app_dead'];
      $s_d = $_POST['start_date'];
      $o_gpa = $_POST['req1'];
      $o_recom = $_POST['req2'];
      $m_email = $_SESSION['username'];
      $o_desc = $_POST['desc'];

      if($_POST['o_edit'] != 1){
      $sql = "INSERT INTO Opportunity VALUES ('".$o_id."', '".$o_type."', '".$s_d."', '".$ap_d."', '".$o_gpa."', '".$o_recom."', '".$m_email."', '".$o_desc."');";
      if($o_id> 0){
        mysql_query($sql);
      }
    }
    //Edit section
    else if($_POST['o_edit'] == 1){
      //$sql = "UPDATE Opportunity SET OType='".$o_type."' OStart = '".$s_d."' OApp_dealine = '".$ap_d."' OGPA = '".$o_gpa."' OReccommendation ='".$o_recom."' ODescription ='".$o_desc."' WHERE id=".$o_id;
      $sql3 = 'DELETE FROM Opportunity WHERE O_ID = "'.$o_id.'";';
      $sql2 = "INSERT INTO Opportunity VALUES ('".$o_id."', '".$o_type."', '".$s_d."', '".$ap_d."', '".$o_gpa."', '".$o_recom."', '".$m_email."', '".$o_desc."');";
      if($o_id> 0){
        mysql_query($sql3);
        mysql_query($sql2);
      }
    }
    //  echo $sql;//debug code $


}
      ?> -->


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
          <h3>Manage Opportunities</h3>
        </div>
        <div class="row">
          <form action= "oppor.php" method = "POST">
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
              <button type="submit" class="btn btn-danger btn-block" style="width:20%" name ="del" value="Submit2">Delete</button>
            </form>
          </div>
      <?php
      if($_POST['del'] == "Submit2"){
      $forDel;
      if(isset($_POST['ve'])){
        if (is_array($_POST['ve'])) {
          foreach($_POST['ve'] as $value){
            //echo $value."+";
            $forDel[] = $value;
          }
        } else {
          $forDel[] = $_POST['ve'];
          //echo $value."|";
        }
      }
      $sqlForDel;
      for($x=0; $x<count($forDel);$x++){
        $sql2 = 'DELETE FROM Opportunity WHERE O_ID = "'.$forDel[$x].'";';
        //echo $sql;//debug code $
        mysql_query($sql2);
        $sqlForDel[] = $sql;
      //echo $forDel[$x]."|";//debug code $
        }
      }
      else if($_POST['mod'] == "Submit3"){

      }

      mysqli_close($connection);


      ?>
    </div>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


  </body>
</html>
