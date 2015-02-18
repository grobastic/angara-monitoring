<?php
class LoginCheck {
    private $login;
    private $pass;
    private $query;
    private $count;
    private $tablename;
    private $err = array();

    function __construct($requestname, $login, $pass) {
        $this->login = trim(strip_tags($_REQUEST[$login]));
        $this->pass = trim(strip_tags($_REQUEST[$pass]));
    }
    function __destruct() {
        
    }
    function CheckParam() {
        // Проверям данные
        if(!preg_match("/^[a-zA-Z0-9]+$/",$this->login))
        { $this->err[] = "Логин может состоять только из букв английского алфавита и цифр"; }
        if(strlen($this->login) < 3 or strlen($this->login) > 30)
        { $this->err[] = "Логин должен быть не меньше 3-х символов и не больше 30"; }
    }
    function CheckUser($tablename) {
        // Ищем совпадение в базе
        $this->tablename = $tablename;
        $this->pass =  md5(md5($this->pass));
        $this->count = mysql_query("SELECT COUNT(*) FROM $this->tablename WHERE user_login='".$this->login."' AND user_password='$this->pass' LIMIT 1") or die ("SQL Error: ".  mysql_error());
        $this->query = mysql_query("SELECT * FROM $this->tablename WHERE user_login='".$this->login."' AND user_password='$this->pass' LIMIT 1") or die ("SQL Error: ".  mysql_error());
        if(count($this->err) == 0) {
            if(mysql_result($this->count, 0) == 0)
        { $this->err[] = "С указанным логином и паролем нет совпадений в базе <br> <a href='http://".$_SERVER['SERVER_NAME']."/operations/registration.php'>Зарегистрируйтесь</a>"; }
        }
    }
    function SessionIDGenerate () {
        // Если нашли совпадение
        if (mysql_result($this->count, 0) == 1) 
        {
        // Генерируем идентификатор сессии
        $md5id = md5(microtime());
        $this->sessionid = $md5id;
        
        // Получаем данные из БД и передаем сессии
        $data = mysql_fetch_assoc($this->query);
        $_SESSION['Auth']['Hash'] = $this->sessionid;
        $_SESSION['Auth']['sessionid'] = $this->sessionid;   
        $_SESSION['Auth']['user_cat'] = $data['user_cat'];          
        $_SESSION['Auth']['userid'] = $data['userid'];
        $_SESSION['Auth']['user_login'] = $data['user_login'];
        $this->userid = $data['userid'];
        }
    }
    function WriteSessionID () {
        if(count($this->err) == 0) {
            // Записываем идентификатор в БД 
           mysql_query("UPDATE $this->tablename SET user_hash='".htmlspecialchars($this->sessionid)."' WHERE userid='$this->userid'");
           header('Location:http://'.$_SERVER['HTTP_HOST'].'/index.php');
        }
    }
    function ShowErrors() {
        if(count($this->err) > 0) {
            print "<b>При авторизации произошли следующие ошибки:</b><br>";
            foreach($this->err AS $error)
            { echo $error."<br>"; }
        }
    }
}
