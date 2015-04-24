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


  if(isset($_POST['submit'])){
     postOpp();
  }
  else if(isset($_POST['delete'])){
     deleteOpp();
  }
  else if(isSet($_POST['modify'])){
    modOpp();
  }


  function postOpp(){
    echo "Hello 1";
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
    header('Location:oppor.php');
  }

  function deleteOpp(){
    echo "Hello 2";
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
    header('Location:oppor.php');
  }

  function modOpp(){

  }
?>
