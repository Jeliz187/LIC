<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<body>

	<?php
				//CONNECT TO DATABASE USING PHP
				$host='earth.cs.utep.edu';
		    $user='cs_vosanchez';
		    $password='dogK9';
		    $database='cs4342team4sp15';
				$con=mysql_connect($host, $user, $password);
			if(!$con){
				die('Could not connect: ' . mysqli_error());
			}
			mysql_query("use cs4342team4sp15");
			$sql = "SELECT Picture FROM Member_Picture WHERE MEmail = '".$_SESSION['username']."';";
			$res = mysql_query($sql);
			$row = mysql_fetch_assoc($res);
			$data = $row['Picture'];
			// echo '<img src="data:image/jpeg;base64,' . base64_encode( $data ) . '" />';



			mysqli_close($con);

			?>



</body>
</html>
