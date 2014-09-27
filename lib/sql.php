<?php
function my_sql_connection($server, $user, $pass, $dbname) {
    // Подключаемся к базе
   mysql_connect($server, $user, $pass)
    or die ("Не удается подключиться к серверу: ".  mysql_error());
   mysql_select_db($dbname)
    or die ("Не удается подключиться к базе: ".  mysql_error()); 
}
// Подключаемся к базе данных                 
my_sql_connection($sqlservername, $sqluser, $sqlpass, $sqldbname);
?>

