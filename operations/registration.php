<?php 
function __autoload ($class_name) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/'.$class_name.'.php';
}
$vars = new sqlvariable();
$sql = new MySQLConnection($vars->sqlservername,$vars->sqluser, $vars->sqlpass, $vars->sqldbname);
$PageSpeed = new PageSpeed();

$registration = new UserRegistration('NewUser','login','pass','username');
$registration->CheckParam();
$registration->ShowErrors();
$registration->ProcessResult();
$registration->ShowResult();

?>