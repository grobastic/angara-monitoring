<?php 
function __autoload ($class_name) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/'.$class_name.'.php';
}
$PageSpeed = new PageSpeed();

// Запускаем сессию
session_name("Auth");
session_start();

$vars = new sqlvariable();
$sql = new MySQLConnection($vars->sqlservername,$vars->sqluser, $vars->sqlpass, $vars->sqldbname);

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="ru">
    <head>
        <meta charset="utf-8">   
        <meta http-equiv="content-language" content="ru">
    </head>
    <body>
<?php


$tablename = "users";
// Если сессия не запущена
if (!isset($_SESSION['Auth'])) {
// Показываем форму регистрации
?>
        <table><tr>
                <td>
            <form action="http://<?=$_SERVER['SERVER_NAME']?>/operations/registration.php">
            Логин: <input type="text" name="login" value=""><br>
            Пароль: <input type="password" name="pass" value=""><br>
            Ф.И.О.:  <input type="text" name="username" value=""><br>
            <input type="submit" name="NewUser" value="Регистрация">
            <input type="button" onclick="location.href='http://<?=$_SERVER['SERVER_NAME']?>/login.php'" value="Авторизация">
        </form></td>
                <td><?php include_once 'login.php'; ?></td></table>
       
<?php
}
// Если сессия запущена
if (isset($_SESSION['Auth'])) { 
    $usersessionid = $_SESSION['Auth']['sessionid'];
    $usersql = mysql_query("SELECT * FROM $tablename WHERE user_hash='$usersessionid' ORDER BY userid LIMIT 1");
    $num2 = mysql_num_rows($usersql);
    while ($data=mysql_fetch_assoc($usersql)){echo "Вы авторизованы как <a href = 'http://".$_SERVER['SERVER_NAME']."/users/".$data['userid']."'>" .$data['user_login']."</a>";} echo "<br>"; echo "<a href='http://".$_SERVER['SERVER_NAME']."/logout.php'>Выйти</a>";
}
// Если сессия запущена и пользователь Админ
if ($_SESSION['Auth']['user_cat'] == 9) {
    $resultusers =  mysql_query("SELECT * FROM $tablename ORDER BY userid");
    $num = mysql_num_rows($resultusers);
    
    echo "<br>Строк в таблице: ".  $num;
    echo "<br>";
?>
    <table style="border:2px solid black">
        <tr>
            <td>№</td>
            <td>Идентификатор</td>
            <td>Логин</td>
            <td>Пароль</td>
            <td>E-mail</td>
            <td>Категория пользователя</td>
            <td>Дата регистрации</td>
            <td></td>
        </tr>
<?php 
// Запрос в таблицу со списком прав

// Показываем таблицу зарегистрированных пользователей
while ($data=mysql_fetch_assoc($resultusers) AND $i<=$num){ $i++; $usercat = $data["user_cat"]; 
    $permits = mysql_query("SELECT permitdescription FROM userpermits WHERE permitvalue='$usercat'") or die('');?>
        <form action="deleteuser.php">    
            <tr>
                <td><?=$i?></td>
                <td><a href="/users/<?=$data["userid"]?>"><?=$data["userid"]?></a></td>
                <td><input type="text" value="<?=$data["user_login"]?>"></td>
                <td><input type="password" value="<?=$data["user_password"]?>"></td>
                <td><input type="text" value="<?=$data["user_email"]?>"></td>
            <?php while ($permitsdata = mysql_fetch_assoc($permits)) {?>
                <td><input type="text" value="<?=$permitsdata["permitdescription"]?>"></td> 
            <?php } ?>
                <td><?=$data["datereg"]?></td>
                <td><button type="submit" name="DeleteByUserId" value="<?=$data["userid"]?>">X</button></form></td>
            </tr>
<?php  } } 

$stop = microtime(true);

$time = $stop - $start;


?>
</table>
        <p><a href="points.php">Посмотреть данные с трекера</a></p>
        <p><a href="/leo/zapros.php">Карта</a></p>
</body></html>

