<?php
class DeleteUser {
    private $requestname;
    private $tablename;
    private $sessionname;
    private $deleteuserid;
    private $result;
    private $directory;

    function __construct ($requestname, $tablename, $sessionname) 
    {
        $this->requestname = $requestname;
        $this->tablename = $tablename;
        $this->sessionname = $sessionname;
        $this->deleteuserid = $_REQUEST[$this->requestname];
        // Если кнопка не нажата, то возвращяем пользователя на главную
        if (!isset($_REQUEST[$this->requestname])) 
            {
            header('Location:index.php');
            exit;
            } 
    }
    function DeleteUser ()
    {
         if (isset($_REQUEST[$this->requestname]) AND $_SESSION[$this->sessionname]['user_cat'] == 9)
         {
            $this->directory = $_SERVER['DOCUMENT_ROOT']."/users/".$this->deleteuserid;
            // Проверяем, есть ли файл, если есть - удаляем
            if (file_exists($this->directory)) 
                { 
                unlink($this->directory."/index.php"); 
                rmdir($_SERVER['DOCUMENT_ROOT']."/users/".$this->deleteuserid); // Удаляем директорию пользователя
                } 
                else 
                    {
                    echo "Файл не был создан <br>"; 
                    } 
                mysql_query("DELETE FROM $this->tablename WHERE userid='".htmlspecialchars($this->deleteuserid)."' LIMIT 1") or die ("SQL Error: ".  mysql_error(). "<br>"); // Удаляем пользователя с определенным ID из базы
                                
            if (file_exists($this->directory) == TRUE) {$this->result = 1;} else {$this->result = 0;}
         }
    }
    function MSG ()
    {
        if ($this->result == 1)
        {
        echo "<br>Пользователь с идентификатором <strong>".$this->deleteuserid."</strong> удален.";
        echo "<br><a href='http://news.list/index.php'>Вернуться</a>";
        }
        if ($this->result == 0)
        {
        echo "<br>Пользователь с идентификатором <strong>".$this->deleteuserid."</strong> не найден.";
        echo "<br><a href='http://news.list/index.php'>Вернуться</a>";
        }
    }
    function __destruct() {
        
    }
}
