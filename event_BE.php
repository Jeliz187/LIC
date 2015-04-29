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
    $_SESSION['modeEve'] = "add";
     postEvent();
  }
  else if(isset($_POST['delete'])){
    // echo "delete";//debug code $
    $_SESSION['modeEve'] = "delete";
     deleteEvent();
  }
  else if(isSet($_POST['edit'])){
    // echo "edit";//debug code $
    $_SESSION['modeEve'] = "edit";
    modEvent();
  }
  else if(isSet($_POST['attend'])){
    // echo "apply";//debug code $
    $_SESSION['modeEve'] = "attend";
    attendEve();
  }//end else if
  else if(isSet($_POST['drop'])){
    // echo "drop";//debug code $
    $_SESSION['modeEve'] = "drop";
    dropEve();
  }//end else if
  else if(isSet($_POST['select'])){
    // echo "select";//debug code $
    $_SESSION['modeEve'] = "select";
      if(isset($_POST['va'])){
        if (is_array($_POST['va'])) {
          foreach($_POST['va'] as $value){
            // echo $value."+";
            $for = $value;
          }//end foreach
        }//end if
      }//end if
      // echo $for;
      $_SESSION['tempEve'] = $for;
      header('Location:event2.php');
  }//end else if


  //add new Event, Sponsor, and Sponsored by
  function postEvent(){
    // $e_id = $_POST['e_id'];
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

    $sql2 = "INSERT INTO Sponsor VALUES ('".$semail."', '".$stel."', '".$sweb."');";
    mysql_query($sql2);//Sponsor
    // echo $sql2;//debug code $

    $sql = "INSERT INTO Event VALUES ('null', '".$ename."', '".$evenue."', '".$epicture."', '".$edate."', '".$etime."', '".$ersvp."', '".$edetail."', '".$memail."');";
    mysql_query($sql);//Event second
    // echo $sql;//debug code $

    $sql4 = "SELECT E_ID FROM Event WHERE EName ='".$ename."';";
    // echo $sql4;//debug code $
    $result = mysql_query($sql4);
    $row = mysql_fetch_assoc($result);
    $tempID = $row['E_ID'];
    $sql3  = "INSERT INTO Sponsored_By VALUES ('".$tempID."', '".$semail."');";
    mysql_query($sql3);//Sponsored_by
    // echo $sql3;//debug code $

    header('Location:eventView.php');
  }

  //deletes selected event
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

  //edit selected event
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

    //debug code $
    // echo $sql5;
    // echo $sql6;
    // echo $sql7;

    mysql_query($sql5);//event update
    mysql_query($sql6);//sponsored by update
    mysql_query($sql7);//sponsor update

    header('Location:eventView.php');
  }

  //returns AP_ID if the id and email match in Attends_Event
  //else returns "-1"
  function attendId($id, $em){
    // echo $id." - ".$em.":";//debug code $
    $sql = "SELECT * FROM Attends_Event;";
    $res = mysql_query($sql);
    while($row = mysql_fetch_assoc($res)){
      $tid = $row['E_ID'];
      // echo $tid." - ";//debug code $
      if($id == $tid){
        $tem = $row['MEmail'];
        // echo $tem;//debug code $
        if($em == $tem){
          $ap = $row['AT_ID'];
          return $ap;
        }
      }
    }
    return -1;
  }//end of appliedId

  //returns boolean if the id and email match in Attends_Event
  function doesEveExist($id, $em){
    // echo $id." - ".$em;//debug code $
    $sql = "SELECT * FROM Attends_Event;";
    $res = mysql_query($sql);
    while($row = mysql_fetch_assoc($res)){
      $tid = $row['E_ID'];
      // echo $tid." - ";//debug code $
      if($id == $tid){
        $tem = $row['MEmail'];
        // echo $tem;//debug code $
        if($em == $tem){
          return true;
        }
      }
    }
    return false;
  }//end of doesOppExist

  //adds selected event to Attends_Event
  function attendEve(){
    if(isset($_POST['va'])){
      if (is_array($_POST['va'])) {
        foreach($_POST['va'] as $value){
          // echo $value."+";
          $for = $value;
        }
      }
    }

    $e_id =  $for;
    $m_email = $_SESSION['username'];

    if(!doesEveExist($o_id, $_SESSION['username'])){
      $sql2 = "INSERT INTO Attends_Event VALUES ('null', '".$m_email."', '".$e_id."');";
      // echo $sql2;
      mysql_query($sql2);
    }
    header('Location:eventView.php');
  }

  //deletes the selected event from Attends_Event
  function dropEve(){
    if(isset($_POST['va'])){
      if (is_array($_POST['va'])) {
        foreach($_POST['va'] as $value){
          // echo $value."+";
          $for = $value;
        }
      }
    }

    $e_id =  $for;
    $m_email = $_SESSION['username'];

    $atid = attendId($e_id, $m_email);

    if(!doesEveExist($o_id, $_SESSION['username'])){
      $sql2 = "DELETE FROM Attends_Event WHERE AT_ID ='".$atid."';";
      // echo $sql2;
      mysql_query($sql2);
    }
    header('Location:eventView.php');
  }
?>
