<?php
// Запускаем  сессию
session_name("Auth");
session_start();

function __autoload ($class_name) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/'.$class_name.'.php';
}

// Если не запущена сессия или не нажата кнопка
if (!isset($_SESSION['Auth']) || !isset($_REQUEST['AddNewTracker'])) {    echo 'Вы здесь явно случайно';}
// Если пользователь авторизован и кнопка нажата
if (isset($_SESSION['Auth']) AND isset($_REQUEST['AddNewTracker'])) 
    {
    $vars = new sqlvariable();
    $sql = new MySQLConnection($vars->sqlservername,$vars->sqluser, $vars->sqlpass, $vars->sqldbname);
    
    $usertablename = "users";
    $trackertablename = "trackers";
    $usersessionid = $_SESSION['Auth']['sessionid'];
    $usersql = mysql_query("SELECT * FROM $usertablename WHERE user_hash='$usersessionid' ORDER BY userid LIMIT 1");
    $data = mysql_fetch_assoc($usersql);
    
    // Проверяем совпадают ли userid в сесии и в странице с которой он пришел 
    // Если userid не совпали
    if ($_REQUEST['userid'] !== $data['userid']) { echo 'Идентификаторы не совпадают '.$_REQUEST['userid'];}
    // Если userid совпали
    if ($_REQUEST['userid'] === $data['userid']) 
        { 
        $userid = $data['userid'];
        // Создаем переменную и удаляем пробелы
//        $trackername = trim($_REQUEST['trackername']);
//        $trackermark = trim($_REQUEST['trackermark']);
        $trackerimei = trim($_REQUEST['trackerimei']);
        
        $querytrackername = mysql_query("SELECT COUNT(*) FROM $trackertablename WHERE userid='$userid' AND name='$trackername'");
        $querytrackerimei = mysql_query("SELECT COUNT(*) FROM $trackertablename WHERE userid='$userid' AND imei='$trackerimei'");
        // Проверяем наличие трекера в базе
        if(mysql_result($querytrackerimei, 0) > 0)
        { $err[] = "Трекер с таким IMEI уже зарегистрирован"; }
//        if(mysql_result($querytrackername, 0) > 0)
//        { $err[] = "Трекер с таким именем уже зарегистрирован"; }
        // Проверка введенных данных
        if(!preg_match("/^[a-zA-Z0-9]+$/",$trackerimei))
        { $err[] = "IMEI может состоять только из букв английского алфавита и цифр"; }
//        if(!preg_match("/^[a-zA-Z0-9]+$/",$trackermark))
//        { $err[] = "Марка трекера может состоять только из букв английского алфавита и цифр"; }
//        if(!preg_match("/^[a-zA-Z0-9]+$/",$trackername))
//        { $err[] = "Наименование трекера может состоять только из букв английского алфавита и цифр"; }
        // Вывод ошибок
        if(count($err) == 0) 
            {
            mysql_query("INSERT INTO $trackertablename SET userid='$userid', name='$trackername', mark='$trackermark', imei='$trackerimei'") or die ("SQL Error: ".  mysql_error());
            echo "<br>";
            echo "Трекер занесен в базу.";
            }
        else
            {
            print "<br><b>При регистрации трекера произошли следующие ошибки:</b><br>";
            foreach($err AS $error)
                {
                print $error."<br>";
                }
            }
        }
}

?>

