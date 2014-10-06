<html>
<?php
require_once 'lib/sqlvariable.php';
require_once 'lib/sql.php';
function new_table_users () {
    // автоматическое создание таблицы пользователей в базе
 if (mysql_query("SELECT * FROM users LIMIT 1")) { echo 'Таблица <b>users</b> уже есть в базе!<br>'; }
 else {
    mysql_query('CREATE TABLE IF NOT EXISTS users (userid INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL, user_login VARCHAR(30) NOT NULL, user_password TINYTEXT NOT NULL, user_ip INT(10), user_hash VARCHAR(32), user_email TINYTEXT, user_cat TINYTEXT, user_phone1 TINYTEXT, user_address TEXT, user_inn TINYINT, user_ogrn TINYINT, datereg TIMESTAMP, datechange TIMESTAMP, reserv1 TEXT, reserv2 TEXT, reserv3 INT, reserv4 INT)')
    or die ("SQL Error: ".  mysql_error()); 
    echo 'Таблица <b>users</b> успешно создана!<br>';
 }
}

function new_table_trackers () {
    // автоматическое создание таблицы трекеров в базе
 if (mysql_query("SELECT * FROM trackers LIMIT 1")) { echo 'Таблица <b>trackers</b> уже есть в базе!<br>'; }
else {
    mysql_query('CREATE TABLE IF NOT EXISTS trackers (treckerid INT AUTO_INCREMENT PRIMARY KEY NOT NULL, userid INT NOT NULL, imei TINYTEXT, name TINYTEXT, mark TINYTEXT, model TINYTEXT, datereg TIMESTAMP, reserv1 TEXT, reserv2 TEXT, reserv3 INT, reserv4 INT)')
    or die ("SQL Error: ".  mysql_error()); 
    echo 'Таблица <b>trackers</b> успешно создана!<br>';
    }
}

function userpermits () {
    // автоматическое создание таблицы прав пользователей в базе
 if (mysql_query("SELECT * FROM userpermits LIMIT 1")) { echo 'Таблица <b>userpermits</b> уже есть в базе!<br>'; }
else {
    mysql_query('CREATE TABLE IF NOT EXISTS userpermits (permitid INT AUTO_INCREMENT PRIMARY KEY NOT NULL, permitvalue INT(5), permitdescription TEXT(30))')
    or die ("SQL Error: ".  mysql_error());
    echo 'Таблица <b>userpermits</b> успешно создана!<br>';
    mysql_query("INSERT INTO userpermits SET permitvalue='1', permitdescription='Гости'") or die ("SQL Error: ".  mysql_error());
    mysql_query("INSERT INTO userpermits SET permitvalue='2', permitdescription='Зарегистрированные'") or die ("SQL Error: ".  mysql_error());
    mysql_query("INSERT INTO userpermits SET permitvalue='3', permitdescription='Клиенты'") or die ("SQL Error: ".  mysql_error());
    mysql_query("INSERT INTO userpermits SET permitvalue='4', permitdescription='Организации'") or die ("SQL Error: ".  mysql_error());
    mysql_query("INSERT INTO userpermits SET permitvalue='5', permitdescription='Филиалы'") or die ("SQL Error: ".  mysql_error());
    mysql_query("INSERT INTO userpermits SET permitvalue='6', permitdescription='Операторы'") or die ("SQL Error: ".  mysql_error());
    mysql_query("INSERT INTO userpermits SET permitvalue='7', permitdescription='Контент-менеджер'") or die ("SQL Error: ".  mysql_error());
    mysql_query("INSERT INTO userpermits SET permitvalue='8', permitdescription='Редакторы'") or die ("SQL Error: ".  mysql_error());
    mysql_query("INSERT INTO userpermits SET permitvalue='9', permitdescription='Администратор'") or die ("SQL Error: ".  mysql_error());
    }
}

function articles () {
    // автоматическое создание таблицы статей в базе
if (mysql_query("SELECT * FROM articles LIMIT 1")) { echo 'Таблица <b>articles</b> уже есть в базе!<br>'; }
else {
    mysql_query('CREATE TABLE IF NOT EXISTS articles (articleid INT AUTO_INCREMENT PRIMARY KEY NOT NULL, articleuri TEXT(30), articletitle TEXT, articlekeywords TEXT, articleaccess INT(2) NOT NULL, articleshow INT(1), articleparent TEXT(40), articleredirect TEXT, articledate TIMESTAMP NOT NULL, articledateofchange TIMESTAMP NOT NULL, articlenameshort TEXT(30) NOT NULL, articlenamelong TEXT (100) NOT NULL, articleannotation TEXT, articlecontent TEXT)')
    or die ("SQL Error: ".  mysql_error());
    echo 'Таблица <b>articles</b> успешно создана!<br>';
    }
}

new_table_users ();
userpermits ();
new_table_trackers ();
articles ();

?>
<a href="index.php">Перейти на главную</a>
</html>
