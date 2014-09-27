<?php
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
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/sqlvariable.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/sql.php';

    $login = $_REQUEST['login'];
    $pass =  md5(md5(trim($_REQUEST['password'])));
    
    // Проверяем введенные данные
    if(!preg_match("/^[a-zA-Z0-9]+$/",$login))
        { $err[] = "Логин может состоять только из букв английского алфавита и цифр"; }
    if(strlen($login) < 3 or strlen($login) > 30)
        { $err[] = "Логин должен быть не меньше 3-х символов и не больше 30"; }
    // Ищем совпадение в базе
    $querycount = mysql_query("SELECT COUNT(*) FROM users WHERE user_login='$login' AND user_password='$pass'");
    $query = mysql_query("SELECT * FROM users WHERE user_login='$login' AND user_password='$pass'");
    if(mysql_result($querycount, 0) == 0)
        { $err[] = "С указанным логином и паролем нет совпадений в базе"; }
    // Если нашли совпадение
    if (mysql_result($querycount, 0) == 1) 
        {
        // Генерируем идентификатор сессии
        $md5id = md5(microtime());
        $sessionid = $md5id;
        
        // Получаем данные из БД и передаем сессии
        $data = mysql_fetch_assoc($query);
        $_SESSION['Auth']['Hash'] = $sessionid;
        $_SESSION['Auth']['sessionid'] = $sessionid;   
        $_SESSION['Auth']['user_cat'] = $data['user_cat'];          
        $_SESSION['Auth']['userid'] = $data['userid'];
        $_SESSION['Auth']['user_login'] = $data['user_login'];
        $userid = $data['userid'];
        
        // Записываем идентификатор в БД 
        mysql_query("UPDATE users SET user_hash='$sessionid' WHERE userid='$userid'");
        echo "Поздравляем! Вы авторизованы!";
        echo "<br>";
        echo $userid;
        }
        // Выводим ошибки, если есть
    else {  print "<b>При авторизации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        { print $error."<br>"; }
        }
    echo "<br>";
    echo "<a href='http://news.list/login.php'>Назад</a> ";
    echo "<a href='http://news.list/'>На главную</a> ";
    echo "<a href='http://news.list/users/".$userid. "'>К себе</a>";
}
?>
