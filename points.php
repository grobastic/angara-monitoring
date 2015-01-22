<html><head></head><body>
<?php
function __autoload ($class_name) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/'.$class_name.'.php';
}
$vars = new sqlvariable();

$PageSpeed = new PageSpeed();

//ini_set("display_errors","1");
//ini_set("display_startup_errors","1");
//ini_set('error_reporting', E_ALL);

//require_once $_SERVER['DOCUMENT_ROOT'].'/lib/sqlvariable.php';
$ipmysql = $_REQUEST['ip'];
//$sqlservername = "176.214.110.241";
if (!isset($ipmysql) || $ipmysql == FALSE) { ?>
        <form action="<?=$_SERVER['SCRIPT_NAME']?>">
            <p>Введите IP сервера MySQL:</p><input type="text" name="ip">
            <input type="submit" value="Ready">
        </form>
  <?php  
 exit();
}
else {
$sqlservername = $ipmysql;
$sqluser = "angara";
$sqlpass = "Cthutq62924";
$sqldbname = "points";
$tablename = "gpsdata";

require_once $_SERVER['DOCUMENT_ROOT'].'/lib/paging.php';

$sql = new MySQLConnection($sqlservername,$sqluser, $sqlpass, $sqldbname);

$i = $_REQUEST['i'];
$pt_num_rows = mysql_num_rows(mysql_query("SELECT * FROM $tablename ORDER BY id"));
if (!isset($i)) { $fid_query = mysql_query("SELECT * FROM $tablename ORDER BY id");
if (!$fid_query) {die ("Запрос не выполняется: ".  mysql_error());} else {echo "Всё Ok!";} }
if (isset($i)) { $fid_query = mysql_query("SELECT * FROM $tablename ORDER BY id LIMIT $i,5") or die ("Запрос не выполняется: ".  mysql_error()); }

?>
<p><a href="http://<?=$_SERVER['SERVER_NAME']?>/index.php">На главную</a></p>
<p><a href="http://<?=$_SERVER['SERVER_NAME']?>/points.php?i=0&ip=<?=$ipmysql?>">Постраничный режим</a></p>
<p><a href="http://<?=$_SERVER['SERVER_NAME']?>/points.php?ip=<?=$ipmysql?>">Показать все записи разом</a></p>
<table style="border: 2px solid black; width: 100%;">
    <tr><td>ID</td><td>IMEI</td><td>ID устройства</td><td>Дата</td><td>Широта</td><td>Долгота</td><td>satellites</td><td>Скорость</td><td>Угол</td><td>gps_state</td><td>mcc</td><td>mnc</td>
        <td>lac</td><td>cellid</td><td>state_acc</td><td>state_power</td><td>state_gps</td><td>state_oil</td><td>vin</td><td>gsm</td></tr>
<?php
while ($data=mysql_fetch_assoc($fid_query)) { ?>
    <tr style="text-align: center;"><td><?=$data['ID']?></td><td><?=$data['imei']?></td><td><?=$data['DEVICE_ID']?></td><td><?=$data['TIMESTAMP_UTC']?></td><td><?=$data['LATITUDE']?></td><td><?=$data['LONGITUDE']?></td>
        <td><?=$data['SATELLITES']?></td><td><?=$data['SPEED']?></td><td><?=$data['ANGLE']?></td><td><?=$data['GPS_STATE']?></td><td><?=$data['mcc']?></td><td><?=$data['mnc']?></td>
        <td><?=$data['lac']?></td><td><?=$data['cellid']?></td><td><?=$data['state_acc']?></td><td><?=$data['state_power']?></td><td><?=$data['state_gps']?></td><td><?=$data['state_oil']?></td>
        <td><?=$data['vin']?></td><td><?=$data['gsm']?></td>
    </tr>
<?php } ?>
</table>
<?php if (isset($i)) { paging ($pt_num_rows, "&ip=$ipmysql"); } 

}?>
</body></html>
