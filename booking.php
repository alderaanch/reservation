<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<style type="text/css">
		html{
			font-family: Calibri;
		}
	</style>
	<script type="text/javascript">
		window.onload = function(){
<?php 		
			$jsNameCall = json_decode(file_get_contents("./config.json"), true)["jsNameCall"]; //get jsnamecall from config
			echo "document.getElementById(\"name\").value = " . $jsNameCall; //set name to jsnamecall

			if(!json_decode(file_get_contents("./config.json"), true)["allowNameChange"]){ //check if user is allowed to change name
				echo "document.getElementById(\"name\").setAttribute(\"readonly\", \"true\");";
			}
?>
			change(); //check all info at beginning
		}
		var change = function(){
			//get values
			name = document.getElementById("name").value;
			starttime = new Date(document.getElementById("startdate").value + "T" + document.getElementById("starttime").value);
			endtime = new Date(document.getElementById("enddate").value + "T" + document.getElementById("endtime").value);
			if(document.getElementById("team")){
				team = document.getElementById("team").value;
			}else{
				team = "noteam";
			}
			workstation = document.getElementById("workstation").value;
			submit = document.getElementById("submit");
			//check filled in info
			if(name != "" //if name is not blank
				&& team != ""
				&& workstation != "" //and workstation is not blank
				&& starttime != "Invalid Date" //and start-date is not blank
				&& endtime != "Invalid Date" //and end-date is not blank
				&& starttime < endtime){ //and start time is smaller than endtime
				submit.disabled = false; //allow submit button
				document.getElementById("errorlabel").innerHTML = ""; //remove error msg
			}
			else{ //something or everything is not filled in
				document.getElementById("errorlabel").innerHTML = "Ungültige oder unvollständige Einträge. Überprüfen Sie Ihre Angaben."; //print error message
				submit.disabled = true;
			}
		}
	</script>
</head>
<body onchange="change()">
	<form action="save.php" method="post">
		<label for="name">Name:</label><br>
		<input id ="name" type="text" name="name" placeholder="Vorname Nachname"><br><br>
<?php
			if(json_decode(file_get_contents("./config.json"), true)["showTeams"]){
				echo "<label for=\"team\">Team:</label><br>
					 <select id=\"team\" name=\"team\"><br>
					 <option value=\"\" disabled selected>Wählen:</option>";
				$teams = json_decode(file_get_contents("./config.json"), true)["teams"]; //read teams from config
				foreach($teams as $team){ //for each team
					echo "<option value=\"$team\">$team</option>\n"; //print team-selector
				}
				echo "</select><br><br>";
			}

?>
		<label for="workstation">Arbeitsplatz:</label><br>
		<select id="workstation" name="workstation">
			<option value="" disabled selected>Wählen:</option>
<?php
			$workstations = json_decode(file_get_contents("./config.json"),true)["workstations"]; //read workstation amount from config
			for ($i = 1; $i<= $workstations;$i++){ //wor each workstation
				echo("<option value=\"$i\">$i</option>\n"); //print workstation-selector
			}
?>
		</select><br><br>
		<label for="starttime">Start:</label><br>
		<input id="startdate" type="date"  name="startdate">
		<select id="starttime" type="time"  name="starttime">
			<option value="nodate" disabled selected>SS:MM</option>
			<option value="06:00">06:00</option>
			<option value="12:00">12:00</option>
			<option value="18:00">18:00</option>
		</select><br><br>
		<label for"endtime>Ende:</label><br>
		<input id="enddate" type="date" name="enddate">		
		<select id="endtime" type="time"  name="endtime">
			<option value="nodate" disabled selected>SS:MM</option>
			<option value="12:00">12:00</option>
			<option value="18:00">18:00</option>
		</select><br><br>
		<label id="errorlabel" for="submit">Ungültige oder unvollständige Einträge. Überprüfen Sie Ihre Angaben.</label><br>
		<input id="submit" name="submit" type="submit"><br>
	</form>
</body>
</html>