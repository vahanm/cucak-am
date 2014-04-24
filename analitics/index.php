<h1>PHP MySQL Benchmark Tool v. 0.1</h1>
<a href="http://flickr.com/photos/getty/228212331/"><img src="bench.jpg" align="right" border="0"></a>
<?php
	require("dbconnect.inc.php");

	//TODO
	
	//  Beef up table cols / insert query	
	//  Add results to a separate table
	
	//  Get rid of scientific notation for low test times
	//  Add more tests, including full text search for MyISAM
	//  Add random number insert.
	//  Add exception handling
	//  Add debug option
	//  Better support for custom queries / table builds
	
	
	//  Do NOT set this to the name of an existing database because it will probably get deleted!!
	$dbName = "509_cucak";
	$tableName = "sqltest";
	
	
	//  Number of records to test with
	$totalIters =  $_GET['iterations'];
	if ($totalIters == 0)
		{  $totalIters = 500;   }
	
	//Table type to test with  --- add dropdown for other table types
	$tableType =  $_GET['tabletype'];
	if ($tableType == NULL)
		{   $tableType = "MYISAM";   
			// echo "Using default table type (MyISAM)<br>";
		}
	
	//  Sets the radio button for tabletype correctly
	if ($tableType == "MYISAM")
	{	$myisamSelected = "checked"; }
	if ($tableType == "INNODB")
	{	$innodbSelected = "checked"; }
	if ($tableType == "MEMORY")
	{	$memorySelected = "checked"; }

	echo "<form name=\"benchform\" method=\"get\"><strong>Test Rows:</strong> <INPUT NAME=\"iterations\" VALUE=\"$totalIters\" > <br>(* INNODB is relatively slow if you go over a few hundred rows)";
	echo "<br><strong>Table Type:</strong><br>";
	echo "<INPUT NAME=\"tabletype\" TYPE=\"RADIO\" VALUE=\"MYISAM\" $myisamSelected >MyISAM<br>";
	echo "<INPUT NAME=\"tabletype\" TYPE=\"RADIO\" VALUE=\"INNODB\" $innodbSelected >InnoDB<br>";
	echo "<INPUT NAME=\"tabletype\" TYPE=\"RADIO\" VALUE=\"MEMORY\" $memorySelected >Memory<br>";
	echo "<br><INPUT TYPE=\"SUBMIT\" VALUE=\"Benchmark\"> "; 
	
	echo "<h2>Testing a(n) $tableType table using $totalIters rows.</h2>";
	
	// Create the database here  *************************************************************************************************************************************************************************
	  // Drops existing table if the script is re-run
	$delete_query = "DROP TABLE `$dbName`.`$tableName` ";
	mysqli_query($linkDBTest, $delete_query);

	$createDBQuery = "CREATE DATABASE `$dbName` ;";
	mysqli_query($linkDBTest, $createDBQuery);
	echo "Successfully created database <b>$dbName</b><br />";
	// Create the test table
	$createTableQuery = "CREATE TABLE `$dbName`.`$tableName` (`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,`testcolumn` VARCHAR( 255 ) NOT NULL) ENGINE = $tableType ";
	mysqli_query($linkDBTest, $createTableQuery);
	echo "Sucessfully created table <b>$tableName</b><br /><br />";	
	
	
	// CHECK for InnoDB support  *************************************************************************************************************************************************************************
	$checkInnoDBQuery = "SHOW TABLE STATUS FROM $dbName WHERE Name = '$tableName' "; // SHOW TABLE STATUS FROM speedtestdb WHERE Name = 'speedtesttable'
	mysqli_query($linkDBTest, $checkInnoDBQuery);

		if ($resultTableCheck = mysqli_query($linkDBTest, $checkInnoDBQuery)) {
			while( $rowInnoDB = mysqli_fetch_assoc($resultTableCheck) ){
				//echo $rowGeographyCountyCoords['latitude'] , "LAT-- ROOT --LONG", $rowGeographyCountyCoords['longitude'] , "<hr>";
				$tableTypeVerified = $rowInnoDB['Engine'];
				//echo "$currentID <br>";
			}

			/* Close the result set and free the memory used for it  */
			mysqli_free_result($resultTableCheck);
		}
		
	// VERIFY the support for selected table type	
	$tableType = strtoupper($tableType);
	$tableTypeVerified = strtoupper($tableTypeVerified);
	
	if ($tableType != $tableTypeVerified)
		{ echo "<font color=\"red\"><strong>This MySQL instance does NOT support $tableType tables</strong></font><br />"; }
		
	echo "Table Type Verified:  $tableTypeVerified .. <br><br><br>";	
	

	
