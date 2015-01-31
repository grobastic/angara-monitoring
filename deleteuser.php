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

$DeleteUser = new DeleteUser('DeleteByUserId', 'users', 'Auth');
$DeleteUser->DeleteUser();
$DeleteUser->MSG();
?>