<?PHP
require "db.inc";
if (!($connection = @ mysqli_connect("localhost", $username, $password)))//Connecting to localhost
	die("Could not connect to database"); 

if (!mysqli_select_db($connection, $databaseName)) //connecting to Database using "db.inc"
	showerror($connection);

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="export.csv"');
header('Pragma: no-cache');
header('Expires: 0');

$fd = fopen('php://output', 'w');

fputcsv($fd, array('Id', 'Secured URL')); //Do not use ID here - to avoid error - "SYLK File format detected"

$fetch = "SELECT id, url FROM tempstore";
$resArr = @ mysqli_query($connection,$fetch);
while ($record = @ mysqli_fetch_row($resArr))
	fputcsv($fd, $record);

die;
?>