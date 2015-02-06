<?php

class AddArticle {
    function __construct($requestname, $tablename, $sessionname) 
    {
        //Получаем данные
        $this->funct_args = func_get_args();
        $this->numargs = func_num_args();
        $this->tablename = $tablename; //Обязательный параметр имя таблицы
        $this->requestname = $_REQUEST[$requestname]; //Обязательный параметр имя формы
        $this->sessionname = $sessionname; //Обязательный параметр
        
        if (isset($this->requestname) AND $_SESSION[$this->sessionname]['user_cat'] == 9) 
        {
            for ($i=3; $i<$this->numargs; $i++) 
            {
            $this->funct_argsnew[$this->funct_args[$i]] = htmlspecialchars(trim($_REQUEST[$this->funct_args[$i]]));
            }
        }
    }
    function ProcessResult()
    {
        if ($this->funct_argsnew['artuserid'] == '')
            { 
            $result = mysql_query("SELECT artid FROM $this->tablename ORDER BY artid DESC LIMIT 0,1") or die ("SQL Error: ".  mysql_error());//Выбираем идентификатор последней записи
                if (!$result) 
                    {
                    $this->funct_argsnew['artuserid'] = 1; //Если записей нет, то идентификатор будет равен 1
                    }
            $result = mysql_fetch_assoc($result);//Формируем массив
            $this->funct_argsnew['artuserid'] = ++$result['artid']; //Увеличиваем значени на единицу
            }
        $ArrayKeys = array_keys($this->funct_argsnew); //Получаем ключи массива (названия полей формы)
        $ArrayKeys = implode(", ", $ArrayKeys); //Преображуем массив со списком полей в строку
        $ArrayValues = implode("', '", $this->funct_argsnew); //Перобразуем массив с данным формы в строку
        //Формируем запрос, записываем данные в базу        
        mysql_query("INSERT INTO $this->tablename ($ArrayKeys) VALUES ('$ArrayValues')") or die ("SQL Error: ".  mysql_error());
    }
    function __destruct()
    {
        header('Location:http://'.$_SERVER['HTTP_HOST'].'/index.php');
    }
}
