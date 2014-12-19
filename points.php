<html><head></head><body>
<?php

ini_set("display_errors","1");
ini_set("display_startup_errors","1");
ini_set('error_reporting', E_ALL);

//require_once $_SERVER['DOCUMENT_ROOT'].'/lib/sqlvariable.php';
$sqlservername = "37.112.113.169:3306";
$sqluser = "angara";
$sqlpass = "Cthutq62924";
$sqldbname = "points";
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/sql.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/paging.php';
$i = 0;
$i = $_REQUEST['i'];
$tablename = "points";
$pt_num_rows = mysql_num_rows(mysql_query("SELECT * FROM $tablename ORDER BY ptid"));
if (!isset($i)) { $fid_query = mysql_query("SELECT * FROM $tablename ORDER BY ptid");
if (!$fid_query) {die ("Запрос не выполняется: ".  mysql_error());} else {echo "Всё Ok!";} }
if (isset($i)) { $fid_query = mysql_query("SELECT * FROM $tablename ORDER BY ptid LIMIT $i,5") or die ("Запрос не выполняется: ".  mysql_error()); }

?>
<p><a href="http://<?=$_SERVER['SERVER_NAME']?>/index.php">На главную</a></p>
<p><a href="http://<?=$_SERVER['SERVER_NAME']?>/points.php?i=0">Постраничный режим</a></p>
<p><a href="http://<?=$_SERVER['SERVER_NAME']?>/points.php">Показать все записи разом</a></p>
<table style="border: 2px solid black; width: 100%;">
    <tr><td>ID</td><td>IMEI</td><td>ID устройства</td><td>Дата</td><td>Широта</td><td>Долгота</td><td>satellites</td><td>Скорость</td><td>Угол</td><td>gps_state</td><td>mcc</td><td>mnc</td>
        <td>lac</td><td>cellid</td><td>state_acc</td><td>state_power</td><td>state_gps</td><td>state_oil</td><td>vin</td><td>gsm</td></tr>
<?php
while ($data=mysql_fetch_assoc($fid_query)) { ?>
    <tr style="text-align: center;"><td><?=$data['ptid']?></td><td><?=$data['imei']?></td><td><?=$data['device_id']?></td><td><?=$data['timestamp_utc']?></td><td><?=$data['latitude']?></td><td><?=$data['longitude']?></td>
        <td><?=$data['satellites']?></td><td><?=$data['speed']?></td><td><?=$data['angle']?></td><td><?=$data['gps_state']?></td><td><?=$data['mcc']?></td><td><?=$data['mnc']?></td>
        <td><?=$data['lac']?></td><td><?=$data['cellid']?></td><td><?=$data['state_acc']?></td><td><?=$data['state_power']?></td><td><?=$data['state_gps']?></td><td><?=$data['state_oil']?></td>
        <td><?=$data['vin']?></td><td><?=$data['gsm']?></td>
    </tr>
<?php } ?>
</table>
<?php if (isset($i)) { paging ($pt_num_rows); } ?>
</body></html>
