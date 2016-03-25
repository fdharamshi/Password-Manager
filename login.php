<?php
$uid=$_REQUEST['username'];
$pwd=$_REQUEST['password'];

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "pswdman";

echo "<!doctype html>";
echo "<html>";
echo "<head>";
echo "<meta charset=\"UTF-8\">";
echo "<title>Dashboard - Password Manager</title>";
echo "<link rel=\"stylesheet\" href=\"lib/w3.css\">";
echo "</head>";
echo "<body>";
echo "<header class=\"w3-card-4 w3-teal\"><h2><img src=\"img_opt.png\"/>".$uid."</h2></header>";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, username, password FROM login_info";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
	$p=false;
	$u=false;
    while($row = $result->fetch_assoc()) {
        if($row['username']==$uid)
		{
			$u=true;
			if($row['password']==$pwd)
			{
				$table=$uid;
				
				$sql2 = "SELECT id, username, password, site, notes FROM ".$table."";
				$result2 = $conn->query($sql2);
				if ($result2->num_rows > 0) {
						echo "<table class=\"w3-table w3-card-4 w3-striped w3-bordered w3-border\">";
						echo "<tr class=\"w3-teal w3-row\"><th class=\"w3-third w3-center\">Site</th><th class=\"w3-third w3-center\">Username</th><th class=\"w3-third w3-center\">Password</th></tr>";
						while($row2 = $result2->fetch_assoc()) {
							echo "<tr class=\"w3-row\"><td class=\"w3-third w3-center\">".$row2['site']."</td><td class=\"w3-third w3-center\">".$row2['username']."</td><td class=\"w3-third w3-center\"><button onclick=\"document.getElementById('id".$row2['id']."').style.display='block'\"
class=\"w3-btn\">See Password</button></td></tr>";
							echo "<tr class=\"w3-row\"><td class=\"w3-center\">".$row2['notes']."</td></tr>";
							echo "<div id=\"id".$row2['id']."\" class=\"w3-modal\">";
  								echo "<div class=\"w3-modal-content\">";
   								echo "<header class=\"w3-container w3-teal\"> ";
      									echo "<span onclick=\"document.getElementById('id".$row2['id']."').style.display='none'\" class=\"w3-closebtn\">&times;</span>";
      								echo "<h2>".$row2['username']."</h2>";
    								echo "</header>";
    								echo "<div class=\"w3-container\">";
      									echo "<p>Password : </p>";
      									echo "<p>".$row2['password']."</p>";
    								echo "</div>";
    								echo "<footer class=\"w3-container w3-teal\">";
      								echo "	<p>Developed By Femin Dharamshi</p>";
    								echo "</footer>";
  									echo "</div>";
									echo "</div>";
						}
						echo "</table>";
				}
				else{
					//IF NOT STORED ANY PASSWORDS	
					echo "Your Account Does Not Contain Any Passwords!";
				}
				break;
			}
			else
			{
				echo "incorrect password";	
			}
		}
    }
	if($u==false)
		{
				echo "Username not found !";
		}
}
$conn->close();

echo "</body></html>";
?>