<?php
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  
   function my_sql_connection($server, $user, $pass, $dbname) {
    // Подключаемся к базе
   mysql_connect($server, $user, $pass)
    or die ("Не удается подключиться к серверу: ".  mysql_error());
   mysql_select_db($dbname)
    or die ("Не удается подключиться к базе: ".  mysql_error());
   }
   
   //$server = "localhost";
   $server = "46.252.114.52";
   $user = "DataLoger";
   $pass= "Cthutq62924";
   $dbname = "points";
   $tablename = "gpsdata";
   
  my_sql_connection($server, $user, $pass, $dbname); // Подключаемся к базе данных

   
   
   $i= mysql_query("SELECT Latitude, Longitude FROM $tablename ORDER BY id") or die ("Не удается подключиться к базе: ".  mysql_error());
   
	$coordinates = array();
	while ($row = mysql_fetch_assoc($i)) {
		$currentCoordinates = array();
		$currentCoordinates[] = (float)$row["Latitude"];
		$currentCoordinates[] = (float)$row["Longitude"];
		
		$coordinates[] = $currentCoordinates;
		//$Latitude = json_encode($row["Latitude"]).",";
		//$Longitude = json_encode($row["Longitude"]);
		//$coordinates = "[".$Latitude." ".$Longitude."], ";
		
	}
	

echo json_encode($coordinates);
   
        
exit();