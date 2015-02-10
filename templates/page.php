<?php 
function __autoload ($class_name) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/'.$class_name.'.php';
}
// Запускаем сессию
session_name("Auth");
session_start();

$permitslvl = $_SESSION[$sessionname]['user_cat'];
$tablename = "articles";

$vars = new sqlvariable();
$sql = new MySQLConnection($vars->sqlservername,$vars->sqluser, $vars->sqlpass, $vars->sqldbname);

$Art = new ArtParams($tablename);
$Art->ArtQuery();
$Art->ArtResult();

$ArtLongname = $Art->ArtLongname;
$ArtTitle = $Art->ArtTitle;
$ArtBody = $Art->ArtBody;
$ArtID = $Art->ArtUserID;

$MenuMine = new MenuMine($tablename, $sessionname, $permitslvl, 1, 0);
$MenuMine->MenuQuery();

$MenuTree = new MenuMine($tablename, $sessionname, $permitslevel, 1, 1, $ArtID);
$MenuTree->MenuQuery();

$MenuAlter = new MenuMine('articles', $sessionname, $permitslvl, 1, 1);
$MenuAlter->MenuQuery();

require_once 'page.html';
?>
