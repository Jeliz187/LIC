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
    // echo "add";//debug code $
    $_SESSION['pageMode'] = "add";
     postEvent();
  }
  else if(isset($_POST['delete'])){
    // echo "delete";//debug code $
    $_SESSION['pageMode'] = "delete";
     deleteEvent();
  }
  else if(isSet($_POST['edit'])){
    // echo "edit";//debug code $
    $_SESSION['pageMode'] = "edit";
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
    $sweb = $_POST['sWeb'];
    $stel = $_POST['stel'];
    $semail = $_POST['semail'];
    $memail = $_SESSION['username'];


    $sql = "INSERT INTO Event VALUES ('".$e_id."', '".$ename."', '".$evenue."', '".$epicture."', '".$edate."', '".$etime."', '".$ersvp."', '".$edetail."', '".$memail."');";
    echo $sql;//debug code $

    $sql2 = "INSERT INTO Sponsor VALUES ('".$semail."', '".$stel."', '".$sweb."');";
    echo $sql2;//debug code $

    $sql3  = "INSERT INTO Sponsored_By VALUES ('".$e_id."', '".$semail."');";
    echo $sql3;//debug code $


    // echo $sql;//debug code $
    if($e_id> 0){
      mysql_query($sql2);
      mysql_query($sql1);
      mysql_query($sql3);
    }
    header('Location:eventView.php');
  }

  function deleteEvent(){//delete function working
    $for = $_POST['e_id'];
    $by = $_POST['semail'];
      $sql2 = 'DELETE FROM Event WHERE E_ID = "'.$for.'";';
      $sql3 = 'DELETE FROM Sponsored_By WHERE SEmail = "'.$by.'";';
      $sql4 = 'SELECT AT_ID FROM Attends_Event WHERE E_ID = '.$for.';';
      // echo $sql2;//debug code $
      // echo $sql3;//debug code $
      mysql_query($sql3);
      $res = mysql_query($sql4);
      while($row = mysql_fetch_assoc($res)){
        $w = $row['AT_ID'];
        $sql4 = 'DELETE FROM Attends_Event WHERE AT_ID = "'.$w.'";';
        // echo $sql4;//debug code $
        mysql_query($sql4);
      }
      mysql_query($sql2);
    header('Location:eventView.php');
  }

  function modEvent(){
    $e_id = $_POST['e_id'];
    $ename = $_POST['ename'];
    $evenue = $_POST['evenue'];
    $epicture = "";
    $edate = $_POST['edate'];
    $etime = $_POST['etime'];
    $ersvp = $_POST['ersvp'];
    $edetail = $_POST['edesc'];
    $sweb = $_POST['sWeb'];
    $stel = $_POST['stel'];
    $semail = $_POST['semail'];
    $memail = $_SESSION['username'];

    $sql5 = "UPDATE Event SET E_ID ='".$e_id."',EName = '".$ename."',EVenue = '".$evenue."',EPicture = '".$epicture."',EDate = '".$edate."',
    ETime ='".$etime."',ERSVP = '".$ersvp."' ,EDetail = '".$edetail."' ,MEmail ='".$memail."' WHERE E_ID ='".$e_id."';";

    $sql6 = "UPDATE Sponsored_By SET E_ID ='".$e_id."',SEmail = '".$semail."' WHERE SEmail ='".$semail."';";

    $sql7 = "UPDATE Sponsor SET SEmail ='".$semail."',SPhone = '".$stel."',SWebsite = '".$sweb."' WHERE SEmail ='".$semail."';";

    echo $sql5;
    echo $sql6;
    echo $sql7;

    mysql_query($sql5);//event update
    mysql_query($sql6);//sponsored by update
    mysql_query($sql7);//sponsor update

    header('Location:eventView.php');
  }
?>
