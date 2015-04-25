<?php
//Start the Session
session_start();

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
  $result = mysql_query("SHOW COLUMNS FROM Achievement;");
  //echo $result;
  if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
  }


  if(isset($_POST['add'])){
    echo "add";
     postAch();
  }
  else if(isset($_POST['delete'])){
    echo "delete";
     deleteAch();
  }
  else if(isSet($_POST['edit'])){
    echo "edit";
    modAch();
  }


  function postAch(){
    $aEmail = $_POST['aEmail'];
    $aType = $_POST['aType'];
    $aDate = $_POST['aDate'];
    $aID = $_POST['aID'];


    $sql = "INSERT INTO Achievement VALUES ('".$aID."', '".$aDate."', '".$aType."', '".$aEmail."');";

    if($aID > 0){
      mysql_query($sql);
    }
  //  echo $sql;//debug code $
    header('Location:achiveView.php');
  }//close postOpp

  function deleteAch(){
    $for = $_POST['aID'];

      $sql4 = 'SELECT AP_ID FROM Applies_For WHERE O_ID = '.$for.';';
      $res = mysql_query($sql4);
      while($row = mysql_fetch_assoc($res)){
        $w = $row['AP_ID'];
        $sql4 = 'DELETE FROM Applies_For WHERE AP_ID = "'.$w.'";';
        echo $sql4;//debug code $
        mysql_query($sql4);
      }

      $sql2 = 'DELETE FROM Achievement WHERE A_ID = "'.$for.'";';
      // echo $sql2;//debug code $
      mysql_query($sql2);


    header('Location:achiveView.php');
  }//close deleteOpp

  function modAch(){
    $aEmail = $_POST['aEmail'];
    $aType = $_POST['aType'];
    $aDate = $_POST['aDate'];
    $aID = $_POST['aID'];

    $sql = "UPDATE Achievement SET A_ID ='".$aID."',ADate = '".$aDate."',AType = '".$aType."',MEmail = '".$aEmail."' WHERE A_ID ='".$aID."';";

    mysql_query($sql);
    header('Location:achiveView.php');
  }//close modOpp
?>
