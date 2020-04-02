# reservation
Simple PHP based DB-Serverless Reservation System for Workspaces.

Files:
index.php:                Contains the HTML-Interface for the System. Calls "save.php" when form gets submitted.  
save.php:                 Checks for reservation-conflicts and stores data in "storage.json" as JSON-Format.  
storage.json:             Contains all reservation-data in JSON-Format.  
storage - template.json:  Used as a Template, to re-initialize the database.  
display.php:              Reads data from "storage.json" and displays it as HTML.  
