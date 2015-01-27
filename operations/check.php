<?php
function __autoload ($class_name) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/'.$class_name.'.php';
}
// Страница проверки авторизации

// Если пользователь случайно попал на страницу отправляем его на страницу авторизации
if (!isset($_REQUEST['UserAuth'])) 
    {
    header('Location:http://'.$_SERVER['SERVER_NAME'].'/login.php');
    exit;
    }       
// Если пользователь нажал кнопку авторизации        
if (isset($_REQUEST['UserAuth'])) {
    // Запускаем сессию
    session_name("Auth");
    session_start();

$vars = new sqlvariable();
$sql = new MySQLConnection($vars->sqlservername,$vars->sqluser, $vars->sqlpass, $vars->sqldbname);

$LoginCheck = new LoginCheck ('UserAuth', 'login', 'password');
$LoginCheck->CheckParam();
$LoginCheck->CheckUser('users');
$LoginCheck->SessionIDGenerate();
$LoginCheck->WriteSessionID();
$LoginCheck->ShowErrors();

    echo "<br>";
    echo "<a href='http://".$_SERVER['SERVER_NAME']."/login.php'>Назад</a> ";
    echo "<a href='http://".$_SERVER['SERVER_NAME']."/'>На главную</a> ";
    echo "<a href='http://".$_SERVER['SERVER_NAME']."/users/".$userid. "'>К себе</a>";
}
?>
