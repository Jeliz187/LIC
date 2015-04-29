<?php
session_start();
?>


<html>
	<body>

		<form method="post" enctype="multipart/form-data">
			<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
				<tr>
					<td width="246">
					<input type="hidden" name="MAX_FILE_SIZE" value="9000000">
					<input name="userfile" type="file" id="userfile">
					</td>
				<td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
				</tr>
			</table>
		</form>


	<?php
	ini_set ("display_errors", "1");
	error_reporting(E_ALL);
	if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
	{
		$fileName = $_FILES['userfile']['name'];
		$tmpName  = $_FILES['userfile']['tmp_name'];
		$fileSize = $_FILES['userfile']['size'];
		$fileType = $_FILES['userfile']['type'];

		$fp      = fopen($tmpName, 'r');
		$content = fread($fp, filesize($tmpName));
		$content = addslashes($content);
		fclose($fp);

    $host='earth.cs.utep.edu';
    $user='cs_vosanchez';
    $password='dogK9';
    $database='cs4342team4sp15';
		$con=mysql_connect($host, $user, $password);
				if(!$con){
					die('Could not connect: ' . mysqli_error());
				}
    mysql_query("use cs4342team4sp15");
    $sql = "INSERT INTO Member_Picture VALUES ('".$_SESSION['username']."','".$content."');";
		mysql_query($sql);


		echo "<br>File $fileName uploaded<br>";
	}
	?>
	</body>
</html>
