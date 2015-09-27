<?php
class MenuMine {

    private $permitslevel;
    private $sessionname;
    private $tablename;
    private $show;
    private $parent;
    private $alter;
    private $query;
    private $num;

    function __construct($tablename, $sessionname, $permitslevel, $show, $alter=0, $parent='') {
        $this->tablename = $tablename; //Обязательный параметр "имя таблицы"
        $this->sessionname = $sessionname; //Обязательный параметр "имя сессии"
        $this->show = $show; //Обязательный параметр, 1 - показывать, 0 - не показывать
        $this->parent = $parent; //Обязательный параметр "родительская статья"
        $this->alter = $alter;
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
        if ($this->alter !== 1) :
        $this->query = mysql_query("SELECT artuserid, artshortname FROM $this->tablename WHERE artshow = '$this->show' AND artaccess <= '$this->permitslevel' AND artparent='$this->parent' ORDER BY artsort") or die ("SQL Error: ".  mysql_error());
        else :
        $this->query = mysql_query("SELECT artuserid, artshortname FROM $this->tablename WHERE artshow <= '$this->show' AND artaccess <= '$this->permitslevel' AND artparent='$this->parent' ORDER BY artsort") or die ("SQL Error: ".  mysql_error());
        endif;
        $this->num = mysql_num_rows($this->query);
    }
    function MenuResult ()
    { ?>
<div <?php if ($this->alter !== 1) :  ?>id="sf-menu" <?php endif;?> >
    <ul class="sf-menu">
       <?php if (!$this->parent) : ?> <li class="current"><a href="http://<?=$_SERVER['SERVER_NAME']?>/index.php">Главная</a></li> <?php endif; ?>
    <?php
        for ($i = 1; $i <= $this->num; $i++) : 
            $result = mysql_fetch_assoc($this->query);
        ?>
        <li style="display: inline;"><a href="http://<?=$_SERVER['SERVER_NAME']?>/qa/<?=$result["artuserid"]?>.php"><?=$result["artshortname"]?></a></li>
            <?php endfor; ?>
    </ul>
</div>
    <?php
    }
}
