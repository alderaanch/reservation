<?php
error_reporting(0); //disable all warnings (warnings normaly occur with empty dbs) --> set to 1 if debugging.

$storageFilePath = "./storage.json"; //Path to JSON DB file
$storage = json_decode(file_get_contents($storageFilePath), true); //load database

//modify
$starttime = date('Y-m-d\TH:i',strtotime($_POST['starttime'])); //get start datetime
$endtime = date('Y-m-d\TH:i',strtotime($_POST['endtime'])); //get start datetime

$isAlreadyReserved = 0; //0 if reservation is okay, 1 if reservation has conflict with other reservation
foreach($storage["workstations"][$_POST["workstation"]] as $res){
	if($starttime<=$res["starttime"] && $endtime>=$res["starttime"] // new period overlaps starttime
	|| $starttime<=$res["endtime"] && $endtime>=$res["endtime"] //new period overlaps endtime
	|| $starttime<=$res["starttime"] && $endtime>=$res["endtime"] // new period overlaps whole old period
	|| $starttime>=$res["starttime"] && $endtime<=$res["endtime"]){ //new period inside old period
		$isAlreadyReserved = 1;
	}	
}
if($isAlreadyReserved){
	$msg = "Buchungs Konflikt! Überprüfen Sie die Einträge Ihrer Arbeitsstation"; //error msg
}else{
	$msg = "Ihre Buchung wurde entgegen genommen."; //success msg
	
	$resAmount = count($storage["workstations"][$_POST['workstation']]); //get amount of reservations

	$storage["workstations"][$_POST['workstation']][$resAmount]["username"] = $_POST['name']; //set name
	$storage["workstations"][$_POST['workstation']][$resAmount]["userteam"] = $_POST['team']; //set team
	$storage["workstations"][$_POST['workstation']][$resAmount]["starttime"] = $_POST['starttime']; //set start time
	$storage["workstations"][$_POST['workstation']][$resAmount]["endtime"] = $_POST['endtime']; //set end time
	file_put_contents($storageFilePath, json_encode($storage)); //write to database
}

//forwarding back to page
//header( "refresh:5;url=./index.php");

//message
echo $msg;
?>