<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Password - Password Manager</title>
<link rel="stylesheet" href="lib/w3.css">
</head>
<body>
<form action="dashboard.php" method="post" target="_top">

<?php
	 $luid=$_REQUEST['username'];//login uid
	 $lpwd=$_REQUEST['lpwd'];
	 $uid=$_REQUEST['uid'];//uid for table
	 $pwd=$_REQUEST['password'];
	 $site=$_REQUEST['site'];
	 $notes=$_REQUEST['notes'];
	 
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "pswdman";
	
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("<div class=\" w3-container w3-green w3-center\"><h3>Failed! A error occured!</h3></div>");
}

$sql = "INSERT INTO ".$uid." (site, username, password, notes)
VALUES ('".$site."', '".$luid."', '".$pwd."', '".$notes."')";

if (mysqli_query($conn, $sql)) {
    echo "<div class=\" w3-container w3-green w3-center\"><h3>Success!</h3></div>";
} else {
    //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	echo "<div class=\" w3-container w3-green w3-center\"><h3>Failed! A error occured!</h3></div>";
}

echo "<input type=\"text\" name=\"username\" value=\"".$uid."\" hidden>";
echo "<input type=\"password\" name=\"password\" value=\"".$lpwd."\" hidden>";
echo "<input type=\"submit\" style=\"width:100%\" class=\"w3-btn\" value=\"Click Here To Go Back To Dashboard\">";

mysqli_close($conn);
?>