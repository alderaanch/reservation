<?php
error_reporting(0); //disable all warnings (warnings normaly occur with empty dbs) --> set to 1 if debugging.

$config = json_decode(file_get_contents("./config.json"), true);
$storage = json_decode(file_get_contents($config["databaseFile"]), true); //load database
//modify
$starttime = date('Y-m-d\TH:i',strtotime($_POST['starttime'])); //get start datetime
$endtime = date('Y-m-d\TH:i',strtotime($_POST['endtime'])); //get start datetime

$isAlreadyReserved = 0; //0 if reservation is okay, 1 if reservation has conflict with other reservation
$conflictSession = "";
foreach($storage["workstations"][$_POST["workstation"]] as $res){
	if($starttime<=$res["starttime"] && $endtime>=$res["starttime"] // new period overlaps starttime
	|| $starttime<=$res["endtime"] && $endtime>=$res["endtime"] //new period overlaps endtime
	|| $starttime<=$res["starttime"] && $endtime>=$res["endtime"] // new period overlaps whole old period
	|| $starttime>=$res["starttime"] && $endtime<=$res["endtime"]){ //new period inside old period
		$isAlreadyReserved = 1;
		$conflictSession = "Arbeitsstation " . $_POST["workstation"] . " <b>Von</b>: " . date("d.m.Y\ | H:i", strtotime($res["starttime"])) . 
							" <b>Bis:</b> " . date("d.m.Y\ | H:i", strtotime($res["endtime"])) . "<br>";
	}	
}
if($isAlreadyReserved){ //error msg if conflict
	$msg = "Buchungs Konflikt! Überprüfen Sie die Einträge Ihrer Arbeitsstation.<br>Konflikt mit Sitzung: " . $conflictSession ; //error msg
}else{ //modify db and success msg if no conflict
	$msg = "Ihre Buchung wurde entgegen genommen.<br> Arbeitsstation " . $_POST["workstation"] . " <b>Von</b>: " . date("d.m.Y\ | H:i", strtotime($starttime)) . " <b>Bis:</b> " . date("d.m.Y\ | H:i", strtotime($endtime)); //success msg
	
	$resAmount = count($storage["workstations"][$_POST['workstation']]); //get amount of reservations

	$storage["workstations"][$_POST['workstation']][$resAmount]["username"] = $_POST['name']; //set name
	$storage["workstations"][$_POST['workstation']][$resAmount]["userteam"] = $_POST['team']; //set team
	$storage["workstations"][$_POST['workstation']][$resAmount]["starttime"] = $_POST['starttime']; //set start time
	$storage["workstations"][$_POST['workstation']][$resAmount]["endtime"] = $_POST['endtime']; //set end time
	file_put_contents($config["databaseFile"], json_encode($storage)); //write to database
}

//forwarding back to page
header( "refresh:" . $config["confirmScreenTime"] . ";url=./booking.php"); //forward back to page in x-seconds

//message
echo $msg;
?>