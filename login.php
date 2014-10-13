<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' href='style.css'/>
	<script src='script.js'></script>
	<title>Welcome!</title>
</head>
<body>

<div class="header">
<h1>Welcome.</h1>
</div>
</body>
</div class>

<div class="info">
<center>
<?php
	$sqlconn=@mysqli_connect("localhost", "root", "", "scry") or die("There was a problem reaching the database.");
	
echo "<form method = \"POST\">
<form1>
Username:<input type=\"text\" name=\"Username\"><br>
</form1></center>
<center>
<form2>Password:
<input type=\"password\" name=\"pwd\">
</form2></center>
</div class>
<div class=\"fire\">
<input type = \"submit\" value = \"echos\">
</form>";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
$un = $pwd = "null";
if(isset($_POST['Username']))
{
	$un = $_POST['Username'];
}

if(isset($_POST['pwd']))
{
	$pwd = $_POST['pwd'];
}

$quer = "SELECT admin from users_t
		WHERE 
		username like \"$un\"
		AND BINARY
		password = \"$pwd\";
		";

$result = mysqli_query($sqlconn, $quer);

if(mysqli_num_rows($result) == 0){
			echo "<center>Invalid Username/ Password</p> please check if your CAPSLOCK is on.</center>";
			}
		else{
		$row = @mysqli_fetch_array($result);
			$status = "Slave";
			if($row['admin'] == 1)
			{
				$status = "Admin";
			}
			echo "<center>Welcom $status $un!</center>";
		}
		}

@mysqli_close($sqlconn);?>


</div>

</html>
