<html>
<head>
<title> Is Site Secured </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">
<link href="CSS/styles.css" rel="stylesheet">
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
			<label id="upload">Select file to upload: </label>
			<input type="file" name="upload"/>
		</div> 
		<div> 
			<br/>
			<input class= "formButton" type="hidden" name="action" value="upload"/> 
			<input type="submit" name="submit" class= "formButton" value="Submit" onclick="clearBox()"/> 
		</div> 
	</form>
	<br/>
	<div id="results">
		<b>Results - </b><br/>
		<?PHP
			if(isset($_POST["submit"])){
				$fileExt = explode(".", $_FILES['upload']['name']);
				$vFileExt = ['csv'];
				
				if(!in_array($fileExt[1],$vFileExt)){
					print "The selected file format is not supported.<br/> Please choose to upload only csv files";
				} else {					
					$row = 0;  //To display the row
					$retCnt = 0;
					$result = "";
					$urlCol = 6;
					$mycsvfile = array(); //define the main array.
					$file = fopen($_FILES['upload']['tmp_name'],"r"); //Reading file
					if (($fhandle = $file) !== FALSE) { 
						while (($data = fgetcsv($fhandle, 1000, ",")) !== FALSE) {//While loop until the last record is fetched
							$mycsvfile[] = $data; //add the row to the main array.
							
							
							$temp = $mycsvfile[$row][$urlCol]; //Fetching the rows in order and only 6th column, in our file, 6th column is the URL which we need
							$findme   = 'https://'; //this is the needle we need to find in the haystack(our file)
							
							$pos = strpos($temp, $findme);
							if ($pos !== false) { //If substring exists, print
								$result .= $mycsvfile[$row][6]."<br> \n";
								$retCnt +=1;
							}
							$row++; //Pointer moved to next row
						}
						fclose($fhandle);
					}	
					
					print "Total Record(s): $row <br/>No. of secured URLs: $retCnt<br/>";
					
					if($retCnt != 0){
						print"<br/><div style='width: 700px; height: 300px; overflow-y: scroll'>";
						print "<br/> ".$result;
						print "</div>";
					}
				}
			}
		?>
	</div>
</div>
</body>
</html>