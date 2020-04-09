# Reservation  
Simple PHP based DB-Serverless reservation-system for workspaces.

## Files  
config.json:              Contains main configuration for things, that most likely change in the future.  
index.php:                Contains the HTML-Interface for the System. Calls "save.php" when form gets submitted.  
save.php:                 Checks for reservation-conflicts and stores data in "storage.json" as JSON-Format.  
storage.json:             Contains all reservation-data in JSON-Format.  
init.php:                 Clean and reinizialize database.  
display.php:              Reads data from "storage.json" and displays it as HTML.  

## Config  
workstations:             Amount of Workstations available.  
databaseFile:             Location of databaseFile.  
confirmScreenTime:        Amount of seconds, until user is redirected to booking page, after booking was submitted.  
allowTeams:				  Allow or Forbid Teams (false: Teams will not show up on booking or display, in datebase 'team'-entry will be 'null').  
teams:                    List of all teams available.  
jsNameCall:               JavaScript code to get Username automatically.  
allowNameChange:          Allow or Forbid User-Namechange.  