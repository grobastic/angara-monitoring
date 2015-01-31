<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
   function my_sql_connection($server, $user, $pass, $dbname) {
    // Подключаемся к базе
   mysql_connect($server, $user, $pass)
    or die ("Не удается подключиться к серверу: ".  mysql_error());
   mysql_select_db($dbname)
    or die ("Не удается подключиться к базе: ".  mysql_error());
   }
   
   $server = "37.112.123.141";
   $user = "angara";
   $pass= "Cthutq62924";
   $dbname = "points";
   
  my_sql_connection($server, $user, $pass, $dbname); // Подключаемся к базе данных

   $tablename = "points";
   $scriptname = $_SERVER['SCRIPT_NAME'];
   $request = $_REQUEST['NewUser'];
   
   $i= mysql_query("SELECT Latitude, Longitude FROM $tablename ORDER BY id");
  while ($row = mysql_fetch_assoc($i)) {$Latitude = json_encode($row["Latitude"]).",";
    $Longitude = json_encode($row["Longitude"]);
    echo "[".$Latitude." ".$Longitude."], ";
  }
       echo date("H:i:s"); 
        ?>
    </body>
</html>
