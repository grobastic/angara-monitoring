<?php
$fid_redirect = "http://".$_SERVER['SERVER_NAME']."/operations/fid_check.php";
     ?>
<form action="<?=$fid_redirect?>">
    <table width="100%">
        <tr><td width="15%">Представьтесь: </td><td><input placeholder="Ваше имя" type="text" name="fid_default_fio"></td></tr>
        <tr><td>e-mail: </td><td><input placeholder="test@test.ru" name="fid_default_email" type="email"></td></tr>
        <tr><td>Контактный телефон: </td><td><input placeholder="+79041159000" name="fid_default_phone" type="tel"></td></tr>
        <tr><td>Текст обращения: </td><td></td></tr>
        <tr><td colspan="2"><textarea cols="50" rows="10" placeholder="Введите ваше сообщение" name="fid_default_text_message"></textarea></td></tr>
        <tr><td><button name="fid_default_send">Отправить</button></td><td><button type="reset">Очистить</button></td></tr>
    </table>
    </form>
<?php require_once 'feedback_watch.php'; ?>