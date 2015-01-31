<?php 
// Запускаем сессию
session_name("Auth");
session_start();

function __autoload ($class_name) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/'.$class_name.'.php';
}
$vars = new sqlvariable();
$sql = new MySQLConnection($vars->sqlservername,$vars->sqluser, $vars->sqlpass, $vars->sqldbname);
$PageSpeed = new PageSpeed();

$registration = new UserRegistration('users', 'NewUser','user_login','user_password', 'user_email', 'reserv1');
$registration->CheckParam();
$registration->ShowErrors();
$registration->ProcessResult();

?>