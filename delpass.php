<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Delete Password - Password Manager</title>
<link rel="stylesheet" href="lib/w3.css">
</head>
<body>
<form action="dashboard.php" method="post" target="_top">

<?php
$uid=$_REQUEST['uid'];
$id=$_REQUEST['id'];
$pwd=$_REQUEST['pwd'];
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "pswdman";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("<div class=\" w3-container w3-green w3-center\"><h3>Failed! A error occured!</h3></div>");
} 

// sql to delete a record
$sql = "DELETE FROM ".$uid." WHERE id=".$id;

if ($conn->query($sql) === TRUE) {
    echo "<div class=\" w3-container w3-green w3-center\"><h3>Success!</h3></div>";
} else {
    //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	echo "<div class=\" w3-container w3-green w3-center\"><h3>Failed! A error occured!</h3></div>";
}
echo "<input type=\"text\" name=\"username\" value=\"".$uid."\" hidden>";
echo "<input type=\"password\" name=\"password\" value=\"".$pwd."\" hidden>";
echo "<input type=\"submit\" style=\"width:100%\" class=\"w3-btn\" value=\"Click Here To Go Back To Dashboard\">";

$conn->close();
?>


