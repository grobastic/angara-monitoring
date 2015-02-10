<?php

class ArtParams {

    private $tablename = '';
    private $query = '';
    static $Longname;

    function __construct($tablename) {
        
        $this->tablename = $tablename;
        
    }
    function ArtQuery ()
    {
        // Получаем URL страницы
        $pattern = '/(\d+)/s';
        $URL = $_SERVER["REQUEST_URI"];
        
        // Разбираем URL и получаем userid
        preg_match($pattern, htmlspecialchars($URL), $ArtIdFromUrl) or die ("<br>Doesn't work");
        $this->ArtUserID = $ArtIdFromUrl[1];
        $this->query =  mysql_query("SELECT artshortname,artlongname,artmetatitle,artkeywords,artcontent,artaccess FROM $this->tablename WHERE artuserid='$this->ArtUserID' LIMIT 1") or die ("<br>SQL Doesn't work");
    }
    function ArtResult ()
    {
        for ($Art = array(); $query = mysql_fetch_assoc($this->query); $Art[] = $query);
        $this->ArtLongname = $Art[0]['artlongname'];
        $this->ArtTitle = $Art[0]['artmetatitle'];
        $this->ArtBody = htmlspecialchars_decode($Art[0]['artcontent']);
        
        return $this->ArtLongname;
        return $this->ArtTitle;
        return $this->ArtBody;
        return $this->ArtUserID;
        
    }
}
