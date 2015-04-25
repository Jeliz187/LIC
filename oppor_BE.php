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
    echo "add";
     postOpp();
  }
  else if(isset($_POST['delete'])){
    echo "delete";
     deleteOpp();
  }
  else if(isSet($_POST['edit'])){
    echo "edit";
    modOpp();
  }
  else if(isSet($_POST['apply'])){
    echo "apply";
    applyOpp();
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

      $sql = "INSERT INTO Opportunity VALUES ('".$o_id."', '".$o_type."', '".$s_d."', '".$ap_d."', '".$o_gpa."', '".$o_recom."', '".$m_email."', '".$o_desc."');";

      if($o_id> 0){
        mysql_query($sql);
      }
  //  echo $sql;//debug code $
    header('Location:opporView.php');
  }//close postOpp

  function deleteOpp(){
    echo "Hello 2";
    $for = $_POST['o_id'];

      $sql4 = 'SELECT AP_ID FROM Applies_For WHERE O_ID = '.$for.';';
      $res = mysql_query($sql4);
      while($row = mysql_fetch_assoc($res)){
        $w = $row['AP_ID'];
        $sql4 = 'DELETE FROM Applies_For WHERE AP_ID = "'.$w.'";';
        echo $sql4;//debug code $
        mysql_query($sql4);
      }

      $sql2 = 'DELETE FROM Opportunity WHERE O_ID = "'.$for.'";';
      echo $sql2;//debug code $
      mysql_query($sql2);


    header('Location:opporView.php');
  }//close deleteOpp

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

  function applyOpp(){
    if(isset($_POST['va'])){
      if (is_array($_POST['va'])) {
        foreach($_POST['va'] as $value){
          // echo $value."+";
          $for = $value;
        }
      }
    }
    if($_SESSION['appID'] < 999){
      $temp =$_SESSION['appID'];
      $_SESSION['appID']= $temp + 1;
    }
    else{
      $_SESSION['appID'] = 0;
    }
    echo "apply";
    $o_id = $for;
    $o_type = $_REQUEST['oType'];
    $m_email = $_SESSION['username'];
    $app = "emtpy";

    $sql2 = "INSERT INTO Applies_For VALUES ('".$m_email."', '".$o_id."', '".$app."', '".$_SESSION['appID']."', '".date("Y-m-d")."');";
    // echo $sql2;

    mysql_query($sql2);
    header('Location:opporView.php');
  }//close applyOpp
?>
