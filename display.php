<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		html{
			font-family: Calibri;
		}
	</style>
</head>
<body>
<?php
error_reporting(0); //disable all warnings (warnings normaly occur with empty dbs) --> set to 1 if debugging.
$storageFilePath = "./storage.json"; //db file path
$storage = json_decode(file_get_contents($storageFilePath), true); //load database

foreach($storage["workstations"] as $key => $value){ //for each workstation (key=workstation number, value = content of workstation)
	echo "<br><br><b>Arbeitsplatz " . $key . "</b><br><br>"; //printout workstation name as title
	foreach($value as $entry){ //for each reservation
		echo 	"<b>Von</b>: " . date("d.m.Y\ | H:i", strtotime($entry["starttime"])) . //print out starting time
				" <b>Bis:</b> " . date("d.m.Y\ | H:i", strtotime($entry["endtime"])) . "<br>"; //print out end time
	}
}

?>
</body>
</html>
