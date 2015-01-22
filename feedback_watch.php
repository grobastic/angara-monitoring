<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/sqlvariable.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/sql.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/paging.php';
$i = $_REQUEST['i'];
$fid_num_rows = mysql_num_rows(mysql_query("SELECT * FROM feedback ORDER BY feedbackid"));
if (!isset($i)) { $fid_query = mysql_query("SELECT * FROM feedback ORDER BY feedbackid"); }
if (isset($i)) { $fid_query = mysql_query("SELECT * FROM feedback ORDER BY feedbackid LIMIT $i,5"); }

?>


<table style="width: 100%;">
<?php
while ($fid_data=mysql_fetch_assoc($fid_query)){?>
    <tr><td style="vertical-align: top;"><?=$fid_data['feedbackid']?></td>
        <td><table style="border: 1px solid black; width: 80%;">
                <tr><td style="width:10%;">Дата:</td><td><?=$fid_data['fid_date']?></td></tr>
                <tr><td>От:</td><td><?=$fid_data['fid_fio']?></td></tr>
                <tr><td>e-mail:</td><td><?=$fid_data['fid_email']?></td></tr>
                <tr><td>Телефон:</td><td><?=$fid_data['fid_phone']?></td></tr>
                <tr><td colspan="2">Сообщение:</td></tr>
                <tr><td colspan="2"><?=$fid_data['fid_text_message']?></td></tr>
                <tr><td>info</td><td><?=$fid_data['fid_browser']?></td></tr>
                <tr><td>IP</td><td><?=$fid_data['fid_user_ip']?></td></tr>
            </table>                
        </td></tr>
<?php } ?>
</table>

<?php 
if (isset($i)) { paging ($fid_num_rows); }
?>



