<html>
<?php
function __autoload ($class_name) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/'.$class_name.'.php';
}
$vars = new sqlvariable();
$sql = new MySQLConnection($vars->sqlservername,$vars->sqluser, $vars->sqlpass, $vars->sqldbname);
function mysql_users () {
    // автоматическое создание таблицы пользователей в базе
 if (mysql_query("SELECT * FROM users LIMIT 1")) { echo 'Таблица <b>users</b> уже есть в базе!<br>'; }
 else {
    mysql_query('CREATE TABLE IF NOT EXISTS users ('
            . 'userid INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL'
            . ', user_login VARCHAR(30) NOT NULL'
            . ', user_password TINYTEXT NOT NULL'
            . ', user_ip TEXT(12)'
            . ', user_hash VARCHAR(32)'
            . ', user_email TINYTEXT'
            . ', user_cat TINYTEXT'
            . ', user_phone1 TINYTEXT'
            . ', user_address TEXT'
            . ', user_inn TINYINT'
            . ', user_ogrn TINYINT'
            . ', datereg TIMESTAMP'
            . ', datechange TIMESTAMP'
            . ', reserv1 TEXT'
            . ', reserv2 TEXT'
            . ', reserv3 INT'
            . ', reserv4 INT)')
    or die ("SQL Error: ".  mysql_error()); 
    echo 'Таблица <b>users</b> успешно создана!<br>';
 }
}

function mysql_trackers () {
    // автоматическое создание таблицы трекеров в базе
 if (mysql_query("SELECT * FROM trackers LIMIT 1")) { echo 'Таблица <b>trackers</b> уже есть в базе!<br>'; }
else {
    mysql_query('CREATE TABLE IF NOT EXISTS trackers ('
            . 'treckerid INT AUTO_INCREMENT PRIMARY KEY NOT NULL'
            . ', userid INT NOT NULL'
            . ', imei TINYTEXT'
            . ', name TINYTEXT'
            . ', mark TINYTEXT'
            . ', model TINYTEXT'
            . ', datereg TIMESTAMP'
            . ', reserv1 TEXT'
            . ', reserv2 TEXT'
            . ', reserv3 INT'
            . ', reserv4 INT)')
    or die ("SQL Error: ".  mysql_error()); 
    echo 'Таблица <b>trackers</b> успешно создана!<br>';
    }
}

function mysql_userpermits () {
    // автоматическое создание таблицы прав пользователей в базе
 if (mysql_query("SELECT * FROM userpermits LIMIT 1")) { echo 'Таблица <b>userpermits</b> уже есть в базе!<br>'; }
else {
    mysql_query('CREATE TABLE IF NOT EXISTS userpermits ('
            . 'permitid INT AUTO_INCREMENT PRIMARY KEY NOT NULL'
            . ', permitvalue INT(5)'
            . ', permitdescription TEXT(30))')
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

function mysql_feedback (){
    // автоматическое создание таблицы отзывов в базе
    if (mysql_query("SELECT * FROM feedback LIMIT 1")) { echo 'Таблица <b>feedback</b> уже есть в базе!<br>'; }
    else {
        mysql_query('CREATE TABLE IF NOT EXISTS feedback ('
                . 'feedbackid INT AUTO_INCREMENT PRIMARY KEY NOT NULL'
                . ', fid_userid INT'
                . ', fid_fio TEXT(50)'
                . ', fid_phone TEXT (15)'
                . ', fid_email TINYTEXT'
                . ', fid_text_message TEXT'
                . ', fid_browser TEXT'
                . ', fid_user_ip TEXT(12)'
                . ', fid_date TIMESTAMP NOT NULL'
                . ', fid_info TEXT)')
                or die ("SQL Error: ".  mysql_error());
    echo 'Таблица <b>feedback</b> успешно создана!<br>';
    }
    
}

function mysql_points () {
    // автоматическое создание таблицы трекеров в базе
 if (mysql_query("SELECT * FROM points LIMIT 1")) { echo 'Таблица <b>points</b> уже есть в базе!<br>'; }
else {
    mysql_query('CREATE TABLE IF NOT EXISTS points ('
            . 'ptid INT AUTO_INCREMENT PRIMARY KEY NOT NULL'
            . ', imei INT(20) NOT NULL'
            . ', device_id INT(20) NOT NULL'
            . ', timestamp_utc TIMESTAMP NOT NULL'
            . ', latitude DECIMAL(15,13) NOT NULL'
            . ', longitude DECIMAL(15,13) NOT NULL'
            . ', satellites INT(2)'
            . ', speed INT (3)'
            . ', angle INT(3)'
            . ', gps_state TEXT(5)'
            . ', mcc TEXT(4)'
            . ', mnc TEXT(4)'
            . ', lac TEXT(5)'
            . ', cellid TEXT(8)'
            . ', state_acc TEXT(11)'
            . ', state_power TEXT(11)'
            . ', state_gps TEXT(11)'
            . ', state_oil TEXT(11)'
            . ', vin INT(5)'
            . ', gsm INT(3))')
            or die ("SQL Error: ".  mysql_error()); 
    echo 'Таблица <b>points</b> успешно создана!<br>';
    }
}
function mysql_articles () {
    // автоматическое создание таблицы трекеров в базе
 if (mysql_query("SELECT * FROM articles LIMIT 1")) { echo 'Таблица <b>articles</b> уже есть в базе!<br>'; }
else {
    mysql_query('CREATE TABLE IF NOT EXISTS articles ('
            . 'arid INT AUTO_INCREMENT PRIMARY KEY NOT NULL'
            . ', artshortname TINYTEXT NOT NULL'
            . ', artlongname TINYTEXT NOT NULL'
            . ', artmetatitle TINYTEXT'
            . ', artkeywords TINYTEXT'
            . ', artannotation TEXT'
            . ', artcontent MEDIUMTEXT'
            . ', artsystemdate TIMESTAMP NOT NULL'
            . ', artuserdate TIMESTAMP NOT NULL'
            . ', artlastdate TIMESTAMP NOT NULL'
            . ', artlink VARCHAR(255)'
            . ', artparent VARCHAR(255)'
            . ', artshow INT(1) NOT NULL'
            . ', artaccess INT(2) NOT NULL'
            . ', artsort SMALLINT)')
            or die ("SQL Error: ".  mysql_error()); 
    echo 'Таблица <b>articles</b> успешно создана!<br>';
    }
}

mysql_users ();
mysql_userpermits ();
mysql_trackers ();
mysql_feedback ();
mysql_points ();
mysql_articles ();

?>
<a href="index.php">Перейти на главную</a>
</html>
