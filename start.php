<html>
<?php
require_once 'lib/sqlvariable.php';
require_once 'lib/sql.php';
function new_table_users () {
    // автоматическое создание таблицы в базе
 if (mysql_query("SELECT * FROM users LIMIT 1")) { echo 'Таблица <b>users</b> уже есть в базе!<br>'; }
 else {
    mysql_query('CREATE TABLE IF NOT EXISTS users (userid INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL, user_login VARCHAR(30) NOT NULL, user_password TINYTEXT NOT NULL, user_ip INT(10), user_hash VARCHAR(32), user_email TINYTEXT, user_cat TINYTEXT, user_phone1 TINYTEXT, user_address TEXT, user_inn TINYINT, user_ogrn TINYINT, datereg TIMESTAMP, datechange TIMESTAMP, reserv1 TEXT, reserv2 TEXT, reserv3 INT, reserv4 INT)')
    or die ("SQL Error: ".  mysql_error()); 
    echo 'Таблица <b>users</b> успешно создана!<br>';
 }
}

function new_table_trackers () {
    // автоматическое создание таблицы в базе
 if (mysql_query("SELECT * FROM trackers LIMIT 1")) { echo 'Таблица <b>trackers</b> уже есть в базе!<br>'; }
    else {
    mysql_query('CREATE TABLE IF NOT EXISTS trackers (treckerid INT AUTO_INCREMENT PRIMARY KEY NOT NULL, userid INT NOT NULL, imei TINYTEXT, name TINYTEXT, mark TINYTEXT, model TINYTEXT, datereg TIMESTAMP, reserv1 TEXT, reserv2 TEXT, reserv3 INT, reserv4 INT)')
    or die ("SQL Error: ".  mysql_error()); 
    echo 'Таблица <b>trackers</b> успешно создана!<br>';
    }
}

new_table_users ();
new_table_trackers ();

?>
<a href="index.php">Перейти на главную</a>
</html>
