<?php
// Запускаем  сессию
session_name("Auth");
session_start();
// Если сессия не запущена, то отрпавляем на главную
if (!isset($_SESSION['Auth']))     
    {
    header('Location:../../index.php');
    exit;
    }  
require_once 'lib/sqlvariable.php';
require_once 'lib/sql.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
<?php

$table_users = "users";
$table_trackers = "trackers";

$pattern = '/(\d+)/s';
// Получаем URL страницы
$URL = $_SERVER["REQUEST_URI"];
    
// Разбираем URL и получаем userid
preg_match($pattern, htmlspecialchars($URL), $UserIdFromUrl) or die ("<br>Doesn't work");
    
// Ищем userid в базе
$result =  mysql_query("SELECT * FROM $table_users WHERE userid=$UserIdFromUrl[1] LIMIT 1") or die ("<br>Doesn't work");
    
// Если userid пользоавтеля из сессии и страницы совпадают или это админ, то даём доступ
if ($_SESSION['Auth']['userid'] === $UserIdFromUrl[1] || $_SESSION['Auth']['user_cat'] == 9){
?>
        <h1>Это пользователь <?=$UserIdFromUrl[1]?></h1>
            
<?php 

while ($data=mysql_fetch_assoc($result)){?>
    <form action="<?=$scriptname?>">    
        <table style="border:2px solid black">
            <tr><td>Идентификатор</td><td><?=$data["userid"]?></td></tr>  
            <tr><td>Логин</td><td><input type="text" value="<?=$data["user_login"]?>"></td></tr>
            <tr><td>Пароль</td><td><input type="password" value="<?=$data["user_password"]?>"></td></tr>
            <tr><td>E-mail</td><td><input type="text" value="<?=$data["user_email"]?>"></td></tr>
            <tr><td>Категория пользователя</td><td><input type="text" value="<?php if ($data["user_cat"]== 'registred'){echo 'Зарегистрированный'; } ?>"></td></tr>
            <tr><td>Дата регистрации</td><td><?=$data["datereg"]?></td></tr>
        </table>
    </form>
            
<?php } 
$scriptname = $_SERVER['SCRIPT_NAME'];
$request = $_REQUEST['AddNewTracker'];

// Делаем запрос в таблицу с трекерами
$resulttrackers =  mysql_query("SELECT * FROM $table_trackers WHERE userid='$UserIdFromUrl[1]' ORDER BY treckerid");
$num = mysql_num_rows($resulttrackers);
if ($num>0){
?>
        <p>&nbsp;</p>
        <h3>Зарегистрированные трекеры</h3>
        <table style="width: 100%; margin: 10px; border: 2px solid black;">
        <tr>
            <td>ID</td>
            <td>Имя</td>
            <td>Марка</td>
            <td>IMEI</td>
        </tr>
        
<?php 

while ($data=mysql_fetch_assoc($resulttrackers)){?>
        <tr>
            <td><?=$data["treckerid"]?></a></td>
            <td><?=$data["name"]?></td>
            <td><?=$data["mark"]?></td>
            <td><?=$data["imei"]?></td>
        </tr>
<?php } ?>
        </table>
<?php }

else {echo "<br><b>Зарегистрированных трекеров нет</b><br>";}
if (!isset($request)) {?>    
<form action="http://<?=$_SERVER['SERVER_NAME']?>/operations/addtracker.php">
    <table>
        <input type="text" name="userid" value="<?=$UserIdFromUrl[1]?>" hidden>
        <tr><td>Название трекера:</td><td><input type="text" name="trackername" value=""></td></tr>
        <tr><td>Марка трекера:</td><td><input type="text" name="trackermark" value=""></td></tr>
        <tr><td>IMEI:</td><td><input type="text" name="trackerimei" value=""></td></tr>
        <tr><td><input type="submit" name="AddNewTracker" value="Добавить трекер"></td></tr>
    </table>
        </form>
<?php }
else { 
    if (isset($request)) { 
        $trackername = $_REQUEST['trackername'];
        $trackermark = $_REQUEST['trackermark'];
        $trackerimei = $_REQUEST['trackerimei'];
        echo $trackername."<br>".$trackermark."<br>".$trackerimei."<br>";
        mysql_query("INSERT INTO $table_trackers SET userid='$UserIdFromUrl[1]', name='$trackername', mark='$trackermark', imei='$trackerimei'") or die ("SQL Error: ".  mysql_error());
        }
}
}
else { echo "Вероятно, это не ваша страница.";}
?>
    </body>
</html>
