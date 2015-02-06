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

$AddArticle = new AddArticle('AddArticle', 'articles', 'Auth', 'artuserid', 'artshortname', 'artlongname', 'artmetatitle', 'artkeywords', 'artparent', 'artlink', 'artshow', 'artsort', 'artannotation', 'artcontent');
$AddArticle->ProcessResult();

