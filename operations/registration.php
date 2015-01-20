<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/sqlvariable.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/sql.php';

class UserRegistration {
    
    private $login;
    private $pass;
    private $passmd5;
    private $username;
    private $err;
    
    function GetParam($requestname) {
        // Получаем данные
        if (isset($_REQUEST[$requestname])) {
        $this->login = $_REQUEST['login'];
        $this->pass = $_REQUEST['pass'];
        $this->username = $_REQUEST['username']; 
        }
    }
    function ProcessParam() {
        // Обрабатываем данные
        $this->login = trim($this->login);
        $this->pass = trim($this->pass);
        $this->passmd5 = md5(md5($this->pass));
        $this->username = trim($this->username);
    }
    function CheckParam() {
        // Проверям данные
        if(!preg_match("/^[a-zA-Z0-9]+$/",$this->login))
        { $this->err[] = "Логин может состоять только из букв английского алфавита и цифр"; }
        if(strlen($this->login) < 3 or strlen($this->login) > 30)
        { $this->err[] = "Логин должен быть не меньше 3-х символов и не больше 30"; }
        if(strlen($this->pass) < 6)
        { $this->err[] = "Пароль должен быть не меньше 6-и символов"; }
        
        // Проверяем, не сущестует ли пользователя с таким именем
        $query = mysql_query("SELECT COUNT(userid) FROM users WHERE user_login='".mysql_real_escape_string($this->login)."'");
        if(mysql_result($query, 0) > 0)
        { $this->err[] = "Пользователь с таким логином уже существует в базе данных"; }
    }
    function ShowErrors() {
        if(count($this->err) > 0) {
            print "<b>При регистрации произошли следующие ошибки:</b><br>";
            foreach($this->err AS $error)
            { print $error."<br>"; }
        }
    }
    function ProcessResult($tablename="users") {
        
        $fname="index.php";
        
        if(count($this->err) == 0) {
            mysql_query("INSERT INTO $tablename SET user_login='$this->login', user_password='$this->passmd5', user_cat='2'");
            $getuseridsql = mysql_query("SELECT * FROM $tablename WHERE user_login='$this->login' AND user_password='$this->passmd5' LIMIT 1") or die ("SQL Error: ".  mysql_error());
            while ($getuserid=mysql_fetch_assoc($getuseridsql))
            {
            echo $getuserid['userid']. " Идентификатор пользователя.";
            if ($getuserid['userid'] == 1) { 
                mysql_query("UPDATE $tablename SET user_cat='9' WHERE user_login='$this->login'") or die ("SQL Error: ".  mysql_error());
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
    }
    
    function ShowResult() {
    echo "<p><b>Логин:</b> ".$this->login."</p>";
    echo "<p><b>Пароль:</b> ".$this->pass."</p>";
    echo "<p>Пароль с мд5: ".$this->passmd5."</p>";
    echo "<p>Ф.И.О.: ".$this->username."</p>";
    echo "<a href='http://" .$_SERVER['SERVER_NAME']."/index.php'>Назад</a>";
    }
    
}
$registration = new UserRegistration;
$registration->GetParam('NewUser');
$registration->ProcessParam();
$registration->CheckParam();
$registration->ShowErrors();
$registration->ProcessResult();
$registration->ShowResult();