// INSERT Testing *******************************************************************************************************
	
	//Timer Start
	$starttime = microtime();
	$startarray = explode(" ", $starttime);
	$starttime = $startarray[1] + $startarray[0];	

	// Insert Rows
	$insertQuery = "INSERT INTO `$dbName`.`$tableName` (`id` ,`testcolumn`)VALUES (NULL , 'teststuff')";
	for ($i = 0 ; $i < $totalIters ; $i++ )
		{
		mysqli_query($linkDBTest, $insertQuery);
		// echo "$i Insert<br>";
		}

		// Get run time for display
	$endtime = microtime();
	$endarray = explode(" ", $endtime);
	$endtime = $endarray[1] + $endarray[0];
	$totaltime = $endtime - $starttime;
	$totaltime = round($totaltime,5);
	
	$IPS = round($totalIters/$totaltime);
	echo "Done.  $totalIters inserts in $totaltime seconds or <h2><strong><font color=\"green\">$IPS</font></strong> inserts per second.</h2>  ";
	

	
	// SELECT Testing *******************************************************************************************************
		
	//Timer Start
	$starttime = microtime();
	$startarray = explode(" ", $starttime);
	$starttime = $startarray[1] + $startarray[0];		
	
	$selectQuery = "SELECT * from `$dbName`.`$tableName`"; // where...
		if ($resultSelect = mysqli_query($linkDBTest, $selectQuery)) {
			while( $rowSelect = mysqli_fetch_assoc($resultSelect) ){
				//echo $rowGeographyCountyCoords['latitude'] , "LAT-- ROOT --LONG", $rowGeographyCountyCoords['longitude'] , "<hr>";
				$currentID = $rowSelect['id'];
				$currentTestColumn = $rowSelect['testcolumn'];
				$selectCounter ++;
				//echo "$currentID <br>";
			}
			
			/* Close the result set and free the memory used for it  */
			mysqli_free_result($resultSelect);
			}


	// Get run time for display
	$endtime = microtime();
	$endarray = explode(" ", $endtime);
	$endtime = $endarray[1] + $endarray[0];
	$totaltime = $endtime - $starttime;
	$totaltime = round($totaltime,5);

	$IPS = round($totalIters/$totaltime);
	echo "Done.  $totalIters row reads in $totaltime seconds or <h2><font color=\"blue\">$IPS</font> row reads per second.</h2>  ";

// UPDATE Testing *******************************************************************************************************
	
	//Timer Start
	$starttime = microtime();
	$startarray = explode(" ", $starttime);
	$starttime = $startarray[1] + $startarray[0];	

	// Update Rows
	$updateQuery = "UPDATE `$dbName`.`$tableName` SET testcolumn = 'updated stuff' WHERE ID > 0";
	mysqli_query($linkDBTest, $updateQuery);

	// Get run time for display
	$endtime = microtime();
	$endarray = explode(" ", $endtime);
	$endtime = $endarray[1] + $endarray[0];
	$totaltime = $endtime - $starttime;
	$totaltime = round($totaltime,5);
	
	$IPS = round($totalIters/$totaltime);
	echo "Done.  $totalIters updates in $totaltime seconds or <h2><strong><font color=\"orange\">$IPS</font></strong> updates per second.</h2>  ";


	// Delete existing rows
	// mysqli_query($linkDBTest, $delete_query);
	

	
?>	
