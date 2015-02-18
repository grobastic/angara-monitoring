<?php
class UserRegistration 
{
    //Класс принимает данные из формы, в форме должны перечисляться все поля формы
    //1 параметр - название таблицы в базе
    //2 параметр - имя формы из которой приходят данные
    //3 параметр - поле логина
    //4 параметр - поле пароля
    //Остальные параметры произвольные, но обязательно перечислять их после обязательных

    private $login;
    private $pass;
    private $passmd5;
    private $username;
    private $err = array();
    private $tablename;
    private $funct_args;
    private $funct_argsnew = array();
    private $passfield;
    private $loginfield;
    private $requestname;
    private $numargs;

    function __construct() {
        // Получаем данные
        $this->funct_args = func_get_args();
        $this->numargs = func_num_args();
        $this->tablename = $this->funct_args[0]; //Обязательный параметр имя таблицы
        $this->requestname = $_REQUEST[$this->funct_args[1]]; //Обязательный параметр имя формы
        $this->loginfield = $this->funct_args[2]; //Берем название поля с логином
        $this->passfield = $this->funct_args[3]; //Берем название поля с паролем
             
        if (isset($this->requestname)) {
            for ($i=2; $i<$this->numargs; $i++) 
            {
            $this->funct_argsnew[$this->funct_args[$i]] = htmlspecialchars(trim(strip_tags($_REQUEST[$this->funct_args[$i]])));
            } 
            $this->funct_argsnew['user_ip'] = ip2long($_SERVER['REMOTE_ADDR']);//Добавляем IP-Адрес
            $this->funct_argsnew['user_cat'] = 2;//Задаем категорию пользователя (2 - Зарегистрированный)
            $this->login = $this->funct_argsnew[$this->loginfield]; //Login
            $this->pass = $this->funct_argsnew[$this->passfield]; //Password
        }
        else { require_once $_SERVER['DOCUMENT_ROOT'].'/forms/registration.html'; }
    }
    function CheckParam() {
        // Проверям данные
        if(!preg_match("/^[a-zA-Z0-9]+$/",$this->login))
        { $this->err[] = "Логин может состоять только из букв английского алфавита и цифр"; }
        if(strlen($this->login) < 3 or strlen($this->login) > 30)
        { $this->err[] = "Логин должен быть не меньше 3-х символов и не больше 30"; }
        if(strlen($this->pass) < 6)
        { $this->err[] = "Пароль должен быть не меньше 6-и символов"; }
        
        $this->funct_argsnew[$this->passfield] = md5(md5($this->funct_argsnew[$this->passfield]));//Шифруем пароль
        $this->passmd5 = $this->funct_argsnew[$this->passfield];
        
        // Проверяем, не сущестует ли пользователя с таким именем
        $query = mysql_query("SELECT COUNT(userid) FROM $this->tablename WHERE $this->loginfield='$this->login'") or die ("SQL Error: ".  mysql_error());
        if(mysql_result($query, 0) > 0)
        { $this->err[] = "Пользователь с таким логином уже существует в базе данных. "; }
    }
    function ShowErrors() {
        if (isset($this->requestname)) {
            if(count($this->err) > 0) {
                print "<b>При регистрации произошли следующие ошибки:</b><br>";
                foreach($this->err AS $error)
                    { echo $error."<br>"; }
            }
        }
    }
    function ProcessResult() 
    {
        if(count($this->err) == 0) 
        {
            $ArrayKeys = array_keys($this->funct_argsnew); //Получаем ключи массива (названия полей формы)
            $ArrayKeys = implode(", ", $ArrayKeys); //Преображуем массив со списком полей в строку
            $ArrayValues = implode("', '", $this->funct_argsnew); //Перобразуем массив с данным формы в строку
            //Формируем запрос, записываем данные в базу
            mysql_query("INSERT INTO $this->tablename ($ArrayKeys) VALUES ('$ArrayValues')") or die ("SQL Error: ".  mysql_error());
            //Получаем идентификатор только что зарегистрированного пользователя
            $getuseridsql = mysql_query("SELECT * FROM $this->tablename WHERE $this->loginfield='$this->login' AND $this->passfield='$this->passmd5' LIMIT 1") or die ("SQL Error: ".  mysql_error());
            while ($getuserid=mysql_fetch_assoc($getuseridsql))
            {
            echo $getuserid['userid']. " Идентификатор пользователя.";
            if ($getuserid['userid'] == 1) 
                { 
                mysql_query("UPDATE $this->tablename SET user_cat='9' WHERE $this->loginfield='$this->login'") or die ("SQL Error: ".  mysql_error());
                echo "Вы админ!!!"; 
                }
            $directory = $_SERVER['DOCUMENT_ROOT']."/users/".$getuserid['userid'];
            mkdir($directory); // Создаем директорию пользователя
            chdir($directory); // Переходим в созданную директорию
            $file = fopen("index.php", "a+t"); // создаем новый файл
            $string = "<?php require '".$_SERVER['DOCUMENT_ROOT']."/templates/user.php'; ?>"; // будущее содержимое файла берем из шаблона
            fwrite($file, $string); // производим запись в файл
            fclose($file); // закрываем файл после записи
            } 
            
        }
        
    }
    function ShowResult() {
    echo "<p><b>Логин:</b> ".$this->login."</p>";
    echo "<p><b>Пароль:</b> ".$this->pass."</p>";
    echo "<p>Ф.И.О.: ".$this->username."</p>";
    echo "<a href='http://" .$_SERVER['SERVER_NAME']."/index.php'>Назад</a>";
    }
    function __destruct() {

    }
}
    

    
