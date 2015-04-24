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
$result = mysql_query("SHOW COLUMNS FROM Member;");
//echo $result;
if (!$result) {
  echo 'Could not run query: ' . mysql_error();
  exit;
}

// echo 'Good so far';//debug code $
if(isset($_POST['accept'])){//approve selected
  approve();
  echo "Approve";//debug code $
}
else if(isSet($_POST['add'])){//insert new entry
  insert();
  echo "Add";//debug code $
}
else if(isSet($_POST['delete'])){//delete
  deletePro();
  echo "Delete";//debug code $
}
else if(isSet($_POST['edit'])){//edit
  editPro();
  echo "Edit";//debug code $
}

function editPro(){
  // echo "Hello Edit";
  $cEmail = $_POST['email'];

  if($cEmail != ""){
    $paass = $_POST['pass'];
    $fname =$_POST['fname'];
    $lname =$_POST['lname'];
    $email =$_POST['email'];
    $dob = $_POST['bday'];
    $origin = $_POST['country'];
    $soId = $_POST['socId'];
    $edu = $_POST['edu'];
    $job = $_POST['job'];
    $web = $_POST['web'];
    $type = $_POST['type'];
    $inter = $_POST['interest'];
    $org = $_POST['orginization'];
    $street = $_POST['aSTreet'];
    $city = $_POST['aCity'];
    $sip = $_POST['azip'];
    $state = $_POST['aState'];
    $mtype = $_POST['mType'];
    $tel = $_POST['mtel'];

    //picture Grab
    // ini_set ("display_errors", "1");
    // error_reporting(E_ALL);
    // if(isset($_POST['edit']) && $_FILES['userfile']['size'] > 0)
    // {
    //   $fileName = $_FILES['userfile']['name'];
    //   $tmpName  = $_FILES['userfile']['tmp_name'];
    //   $fileSize = $_FILES['userfile']['size'];
    //   $fileType = $_FILES['userfile']['type'];
    //
    //   $fp      = fopen($tmpName, 'r');
    //   $content = fread($fp, filesize($tmpName));
    //   $content = addslashes($content);
    //   fclose($fp);
    //
    //   // echo "<br>File $fileName uploaded<br>";
    // }
    $pic =$content ="";

    $sql5 = "UPDATE Member SET MEmail ='".$email."',MPassword = '".$paass."',
    MFname = '".$fname."',MLname = '".$lname."',MSocialID = '".$soId."',
    MWebsite ='".$web."',MFieldofInterest = '".$inter."',MOrginization = '".$org."',
    MOccupation = '".$job."',MEducation = '".$edu."',MStreetAddress = '".$street."',
    MCity = '".$city."',MState = '".$state."',MZip = '".$sip."',MCountryOfOrigin = '".$origin."',
    MType ='".$mtype."',MPhone = '".$tel."',MDateofBirth ='".$dob."' WHERE MEmail ='".$email."';";
    echo $sql5;
    mysql_query($sql5);
  }
  header('Location:allUsers.php');
}

function insert(){
  echo "insert";
  $email =$_POST['email'];
  if($email != ""){
    $paass = $_POST['pass'];
    $fname =$_POST['fname'];
    $lname =$_POST['lname'];
    $email =$_POST['email'];
    $dob = $_POST['bday'];
    $origin = $_POST['country'];
    $soId = $_POST['socId'];
    $edu = $_POST['edu'];
    $job = $_POST['job'];
    $web = $_POST['website'];
    $type = $_POST['type'];
    $inter = $_POST['interest'];
    $org = $_POST['orginization'];
    $street = $_POST['aSTreet'];
    $city = $_POST['aCity'];
    $sip = $_POST['azip'];
    $state = $_POST['aState'];
    $mtype = $_POST['mType'];
    $tel = $_POST['mtel'];

    //picture Grab
    // ini_set ("display_errors", "1");
    // error_reporting(E_ALL);
    // if(isset($_POST['add']) && $_FILES['userfile']['size'] > 0)
    // {
    //   $fileName = $_FILES['userfile']['name'];
    //   $tmpName  = $_FILES['userfile']['tmp_name'];
    //   $fileSize = $_FILES['userfile']['size'];
    //   $fileType = $_FILES['userfile']['type'];
    //
    //   $fp      = fopen($tmpName, 'r');
    //   $content = fread($fp, filesize($tmpName));
    //   $content = addslashes($content);
    //   fclose($fp);

      // echo "<br>File $fileName uploaded<br>";
    }
    $pic =$content;

    if($email != "" && $fname != ""){
      if($_SESSION["usertype"] == 2){
        $sql = "INSERT INTO Member VALUES ('".$email."', '".$paass."', '".$fname."', '".$lname."', '1', '".$soId."',
        '".$web."', '".$inter."', '".$org."', '".$job."', '".$edu."', '".$street."', '".$city."', '".$state."', '".$sip."',
         '".$origin."', '".$mtype."', '".$content."', '".$tel."', '".$dob."');";
        //echo $sql;//debug code $
      }
      else{
        $sql = "INSERT INTO Member VALUES ('".$email."', '".$paass."', '".$fname."', '".$lname."', '0', '".$soId."',
        '".$web."', '".$inter."', '".$org."', '".$job."', '".$edu."', '".$street."', '".$city."', '".$state."', '".$sip."',
         '".$origin."', '".$mtype."', '".$content."', '".$tel."', '".$dob."');";
      }
    }
    echo $sql;
    mysql_query($sql);
  }
  if($_SESSION["usertype"] == 2){
    header('Location:allUsers.php');
  }
  else{
    header('Location:welcome.php');
  }


}

function deletePro(){
  $email =$_POST['email'];
  $sql2 = 'DELETE FROM Member WHERE MEmail = "'.$email.'";';
  $sql3 = 'DELETE FROM Attends_Event WHERE MEmail = "'.$email.'";';
  // echo $sql3;
  mysql_query($sql3);
  mysql_query($sql2);
  header('Location:allUsers.php');
}

function approve(){
  $forDel;
  if(isset($_POST['va'])){
    if (is_array($_POST['va'])) {
      foreach($_POST['va'] as $value){
        // echo $value."+";
        $forDel[] = $value;
      }
    }
    // else {
    //   $forDel[] = $_POST['va'];
    //   //echo $value."|";
    // }
  }
  $sqlForDel;
  for($x=0; $x<count($forDel);$x++){
    $sql2 = "UPDATE Member SET MApproved ='1' WHERE MEmail = '".$forDel[$x]."';";
    // echo $sql2;//debug code $
    mysql_query($sql2);
    $sqlForDel[] = $sql2;
    //echo $forDel[$x]."|";//debug code $
  }
  header('Location:allUsers.php');
}
?>
