<?php
function __autoload ($class_name) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/'.$class_name.'.php';
}
$PageSpeed = new PageSpeed();
?>
<html>
    <head>
        <script src="js/jquery-2.1.4.min.js"></script>
    </head>
    <body>
        <script>
            $(document).ready(function(){
               $("#send").click(function(){
                  $("#status").load("http://<?=$_SERVER['SERVER_NAME']?>/test/zapros.php");
               })
            });   
        </script>
<p id="status">Содержание блока изменится согласно проработке файла example.php</p>
<input id="send" type="button" value="Передать данные скрипту" />        
    </body>
</html>




