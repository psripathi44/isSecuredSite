<?PHP
require "db.inc";
if (!($connection = @ mysqli_connect("localhost", $username, $password)))//Connecting to localhost
	die("Could not connect to database"); 

if (!mysqli_select_db($connection, $databaseName)) //connecting to Database using "db.inc"
	showerror($connection);
$delTemp = 'truncate table tempstore';
@mysqli_query ($connection, $delTemp);

header("Location: http://localhost/issecuredsite/isSecuredSite/index.php"); /* Redirect browser */
exit();

?>			