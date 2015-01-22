<?php 
// Запускаем сессию
session_name("Auth");
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/sqlvariable.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/sql.php';

// Если кнопка нажата, то обрабатываем данные
if(isset($_REQUEST['fid_default_send'])){
    $fid_userid = $_SESSION['Auth']['userid'];
        // Если пользователь не авторизован, то userid=0
        if(!isset($_SESSION['Auth'])) {$fid_userid = 0;}
    $fid_default_fio = $_REQUEST['fid_default_fio'];
    $fid_default_email = $_REQUEST['fid_default_email'];
    $fid_default_phone = $_REQUEST['fid_default_phone'];
    $fid_default_text_message = $_REQUEST['fid_default_text_message'];    
    $fid_browser = $_SERVER['HTTP_USER_AGENT'];
    $fid_user_ip = $_SERVER['REMOTE_ADDR'];
    $fid_info = "Browser: ".$_SERVER['HTTP_USER_AGENT']."<br>"
        ."IP-адрес: ".$_SERVER['REMOTE_ADDR']."<br>";
    $total = "Ф.И.О.: ".$fid_default_fio."<br>"
        ."e-mail: ".$fid_default_email."<br>"
        ."Телефон: ".$fid_default_phone."<br>"
        ."Текст: ".$fid_default_text_message."<br>"
        .$fid_info;
    if (strlen($fid_default_fio) == 0 || strlen($fid_default_email) == 0) {
                echo 'Какое-то поле не заполнено!';
                exit();
    }
     mysql_query("INSERT INTO feedback SET fid_userid='$fid_userid', fid_fio='$fid_default_fio', fid_phone='$fid_default_phone', fid_email='$fid_default_email', "
            . "fid_text_message='$fid_default_text_message', fid_browser='$fid_browser', fid_user_ip='$fid_user_ip'");
     echo "Ваш отзыв добавлен в базу. <a href='".$_SERVER['HTTP_REFERER']."'>Вернуться</a>";
}
?>