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
$result = mysql_query("SHOW COLUMNS FROM Opportunity;");
//echo $result;
if (!$result) {
  echo 'Could not run query: ' . mysql_error();
  exit;
}


  if(isset($_POST['add'])){
     postEvent();
  }
  else if(isset($_POST['delete'])){
     deleteEvent();
  }
  else if(isSet($_POST['edit'])){
    modEvent();
  }


  function postEvent(){
    $e_id = $_POST['e_id'];
    $ename = $_POST['ename'];
    $evenue = $_POST['evenue'];
    $epicture = "";
    $edate = $_POST['edate'];
    $etime = $_POST['etime'];
    $ersvp = $_POST['ersvp'];
    $edetail = $_POST['edetail'];
    $sname = $_POST['sname'];
    $stel = $_POST['stel'];
    $semail = $_POST['semail'];
    $memail = $_SESSION['username'];


    $sql = "INSERT INTO Event VALUES ('".$e_id."', '".$ename."', '".$evenue."', '".$epicture."', '".$edate."', '".$etime."', '".$ersvp."', '".$edetail."', '".$memail."');";
    echo $sql;

    $sql2 = "INSERT INTO Sponsor VALUES ('".$semail."', '".$stel."', '".$sname."');";
    echo $sql2;

    $sql3  = "INSERT INTO Sponsored_By VALUES ('".$e_id."', '".$semail."');";
    echo $sql3;


    // echo $sql;//debug code $
    if($e_id> 0){
      mysql_query($sql2);
      mysql_query($sql1);
      mysql_query($sql3);
    }
    header('Location:event2.php');
  }

  function deleteEvent(){
    $forDel;
    if(isset($_POST['ve'])){
      if (is_array($_POST['ve'])) {
        foreach($_POST['ve'] as $value){
          // echo $value."+";
          $forDel[] = $value;
          }
      }
      // else {
      //   $value = $_POST['ve'];
      //   // echo $value."|";
      // }
    }

    $sqlForDel;
    for($x=0; $x<count($forDel);$x++){
      $sql2 = 'DELETE FROM Event WHERE E_ID = "'.$forDel[$x].'";';
      $sql3 = 'DELETE FROM Sponsored_By WHERE E_ID = "'.$forDel[$x].'";';
      // echo $sql2;//debug code $
      // echo $sql3;//debug code $
      mysql_query($sql3);
      mysql_query($sql2);
    }
    header('Location:event2.php');
  }

  function modEvent(){
    $e_id = $_POST['e_id'];
    $ename = $_POST['ename'];
    $evenue = $_POST['evenue'];
    $epicture = "";
    $edate = $_POST['edate'];
    $etime = $_POST['etime'];
    $ersvp = $_POST['ersvp'];
    $edetail = $_POST['edetail'];
    $sweb = $_POST['sWeb'];
    $stel = $_POST['stel'];
    $semail = $_POST['semail'];
    $memail = $_SESSION['username'];

    $sql5 = "UPDATE Event SET E_ID ='".$e_id."',EName = '".$ename."',
    EVenue = '".$evenue."',EPicture = '".$epicture."',EDate = '".$edate."',
    ETime ='".$etime."',ERSVP = '".$ersvp."',EDetail = '".$edetail."',
    MEmail = '".$memail."';";

    $sql6 = "UPDATE Sponsored_By SET E_ID ='".$e_id."',SEmail = '".$semail."';";

    $sql7 = "UPDATE Sponsor SET SEmail ='".$semail."',SPhone = '".$stel."',
    SWebsite = '".$sweb."';";

    mysql_query($sql5);
    mysql_query($sql6);
    mysql_query($sql7);

    header('Location:event2.php');
  }
?>
