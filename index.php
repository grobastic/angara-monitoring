<?php 
function __autoload ($class_name) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/'.$class_name.'.php';
}
$PageSpeed = new PageSpeed();
// Запускаем сессию
$sessionname = "Auth";
session_name($sessionname);
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="ru">
    <head>
        <meta charset="utf-8">   
        <meta http-equiv="content-language" content="ru">
        <link rel="stylesheet" href="http://<?=$_SERVER['SERVER_NAME']?>/css/styles.css">
    </head>
    <body>
<?php 
$permitslvl = $_SESSION[$sessionname]['user_cat'];
$tablename = "users";

$vars = new sqlvariable();
$sql = new MySQLConnection($vars->sqlservername,$vars->sqluser, $vars->sqlpass, $vars->sqldbname);
$MenuMine = new MenuMine('articles', $sessionname, $permitslvl, 1, 0);
$MenuMine->MenuQuery();
$MenuMine->MenuResult();
?>
<?php

// Если сессия не запущена
if (!isset($_SESSION[$sessionname])) : 
    // Показываем форму регистрации и авторизации
    ?>
<table>
    <tr><td><?php require_once $_SERVER['DOCUMENT_ROOT'].'/forms/registration.html';?></td><td style="vertical-align: top;"><?php require_once $_SERVER['DOCUMENT_ROOT'].'/components/login.php';?></td></tr>
</table>
<?php
 endif;
// Если сессия запущена
if (isset($_SESSION[$sessionname])) { 
    $usersessionid = $_SESSION[$sessionname]['sessionid'];
    $usersql = mysql_query("SELECT * FROM $tablename WHERE user_hash='$usersessionid' ORDER BY userid LIMIT 1");
    $num2 = mysql_num_rows($usersql);
    while ($data=mysql_fetch_assoc($usersql)){echo "Вы авторизованы как <a href = 'http://".$_SERVER['SERVER_NAME']."/users/".$data['userid']."'>" .$data['user_login']."</a>";} echo "<br>"; echo "<a href='http://".$_SERVER['SERVER_NAME']."/components/logout.php'>Выйти</a>";
}
// Если сессия запущена и пользователь Админ
if ($permitslvl == 9) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/forms/addarticle.html';
    $resultusers =  mysql_query("SELECT * FROM $tablename ORDER BY userid");
    $num = mysql_num_rows($resultusers);
    
    echo "<br>Строк в таблице: ".  $num;
    echo "<br>";
?>
    <table style="border:2px solid black">
        <tr>
            <td>№</td>
            <td>ID</td>
            <td>Логин</td>
            <td>Пароль</td>
            <td>E-mail</td>
            <td>Категория пользователя</td>
            <td>Дата регистрации</td>
            <td>IP</td>
            <td></td>
        </tr>
<?php 
// Запрос в таблицу со списком прав

// Показываем таблицу зарегистрированных пользователей
while ($data=mysql_fetch_assoc($resultusers) AND $i<=$num){ $i++; $usercat = $data["user_cat"]; 
    $permits = mysql_query("SELECT permitdescription FROM userpermits WHERE permitvalue='$usercat'") or die('Ничего не работает');?>
        <form action="deleteuser.php">    
            <tr>
                <td><?=$i?></td>
                <td><a href="/users/<?=$data["userid"]?>"><?=$data["userid"]?></a></td>
                <td><?=$data["user_login"]?></td>
                <td><?=$data["user_password"]?></td>
                <td><?=$data["user_email"]?></td>
            <?php while ($permitsdata = mysql_fetch_assoc($permits)) {?>
                <td><?=$permitsdata["permitdescriptio"]?></td> 
            <?php } ?>
                <td><?=$data["datereg"]?></td>
                <td><?=long2ip($data["user_ip"])?></td>
                <td><button type="submit" name="DeleteByUserId" value="<?=$data["userid"]?>">X</button></form></td>
            </tr>
<?php  } } 
?>
</table>
        <p><a href="points.php">Посмотреть данные с трекера</a></p>
        <p><a href="/leo/zapros.php">Карта</a></p>
<?php
$MenuAlter = new MenuMine('articles', $sessionname, $permitslvl, 1, 1);
$MenuAlter->MenuQuery();
$MenuAlter->MenuResult();
?>
    </body>
</html>

