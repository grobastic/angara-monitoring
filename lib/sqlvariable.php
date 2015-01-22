<?php
class sqlvariable {
    public $sqlservername;
    public $sqldbname;
    public $sqluser;
    public $sqlpass;
            
    function __construct() {
        //Данные для подключения к серверу

        //Локальный сервер
        //$this->sqlservername = "localhost";
        //$this->sqldbname = "newproject";
        //$this->sqluser = "root";
        //$this->sqlpass = "";

        //Ру-центр хостинг
        $this->sqlservername = "angara-mon.mysql:3306";
        $this->sqldbname = "angara-mon_db";
        $this->sqluser = "angara-mon_mysql";
        $this->sqlpass = "pfqd8xti";

    }

}
?>

