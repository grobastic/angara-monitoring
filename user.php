<?php
function __autoload ($class_name) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/'.$class_name.'.php';
}

$PageSpeed = new PageSpeed();

// Запускаем  сессию
session_name("Auth");
session_start();

$vars = new sqlvariable();
$sql = new MySQLConnection($vars->sqlservername,$vars->sqluser, $vars->sqlpass, $vars->sqldbname);
// Если сессия не запущена, то отрпавляем на главную
if (!isset($_SESSION['Auth']))     
    {
    header('Location:../../index.php');
    exit;
    }  

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

while ($data=mysql_fetch_assoc($result)){
    $usercat = $data["user_cat"];
    $permits = mysql_query("SELECT * FROM userpermits WHERE permitvalue='$usercat'") or die('');
    $permitsall = mysql_query("SELECT * FROM userpermits") or die('');
$permitsnum = mysql_num_rows($permitsall);
$scriptname = $_SERVER['SCRIPT_NAME'];
    ?>
    <form action="<?=$scriptname?>">    
        <table style="border:2px solid black">
            <tr><td>Идентификатор:</td><td><?=$data["userid"]?></td></tr>  
            <tr><td>Логин:</td><td><input type="text" value="<?=$data["user_login"]?>"></td></tr>
            <tr><td>Пароль:</td><td><input type="password" value="<?=$data["user_password"]?>"></td></tr>
            <tr><td>Телефон:</td><td><input type="password" value="<?=$data["user_phone1"]?>"></td></tr>
            <tr><td>E-mail:</td><td><input type="text" value="<?=$data["user_email"]?>"></td></tr>
            <tr><td>Адрес:</td><td><input type="text" value="<?=$data["user_address"]?>"></td></tr>
            <tr><td>ИНН:</td><td><input type="text" value="<?=$data["user_inn"]?>"></td></tr>
            <tr><td>ОГРН:</td><td><input type="text" value="<?=$data["user_ogrn"]?>"></td></tr>
            <tr><td>Категория пользователя</td><td><select>
            <?php while ($permitsdata = mysql_fetch_assoc($permits) AND $permitsalldata = mysql_fetch_assoc($permitsall) AND $i<=$permitsnum) {
                $i++;?>
            <option value="<?=$permitsalldata["permitvalue"]?>"><?=$i?></option>
            <?php } ?>
            </select></td></tr>
            <tr><td>Дата регистрации</td><td><?=$data["datereg"]?></td></tr>
        </table>
    </form>
            
<?php } 

$request = $_REQUEST['AddNewTracker'];

// Делаем запрос в таблицу с трекерами
$resulttrackers =  mysql_query("SELECT * FROM $table_trackers WHERE userid='$UserIdFromUrl[1]' ORDER BY treckerid");
$num = mysql_num_rows($resulttrackers);
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
    if ($num>0){
?>
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
            <td><a href="http://<?=$_SERVER['SERVER_NAME']?>/users/<?=$UserIdFromUrl[1]?>/?imei=<?=$data["imei"]?>"><?=$data["treckerid"]?></a></td>
            <td><?=$data["name"]?></td>
            <td><?=$data["mark"]?></td>
            <td><?=$data["imei"]?></td>
        </tr>
<?php } ?>
        </table>
<?php }

else {echo "<br><b>Зарегистрированных трекеров нет</b><br>";}
}

else { echo "Вероятно, это не ваша страница.";}
?>
    </body>
</html>
