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
  postOpp();
}//end if
else if(isset($_POST['delete'])){
  // echo "delete";//debug code $
  deleteOpp();
}//end else if
else if(isSet($_POST['edit'])){
  // echo "edit";//debug code $
  modOpp();
}//end else if
else if(isSet($_POST['apply'])){
  // echo "apply";//debug code $
  applyOpp();
}//end else if
else if(isSet($_POST['drop'])){
  // echo "drop";//debug code $
  dropOpp();
}//end else if
else if(isSet($_POST['select'])){
  // echo "select";//debug code $
    if(isset($_POST['va'])){
      if (is_array($_POST['va'])) {
        foreach($_POST['va'] as $value){
          // echo $value."+";
          $for = $value;
        }//end foreach
      }//end if
    }//end if
    echo $for;
    $_SESSION['tempOpp'] = $for;
    header('Location:oppor.php');
}//end else if


//adds new opportunity
function postOpp(){
  //Adding new opportunity
  $o_type = $_REQUEST['oType'];
  $ap_d = $_POST['app_dead'];
  $s_d = $_POST['start_date'];
  $o_gpa = $_POST['req1'];
  $o_recom = $_POST['req2'];
  $m_email = $_SESSION['username'];
  $o_desc = $_POST['desc'];

  $sql = "INSERT INTO Opportunity VALUES ('null', '".$o_type."', '".$s_d."', '".$ap_d."', '".$o_gpa."', '".$o_recom."', '".$m_email."', '".$o_desc."');";

    mysql_query($sql);
  //  echo $sql;//debug code $
  header('Location:opporView.php');
}//close postOpp

//deletes selected opportunity
function deleteOpp(){
  //get opportunity id that is going to be deleted
  $for = $_POST['o_id'];

  //search for all opportunity id and delet them in Applies_For
  $sql4 = 'SELECT AP_ID FROM Applies_For WHERE O_ID = '.$for.';';
  $res = mysql_query($sql4);
  while($row = mysql_fetch_assoc($res)){
    $w = $row['AP_ID'];
    $sql4 = 'DELETE FROM Applies_For WHERE AP_ID = "'.$w.'";';
    // echo $sql4;//debug code $
    mysql_query($sql4);
  }

  //delete the opportunity
  $sql2 = 'DELETE FROM Opportunity WHERE O_ID = "'.$for.'";';
  // echo $sql2;//debug code $
  mysql_query($sql2);


  header('Location:opporView.php');
}//close deleteOpp

//edit selected opportunity
function modOpp(){
  $o_id = $_POST['o_id'];
  $o_type = $_REQUEST['oType'];
  $ap_d = $_POST['app_dead'];
  $s_d = $_POST['start_date'];
  $o_gpa = $_POST['req1'];
  $o_recom = $_POST['req2'];
  $m_email = $_SESSION['username'];
  $o_desc = $_POST['desc'];

  $sql = "UPDATE Opportunity SET O_ID ='".$o_id."',OType = '".$o_type."',OStart = '".$s_d."',OApp_dealine = '".$ap_d."',OGPA = '".$o_gpa."',
  OReccommendation ='".$o_recom."',MEmail = '".$m_email."' ,ODescription = '".$o_desc."' WHERE O_ID ='".$o_id."';";

  mysql_query($sql);
  header('Location:opporView.php');
}//close modOpp

//adds selected opportunity to Applies_For
function applyOpp(){
  if(isset($_POST['va'])){
    if (is_array($_POST['va'])) {
      foreach($_POST['va'] as $value){
        // echo $value."+";
        $for = $value;
      }
    }
  }

  $o_id =  $for;
  $o_type = $_REQUEST['oType'];
  $m_email = $_SESSION['username'];
  $app = "emtpy";

  if(!doesOppExist($o_id, $_SESSION['username'])){
    $sql2 = "INSERT INTO Applies_For VALUES ('".$m_email."', '".$o_id."', '".$app."', 'null', '".date("Y-m-d")."');";
    // echo $sql2;
    mysql_query($sql2);
  }
  header('Location:opporView.php');
}//close applyOpp

//deletes the selected opportunity from Applies_For
function dropOpp(){
  if(isset($_POST['va'])){
    if (is_array($_POST['va'])) {
      foreach($_POST['va'] as $value){
        // echo $value."+";
        $for = $value;
      }
    }
  }
  $o_id = $for;
  $m_email = $_SESSION['username'];

  $apid = appliedId($o_id, $m_email);

  if(doesOppExist($o_id, $_SESSION['username'])){
    $sql2 = "DELETE FROM Applies_For WHERE AP_ID ='".$apid."';";
    echo $sql2;

    mysql_query($sql2);
  }//end if
  header('Location:opporView.php');
}//close applyOpp

//returns AP_ID if the id and email match in Applies_For
//else returns "-1"
function appliedId($id, $em){
  // echo $id." - ".$em.":";//debug code $
  $sql = "SELECT * FROM Applies_For;";
  $res = mysql_query($sql);
  while($row = mysql_fetch_assoc($res)){
    $tid = $row['O_ID'];
    // echo $tid." - ";//debug code $
    if($id == $tid){
      $tem = $row['MEmail'];
      // echo $tem;//debug code $
      if($em == $tem){
        $ap = $row['AP_ID'];
        return $ap;
      }
    }
  }
  return -1;
}//end of appliedId

//returns boolean if the id and email match in Applies_For
function doesOppExist($id, $em){
  // echo $id." - ".$em;//debug code $
  $sql = "SELECT * FROM Applies_For;";
  $res = mysql_query($sql);
  while($row = mysql_fetch_assoc($res)){
    $tid = $row['O_ID'];
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
?>
