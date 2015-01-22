<?php
// Запускаем сессию
session_name("Auth");
session_start();
if (!isset($_SESSION['Auth'])) {
?>
   <form method="GET" action="http://<?=$_SERVER['SERVER_NAME']?>/operations/check.php">
    Логин: <input name="login" type="text"><br>
    Пароль: <input name="password" type="password"><br>
    <input name="UserAuth" type="submit" value="Войти">
    </form> 
<?php 
}
else {
    echo "Вы уже авторизованы";
    echo "<br>";
    echo "<a href='http://".$_SERVER['SERVER_NAME']."/index.php'>На главную</a>";
    
}
?>