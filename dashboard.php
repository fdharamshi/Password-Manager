<?php
$uid=$_REQUEST['username'];
$pwd=$_REQUEST['password'];
$uid=strtolower($uid);

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
echo "<header class=\"w3-card-4 w3-teal\"><h1><img src=\"images/img_opt.png\"/>&nbsp;".$uid."</h1></header>";

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
				echo "<button onclick=\"document.getElementById('idadd').style.display='block'\" class=\"w3-btn w3-half\">Add Password</button>\n";
				$sql2 = "SELECT id, username, password, site, notes FROM ".$table."";
				$result2 = $conn->query($sql2);
				if ($result2->num_rows > 0) {
						echo "<table class=\"w3-table w3-card-4 w3-striped w3-bordered w3-border\">";
						echo "<tr class=\"w3-teal w3-row\"><th class=\"w3-third w3-center\">Site</th><th class=\"w3-third w3-center\">Username</th><th class=\"w3-third w3-center\">Password</th></tr>";
						while($row2 = $result2->fetch_assoc()) {
							echo "<tr class=\"w3-row\"><td class=\"w3-third w3-center\">".$row2['site']."</td><td class=\"w3-third w3-center\">".$row2['username']."</td><td class=\"w3-third w3-center\"><button onclick=\"document.getElementById('id".$row2['id']."').style.display='block'\"
class=\"w3-btn\">See Password</button><button onclick=\"document.getElementById('did".$row2['id']."').style.display='block'\"
class=\"w3-btn w3-red\">Delete Password</button></td></tr>";
							echo "<tr class=\"w3-row\"><td class=\"w3-center\">".$row2['notes']."</td></tr>";
							echo "<div id=\"id".$row2['id']."\" class=\"w3-modal\">";
							echo "<span onclick=\"document.getElementById('id".$row2['id']."').style.display='none'\" class=\"w3-closebtn w3-hover-red w3-container w3-padding-16 w3-display-topright\">&times;</span>";
  								echo "<div class=\"w3-modal-content w3-animate-zoom\">";
   								echo "<header class=\"w3-container w3-teal\"> ";
								echo "<span onclick=\"document.getElementById('id".$row2['id']."').style.display='none'\" class=\"w3-closebtn w3-hover-red w3-container w3-padding-16 w3-display-topright\">&times;</span>";
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
									//DELETE MODAL
									echo "<!--The Modal-->\n";
									echo "<div id=\"did".$row2['id']."\" class=\"w3-modal\">\n";
									echo "<span onclick=\"document.getElementById('did".$row2['id']."').style.display='none'\" class=\"w3-closebtn w3-padding-16 w3-container w3-hover-red w3-display-topright\">&times;</span> \n";
									echo "  <div class=\"w3-modal-content\">\n";
									echo "    <header class=\"w3-container w3-teal\"> \n";
									echo "      <h2>Delete A Password</h2>\n";
									echo "    </header>\n";
									echo "    <div class=\"w3-container\">\n";
									echo "    	<div class=\"w3-section\">\n";
									echo "        	<form method=\"post\" action=\"delpass.php\" target=\"output_frame".$row2['id']."\">\n";
									echo "            	<input type=\"text\" name=\"id\" value=\"".$row2['id']."\" hidden>\n";
									echo "                <input type=\"text\" name=\"uid\" value=\"".$uid."\" hidden>\n";
									echo "                <input type=\"password\" name=\"pwd\" value=\"".$pwd."\" hidden>\n";
									echo "\n";                
									echo "                <input type=\"submit\" class=\"w3-btn w3-red w3-row\" style=\"width:100%\" value=\"Are You Sure?\">\n";
									echo "            </form>\n";
									echo "            <iframe name=\"output_frame".$row2['id']."\" src=\"about:blank\" id=\"output_frame\" width=\"100%\" height=\"105\" frameborder=\"0\">\n";
									echo "			</iframe> \n";
									echo "        </div>\n";
									echo "    </div>\n";
									echo "    <footer class=\"w3-container w3-teal\">\n";
									echo "      <p>Developed By Femin Dharamshi</p>\n";
									echo "    </footer>\n";
									echo "  </div>\n";
									echo "</div>\n";
						}
						echo "</table>";
						//ADD A PASSWORD
						echo "<!--The Modal-->\n";
						echo "<div id=\"idadd\" class=\"w3-modal\">\n";
						echo "<span onclick=\"document.getElementById('idadd').style.display='none'\" class=\"w3-closebtn w3-padding-16 w3-container w3-hover-red w3-display-topright\">&times;</span> \n";
						echo "  <div class=\"w3-modal-content\">\n";
						echo "    <header class=\"w3-container w3-teal\"> \n";
						echo "      <h2>Add A Password</h2>\n";
						echo "    </header>\n";
						echo "    <div class=\"w3-container\">\n";
						echo "    	<div class=\"w3-section\">\n";
						echo "        	<form method=\"post\" action=\"addpass.php\" target=\"output_frame\">\n";
						echo "            	<label class=\"w3-label w3-validate\">Site</label>\n";
						echo "            	<input class=\"w3-input w3-border\" type=\"text\" name=\"site\">\n";
						echo "\n";
						echo "                <label class=\"w3-label w3-validate\">Username</label>\n";
						echo "                <input class=\"w3-input w3-border\" type=\"text\" name=\"username\">\n";
						echo "\n";
						echo "                <label class=\"w3-label w3-validate\">Password</label>\n";
						echo "                <input class=\"w3-input w3-border\" type=\"password\" name=\"password\">\n";
						echo "\n";
						echo "                <label class=\"w3-label w3-validate\">Notes</label>\n";
						echo "                <input class=\"w3-input w3-border\" type=\"text\" name=\"notes\">\n";
						echo "                <input type=\"text\" name=\"uid\" value=\"".$uid."\" hidden><br>\n";
						echo "                <input type=\"password\" name=\"lpwd\" value=\"".$pwd."\" hidden><br>\n";
						echo "\n";                
						echo "                <div class=\"w3-row\"><input type=\"submit\" class=\"w3-btn w3-half\" value=\"Add Password\"><input type=\"reset\" value=\"Clear\" class=\"w3-btn w3-half\"></div>\n";
						echo "            </form>\n";
						echo "            <center><iframe name=\"output_frame\" src=\"about:blank\" id=\"output_frame\" width=\"100%\" height=\"95\" frameborder=\"0\"></center>\n";
						echo "			</iframe> \n";
						echo "        </div>\n";
						echo "    </div>\n";
						echo "    <footer class=\"w3-container w3-teal\">\n";
						echo "      <p>Developed By Femin Dharamshi</p>\n";
						echo "    </footer>\n";
						echo "  </div>\n";
						echo "</div>\n";
						echo "<script>\n";
						echo "// Get the modal\n";
						echo "var modal = document.getElementById('idadd');\n";
						echo "\n";
						echo "// When the user clicks anywhere outside of the modal, close it\n";
						echo "window.onclick = function(event) {\n";
						echo "    if (event.target == modal) {\n";
						echo "        modal.style.display = \"none\";\n";
						echo "    }\n";
						echo "}\n";
						echo "</script>\n";
						echo "\n";
						//ADD A PASSWORD
							
				}
				else{
					//IF NOT STORED ANY PASSWORDS	
					echo "Your Account Does Not Contain Any Passwords!";
				}
				break;
			}
			else
			{
				//echo "incorrect password";	
				echo "<div class=\"w3-card-8 w3-red w3-center\"><h1>INCORRECT PASSWORD!</h1></div>";
				echo "<center><a href=\"index.html\"><button class=\"w3-btn w3-center\">Go Back To Login Page</button></a></center>";
			}
		}
    }
	if($u==false)
		{
				//echo "Username not found !";
				echo "<div class=\"w3-card-8 w3-red w3-center\"><h1>USERNAME NOT FOUND!</h1></div>";
				echo "<center><a href=\"index.html\"><button class=\"w3-btn w3-center\">Go Back To Login Page</button></a></center>";
		}
}
$conn->close();

echo "</body></html>";
?>