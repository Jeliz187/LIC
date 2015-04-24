

<?php
session_start();

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
$result = mysql_query("SHOW COLUMNS FROM Member");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}


$who = $_POST["uname"];
$key = $_POST["pass"];
echo $who ." _ ".$key;//debug code $
$search = "SELECT * FROM Member WHERE MEmail = '".$who."'";
//echo $search;//debug code $
$res = mysql_query($search);
$row=mysql_fetch_array($res);
$eMail = $row['MEmail'];
$uspass = $row['MPassword'];
$uType = $row['MType'];

echo $eMail."__".$uspass."__".$uType;

if($who == $eMail && $key == $uspass){
  $_SESSION["username"] = $who;
  if($uType == "Admin"){
    $_SESSION["usertype"] = 2;
  }
  else{
    $_SESSION["usertype"] = 1;
  }
}
    header('Location:welcome.php');
 ?>
