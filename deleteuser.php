<?php 
// Удаляем пользователя из БД и папку пользователя
// Запускаем сессию
session_name("Auth");
session_start();

// Если кнопка не нажата, то возвращяем пользователя на главную
if (!isset($_REQUEST['DeleteByUserId'])) 
    {
    header('Location:index.php');
    exit;
    } 
// Проверяем, что нажата кнопка и что нажал её Админ
if (isset($_REQUEST['DeleteByUserId']) AND $_SESSION['Auth']['user_cat'] == 9) 
{
require_once 'lib/sqlvariable.php';
require_once 'lib/sql.php';

$tablename = "users";
$deleteuserid = $_REQUEST['DeleteByUserId'];
$delete_row = mysql_query("DELETE FROM $tablename WHERE userid=$deleteuserid") or die ("SQL Error: ".  mysql_error()); // Удаляем пользователя с определенным ID из базы
$directory = "./users/".$deleteuserid;
chdir($directory); // Меняем директорию
$fname="index.php";
if (fopen($fname, "r+t")=== FALSE) {echo "Файл не был создан";} else {unlink($fname);} // Проверяем, есть ли файл, если есть - удаляем
chdir("../../"); // Возвращаемся в корневую директорию
rmdir("./users/".$deleteuserid); // Удаляем директорию пользователя
echo "<br>Пользователь с идентификатором <strong>".$deleteuserid."</strong> удален.";
echo "<br><a href='http://news.list/index.php'>Вернуться</a>";
}
?>