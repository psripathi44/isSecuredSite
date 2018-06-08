<html>
<head>
<title> Is Site Secured </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">
<link href="CSS/styles.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<header>
<h2 style="margin-left: 50px;"><a href="index.php">isSecuredSite</a></h2>
</header>
<div id="main">
	<h2>Welcome Admin! </h2>
	<h3>Upload the data file here to list out the secured site list -</h3>
	<form action="" method="post" enctype="multipart/form-data"> 
		<div>
			<label id="upload">Select file to upload & proceed: </label>
			<input type="file" name="upload" id="upload"/>
		</div> 
		<div> 
			<br/>
			<input class= "formButton" type="hidden" name="action" value="upload"/> 
			<input type="submit" name="submit" class= "formButton" value="Submit"/>
		</div> 
	</form>
	<div id="results">
		<b>Results - </b><br/>
		<?PHP
			if(isset($_POST["submit"])){
				require "db.inc";
	
				if (!($connection = @ mysqli_connect("localhost", $username, $password)))//Connecting to localhost
					die("Could not connect to database"); 
				
				if (!mysqli_select_db($connection, $databaseName)) //connecting to Database using "db.inc"
					showerror($connection);

				if ($result = mysqli_query($connection, "SELECT id FROM `tempstore` LIMIT 10"))
					$buffCheck = $result->num_rows;
				
				if($buffCheck > 0){
					print"You cannot proceed further as there exists data in buffer already from previous attempt.<br/>You can either - ";
					print "<form action='download.php'><button type='submit' class ='formButton1'> Download </button> </form>";
					print "<form action='clear.php'> <button type='submit' name='clear' class='formButton2'> Delete data from buffer </button></form>";
				}
				else{
					$temp = $_FILES['upload']['name'];
					if($temp == null){
						echo "Please select a file to proceed.";
						return;
					}
					$fileExt = explode(".", $_FILES['upload']['name']);
					if($fileExt[1] != "csv"){
						echo "The selected file format is not supported.<br/> Please choose to upload only csv files";
						return;
					} else {					
						$row = 0;  //To display the row
						$retCnt = 0;
						$result = "";
						$urlCol = 6;
						$step = 0;
						$mycsvfile = array(); //define the main array.
						$file = fopen($_FILES['upload']['tmp_name'],"r"); //Reading file
						if (($fhandle = $file) !== FALSE) { 
							while (($data = fgetcsv($fhandle, 10000, ",")) !== FALSE) {//While loop until the last record is fetched
								$mycsvfile[] = $data; //add the row to the main array.
								
								
								$temp = $mycsvfile[$row][$urlCol]; //Fetching the rows in order and only 6th column, in our file, 6th column is the URL which we need
								$findme   = 'https://'; //this is the needle we need to find in the haystack(our file)
								
								$pos = strpos($temp, $findme);
								if ($pos !== false) { //If substring exists, print
									$result .= $mycsvfile[$row][6]."<br> \n";
									try{
										$step += 1;
										$insTemp = "INSERT INTO tempstore(id, url) VALUES ('{$step}', '{$mycsvfile[$row][6]}')";
										if (!(@mysqli_query ($connection, $insTemp))) {
											print '<br><b style="color:#B60000">Exception:</b> ';
											throw new Exception(showerror($connection));
										}
									} catch(Exception $e) {
										print '<br><br><b style="color:#B60000">Exception: test</b> ' .$e->getMessage();
									}
									
									$retCnt +=1;
								}
								$row++; //Pointer moved to next row
							}
							fclose($fhandle);
						}	
						
						print "Total Record(s): $row &nbsp;&nbsp;&nbsp;No. of secured URLs: $retCnt<br/>";
						print "<form action='download.php'><button type='submit' class ='formButton1'> Download </button> </form>";
						print "<form action='clear.php'> <button type='submit' name='clear' class='formButton2'> Delete </button></form>";
						
						if($retCnt != 0){
							print"<div id='intRes'>";
							print "<br/> ".$result;
							print "</div>";
						}
					}
				}
			}
		?>
	</div>
</div>
</body>
</html>