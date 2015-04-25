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
        $result = mysql_query("SHOW COLUMNS FROM Opportunity");
        if (!$result) {
            echo 'Could not run query: ' . mysql_error();
            exit;
        }

        //echo "<p> Got Somthing</p>";//debug code $

        if(isset($_POST['va'])){
          if (is_array($_POST['va'])) {
            foreach($_POST['va'] as $value){
              // echo $value."+";
              $for = $value;
            }
          }
        }
        $sql = "SELECT * FROM Opportunity";
        $result = mysql_query($sql);
        ?>

<body>
<div class="container">

  <div class="row">
    <div class="col-md-12">
      <h3>Opportunities</h3>
    </div>
  </div>

  <div class="col-md-6">
  <?php if($_SESSION["usertype"] == "2"){?>
    <form action="oppor.php" method = "POST">
      <button type="submit" class="btn btn-primary btn-block" style="width:20%" name = "new" value="new">New Event</button>
    </form>

  <?php }//if close ?>
</div>
  <div class="col-md-12">
    <?php
      if($_SESSION["usertype"] == "2"){
        echo '<form action="oppor.php" method = "post">';
      }
      else{
        echo '<form action="oppor_BE.php" method = "post">';
      }
    ?>
      <div class="table-responsive">
        <table class="table table-striped" style="width:auto" id="opp">
          <thead>
            <tr>
              <?php if($_SESSION["usertype"] == "2"){ echo "<th></th>";} ?>
              <th>ID</th>
              <th>Type</th>
              <th>Start Date</th>
              <th>Application Deadline</th>
              <th>Required GPA</th>
              <th>Reccommendation</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while($row = mysql_fetch_assoc($result)){
                echo "<tr>";
                $o_id =$row['O_ID'];
                if($_SESSION["usertype"] == "2" || $_SESSION["usertype"] == "1"){//only admins can select
                echo "<td>".'<input type="radio" name="va[]" value="'.$o_id.'" >'."</td>";
                }
                echo "<td>".$o_id."</td>";
                echo "<td>".$row['OType']."</td>";
                $os = $row['OStart'];
                echo "<td>".$os."</td>";
                echo "<td>".$row['OApp_dealine']."</td>";
                echo "<td>".$row['OGPA']."</td>";
                $or = $row['OReccommendation'];
                echo '<td>'.$or.'</td>';
                echo "<td>".$row["ODescription"]."</td>";
                echo "</tr>";
              }
            ?>

          </tbody>
        </table>
      </div>
      <?php if($_SESSION["usertype"] == "2"){ ?>
        <div class="row">
          <div class="col-md-2">
            <button type="submit" class="btn btn-defalut btn-block" style="width:40%" value="select" name="select" > Select </button>
          </div>
        </div>
      </form>
      <?php }
      else { ?>
        <div class="row">
          <div class="col-md-2">
            <button type="submit" class="btn btn-primary btn-block" style="width:40%" value="apply" name="apply" >Apply </button>
          </div>
        </div>
        <?php } ?>

    <?php
    $sql = "SELECT O_ID from Applies_For where MEmail =".$_SESSION['username'].";";
    $result = mysql_query($sql);
    ?>
    <table class="table table-striped" style="width:auto" id="applyed">
      <thead>
        <tr>
          <?php if($_SESSION["usertype"] == "2"){ echo "<th></th>";} ?>
          <th>ID</th>
          <th>Type</th>
          <th>Start Date</th>
          <th>Application Deadline</th>
          <th>Required GPA</th>
          <th>Reccommendation</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while($row = mysql_fetch_assoc($result)){
            echo "<tr>";
            $o_id =$row['O_ID'];
            echo "<td>".$o_id."</td>";
            echo "<td>".$row['OType']."</td>";
            $os = $row['OStart'];
            echo "<td>".$os."</td>";
            echo "<td>".$row['OApp_dealine']."</td>";
            echo "<td>".$row['OGPA']."</td>";
            $or = $row['OReccommendation'];
            echo '<td>'.$or.'</td>';
            echo "<td>".$row["ODescription"]."</td>";
            echo "</tr>";
          }
        ?>

      </tbody>
    </table>
    <?php
    include_once ('event_BE.php');
    mysqli_close($connection); ?>

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
