<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		html{
			font-family: Calibri;
		}
	</style>
	<script type="text/javascript">
		window.onload = function(){
			document.getElementById("submit").disabled = true;
			change();
		}
		var change = function(){
			name = document.getElementById("name").value;
			starttime = new Date(document.getElementById("starttime").value);
			endtime = new Date(document.getElementById("endtime").value);
			team = document.getElementById("team").value;
			workstation = document.getElementById("workstation").value;
			submit = document.getElementById("submit");
			if(name != "" 
				&& team != "" 
				&& workstation != "" 
				&& starttime != "Invalid Date" 
				&& endtime != "Invalid Date"
				&& starttime < endtime){
				submit.disabled = false;
				document.getElementById("errorlabel").innerHTML = "";
			}
			else{
				document.getElementById("errorlabel").innerHTML = "Ungültige oder unvollständige Einträge. Überprüfen Sie Ihre Angaben.";
				submit.disabled = true;
			}
		}
	</script>
</head>
<body onchange="change()">
	<form action="save.php" method="post">
		<label for="name">Name:</label><br>
		<input id ="name" type="text" name="name" placeholder="Vorname Nachname"><br><br>
		<label for="team">Team:</label><br>
		<select id="team" name="team"><br>
			<option value="" disabled selected></option>
			<option value="DE">DE</option>
			<option value="IT">IT</option>
			<option value="FR">FR</option>
			<option value="EN">EN</option>
			<option value="Sales">Sales</option>
			<option value="Stab">Stab</option>
		</select><br><br>
		<label for="workstation">Arbeitsplatz:</label><br>
		<select id="workstation" name="workstation">
			<option value="" disabled selected></option>
<?php 
			for ($i = 1; $i<=36;$i++){
				echo("<option value=\"$i\">$i</option>");
			}
?>
		</select><br><br>
		<label for="starttime">Start:</label><br>
		<input id="starttime" type="datetime-local" name="starttime"><br><br>
		<label for"endtime>Ende:</label><br>
		<input id="endtime" type="datetime-local" name="endtime"><br><br>
		<label id="errorlabel" for="submit">Ungültige oder unvollständige Einträge. Überprüfen Sie Ihre Angaben.</label><br>
		<input id="submit" name="submit" type="submit"><br>
	</form>
</body>
</html>