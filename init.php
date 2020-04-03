<?php 
$config = json_decode(file_get_contents("./config.json"),true);
$workstations = $config["workstations"];
$dblayout = "{\n\"workstations\":{";
for($i = 1; $i<=$workstations; $i++){
	$dblayout = $dblayout . "\n\"" . $i . "\":[],";
}
$dblayout = rtrim($dblayout, ",") . "\n}}";
file_put_contents($config["databaseFile"], $dblayout);
echo "Database cleaned and reinitialized."
?>