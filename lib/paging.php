<?php 
function paging ($num_rows, $postfix = "") {
?>
<table style="padding-left: 2%"><tr><td>Страницы: </td>
<?php
    for ($i=0, $a=5, $v=0; $i<$num_rows; $i = $i+$a) 
    {
    $v=($i+$a)/5; 
?>
        <td style="width:10px;"><div><a href="http://<?=$_SERVER['SERVER_NAME']?><?=$_SERVER['SCRIPT_NAME']?>?i=<?=$i?><?=$postfix?>"><?=$v?></a></div></td>
<?php } ?>
</tr></table>
<?php }