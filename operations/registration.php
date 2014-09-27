<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/sqlvariable.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/sql.php';

// Если нажата кнопка, то показываем введенные данные и создаем пользователя
    if (isset($_REQUEST['NewUser'])) { 
        $login = trim($_REQUEST['login']);
        $passmd5 = md5(md5(trim($_REQUEST['pass']))); // Убираем лишние пробелы и делаем двойное шифрование
        $pass = $_REQUEST['pass'];
        $username = trim($_REQUEST['username']);
        $fname="index.php";
        // Проверям данные
        if(!preg_match("/^[a-zA-Z0-9]+$/",$login))
        { $err[] = "Логин может состоять только из букв английского алфавита и цифр"; }
        if(strlen($login) < 3 or strlen($login) > 30)
        { $err[] = "Логин должен быть не меньше 3-х символов и не больше 30"; }
        // Проверяем, не сущестует ли пользователя с таким именем
        $query = mysql_query("SELECT COUNT(userid) FROM users WHERE user_login='".mysql_real_escape_string($login)."'");
        if(mysql_result($query, 0) > 0)
        { $err[] = "Пользователь с таким логином уже существует в базе данных"; }

    // Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
        {
            $tablename = "users";
            mysql_query("INSERT INTO $tablename SET user_login='$login', user_password='$passmd5', user_cat='1'");
            $getuseridsql = mysql_query("SELECT * FROM $tablename WHERE user_login='$login' AND user_password='$passmd5' LIMIT 1") or die ("SQL Error: ".  mysql_error());
            while ($getuserid=mysql_fetch_assoc($getuseridsql))
            {
            echo $getuserid['userid']. " Идентификатор пользователя.";
            if ($getuserid['userid'] == 1) { 
                mysql_query("UPDATE $tablename SET user_cat='9' WHERE user_login='$login'") or die ("SQL Error: ".  mysql_error());
                echo "Это админ!"; }
            $directory = "../users/".$getuserid['userid'];
            mkdir($directory); // создаем директорию пользователя
            chdir($directory); // меняем директорию
            $file = fopen($fname, "a+t"); // создаем новый файл
            $string = "<?php require '../../user.php'; ?>"; // будущее содержимое файла берем из шаблона
            fwrite($file, $string); // производим запись в файл
            fclose($file); // закрываем файл после записи
            chdir("../../"); // возвращаемся в корневую директорию
            }
        }
    else

    {

        print "<b>При регистрации произошли следующие ошибки:</b><br>";

        foreach($err AS $error)
        {
         print $error."<br>";
        }
    }
              
   ?>
    <p><b>Логин:</b> <?=$login?></p>
    <p><b>Пароль:</b> <?=$pass?></p>
    <p>Пароль с мд5: <?=$passmd5?> </p>
    <p>Ф.И.О.: <?=$username?></p>
    <a href="http://<?=$_SERVER['SERVER_NAME']?>/index.php">Назад</a>
<?php } ?>