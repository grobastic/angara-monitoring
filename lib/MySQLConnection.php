<?php
class MySQLConnection {
    function __construct($server, $user, $pass, $dbname) {
        // Подключаемся к базе
        mysql_connect($server, $user, $pass) or die ("Не удается подключиться к серверу: ".  mysql_error());
        mysql_select_db($dbname) or die ("Не удается подключиться к базе: ".  mysql_error()); 
    }
}