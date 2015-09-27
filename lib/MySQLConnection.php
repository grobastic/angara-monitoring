<?php
class MySQLConnection {
    function __construct($server, $user, $pass, $dbname) {
        // Подключаемся к базе
        $this->sql = mysql_connect($server, $user, $pass) or die ("Не удается подключиться к серверу: ".  mysql_error());
        mysql_select_db($dbname,$this->sql) or die ("Не удается подключиться к базе: ".  mysql_error()); 
    }
}