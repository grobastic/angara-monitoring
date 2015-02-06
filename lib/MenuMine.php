<?php
class MenuMine {

    private $permitslevel;
    private $sessionname;
    private $tablename;

    function __construct($tablename, $sessionname, $permitslevel, $show, $parent='') {
        $this->tablename = $tablename; //Обязательный параметр "имя таблицы"
        $this->sessionname = $sessionname; //Обязательный параметр "имя сессии"
        $this->show = $show; //Обязательный параметр, 1 - показывать, 0 - не показывать
        $this->parent = $parent; //Обязательный параметр "родительская статья"
        // Если пользователь не авторизован, то показываем статьи со значением "permitslevel" = 0
        if (!isset($_SESSION[$this->sessionname])) 
            {
            $this->permitslevel = 0;
            }
            else
            {
                $this->permitslevel = $permitslevel; //Обязательный параметр уровень доступа
            }
    }
    function MenuQuery ()
    {
        $this->query = mysql_query("SELECT artuserid, artshortname FROM $this->tablename WHERE artshow='$this->show' AND artaccess <= '$this->permitslevel' AND artparent='$this->parent' ORDER BY artsort") or die ("SQL Error: ".  mysql_error());
        $this->num = mysql_num_rows($this->query);
    }
    function MenuResult ()
    { ?>
<table><tr>
    <?php
        for ($i = 0; $i <= $this->num; $i++) : 
            $result = mysql_fetch_assoc($this->query);
        ?>
        <td><a href="http://<?=$_SERVER['SERVER_NAME']?>/qa/<?=$result["artuserid"]?>.php"><?=$result["artshortname"]?></a></td>
            <?php
        endfor; ?>
</tr></table>
    <?php
    }
}
