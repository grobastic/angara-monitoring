<section id="content"><div>
<?php

// Если сессия не запущена
if (!isset($_SESSION[$sessionname])) : 
    // Показываем форму регистрации и авторизации
    ?>
<table>
    <tr>
        <td><?php require_once $_SERVER['DOCUMENT_ROOT'].'/forms/registration.html';?>
        </td>
        <td style="vertical-align: top;"><?php require_once $_SERVER['DOCUMENT_ROOT'].'/components/login.php';?></td>
    </tr>
</table>
<?php
 endif;
// Если сессия запущена
if (isset($_SESSION[$sessionname])) { 
    $usersessionid = $_SESSION[$sessionname]['sessionid'];
    $usersql = mysql_query("SELECT * FROM $tablename WHERE user_hash='$usersessionid' ORDER BY userid LIMIT 1");
    $num2 = mysql_num_rows($usersql);
    while ($data=mysql_fetch_assoc($usersql)){echo "Вы авторизованы как <a href = 'http://".$_SERVER['SERVER_NAME']."/users/".$data['userid']."'>" .$data['user_login']."</a>";} echo "<br>"; echo "<a href='http://".$_SERVER['SERVER_NAME']."/components/logout.php'>Выйти</a>";
}
// Если сессия запущена и пользователь Админ
if ($permitslvl == 9) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/forms/addarticle.html';
    $resultusers =  mysql_query("SELECT * FROM $tablename ORDER BY userid"); 
    $num = mysql_num_rows($resultusers);
    
    echo "<br>Строк в таблице: ".  $num;
    echo "<br>";
?>
    <table style="border:2px solid black">
        <tr>
            <td>№</td>
            <td>ID</td>
            <td>Логин</td>
            <td>Пароль</td>
            <td>E-mail</td>
            <td>Категория пользователя</td>
            <td>Дата регистрации</td>
            <td>IP</td>
            <td></td>
        </tr>
<?php 
// Запрос в таблицу со списком прав

// Показываем таблицу зарегистрированных пользователей
while ($data=mysql_fetch_assoc($resultusers) AND $i<=$num){ $i++; $usercat = $data["user_cat"]; 
    $permits = mysql_query("SELECT permitdescription FROM userpermits WHERE permitvalue='$usercat'") or die('Ничего не работает');?>
        <form action="deleteuser.php">    
            <tr>
                <td><?=$i?></td>
                <td><a href="/users/<?=$data["userid"]?>"><?=$data["userid"]?></a></td>
                <td><?=$data["user_login"]?></td>
                <td><?=$data["user_password"]?></td>
                <td><?=$data["user_email"]?></td>
            <?php while ($permitsdata = mysql_fetch_assoc($permits)) {?>
                <td><?=$permitsdata["permitdescriptio"]?></td> 
            <?php } ?>
                <td><?=$data["datereg"]?></td>
                <td><?=long2ip($data["user_ip"])?></td>
                <td><button type="submit" name="DeleteByUserId" value="<?=$data["userid"]?>">X</button></form></td>
            </tr>
<?php  } } 
?>
</table>
        <p><a href="points.php">Посмотреть данные с трекера</a></p>
        <p><a href="/test1.php">Карта</a></p>
<?php
//$MenuAlter = new MenuMine('articles', $sessionname, $permitslvl, 1, 1);
//$MenuAlter->MenuQuery();
//$MenuAlter->MenuResult();
?>
        </div>
            </section>