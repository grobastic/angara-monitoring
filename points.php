<html><head></head><body>
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/sqlvariable.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/sql.php';

$tablename = "points";
$pointssql = mysql_query("SELECT * FROM $tablename ORDER BY ptid");
?>
<p><a href="http://<?=$_SERVER['SERVER_NAME']?>/index.php">На главную</a></p>
<table style="border: 2px solid black; width: 100%;">
    <tr><td>ID</td><td>IMEI</td><td>ID устройства</td><td>Дата</td><td>Широта</td><td>Долгота</td><td>satellites</td><td>Скорость</td><td>Угол</td><td>gps_state</td><td>mcc</td><td>mnc</td>
        <td>lac</td><td>cellid</td><td>state_acc</td><td>state_power</td><td>state_gps</td><td>state_oil</td><td>vin</td><td>gsm</td></tr>
<?php
while ($data=mysql_fetch_assoc($pointssql)) { ?>
    <tr style="text-align: center;"><td><?=$data['ptid']?></td><td><?=$data['imei']?></td><td><?=$data['device_id']?></td><td><?=$data['timestamp_utc']?></td><td><?=$data['latitude']?></td><td><?=$data['longitude']?></td>
        <td><?=$data['satellites']?></td><td><?=$data['speed']?></td><td><?=$data['angle']?></td><td><?=$data['gps_state']?></td><td><?=$data['mcc']?></td><td><?=$data['mnc']?></td>
        <td><?=$data['lac']?></td><td><?=$data['cellid']?></td><td><?=$data['state_acc']?></td><td><?=$data['state_power']?></td><td><?=$data['state_gps']?></td><td><?=$data['state_oil']?></td>
        <td><?=$data['vin']?></td><td><?=$data['gsm']?></td>
    </tr>
<?php } ?>
</table>
</body></html>
