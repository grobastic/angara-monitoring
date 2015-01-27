<?php
// Запускаем сессию
session_name("Auth");
session_start();
if (!isset($_SESSION['Auth'])) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/forms/login.html';
}
else {
    echo "Вы уже авторизованы";
    echo "<br>";
    echo "<a href='http://".$_SERVER['SERVER_NAME']."/index.php'>На главную</a>";
    
}