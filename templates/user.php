<?php
function __autoload ($class_name) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/'.$class_name.'.php';
}
$dataUrl = "http://".$_SERVER['SERVER_NAME']."/ajax/data.php";
$templatesRequire = $_SERVER['DOCUMENT_ROOT']."/templates/headScriptsStyles.html";
$PageSpeed = new PageSpeed();

// Запускаем  сессию
session_name("Auth");
session_start();

$vars = new sqlvariable();
$sql = new MySQLConnection($vars->sqlservername,$vars->sqluser, $vars->sqlpass, $vars->sqldbname);
// Если сессия не запущена, то отрпавляем на главную
if (!isset($_SESSION['Auth']))     
    {
    header('Location:../../index.php');
    exit;
    } 

$table_users = "users";
$table_trackers = "trackers";

$pattern = '/(\d+)/s';
// Получаем URL страницы
$URL = $_SERVER["REQUEST_URI"];
    
// Разбираем URL и получаем userid
preg_match($pattern, htmlspecialchars($URL), $UserIdFromUrl) or die ("<br>Doesn't work");

?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once $templatesRequire;?>
        <title></title>
    </head>
    <body>
        <?php   
        // Если userid пользоавтеля из сессии и страницы совпадают или это админ, то даём доступ
        if ($_SESSION['Auth']['userid'] === $UserIdFromUrl[1] || $_SESSION['Auth']['user_cat'] == 9){
        ?>        
        <div id="map"></div>
        <script type='text/javascript'>
            var dataUrl = '<?=$dataUrl?>';
            var map = new L.Map('map', {center: new L.LatLng(52.537222222222,103.86861111111), zoom: 13, zoomAnimation: true });
            var yndx = new L.Yandex();
            
            $(document).ready(function(){
                //Скрыть PopUp при загрузке страницы    
                AddTrackerPopUpHide();
                UserOptionsPopUpHide()
            });
            $(document).ready(function()
            {
               $('#AddNewTracker').ajaxForm(
                    {
                        target: "#result",
                        success: function()
                        {
                        $('#result').fadeIn('slow');
                        }
                    });
            });

            $( document ).ready(start(dataUrl));
            $( document ).ready(start2(dataUrl));
        </script>
        <div class="panel panel-primary trackerpanel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-info" style="padding-right: 5px;"></i>Пользователь <?=$UserIdFromUrl[1]?></h3>
            </div>
            <div class="panel-body">
                <div class="btn-group btn-group-sm">
                    <a href="javascript:AddTrackerPopUpShow()" class="btn btn-default"><i class="fa fa-plus"></i></a>
                    <a class="btn btn-default"><i class="fa fa-sort-alpha-asc"></i></a>
                    <a class="btn btn-default"><i class="fa fa-wrench"></i></a>
                    <a class="btn btn-default"><i class="fa fa-sliders"></i></a>
                    <a class="btn btn-default"><i class="fa fa-trash"></i></a>
                </div>
                <div id="content">
                    <div>Трекеры:</div>
                    <div class="trackers">
                        <ul>
                            <li><div><i class="fa fa-car"></i></div><div class="name">Название</div><div><i class="fa fa-check-square-o"></i></div></li>
                            <li><div><i class="fa fa-bicycle"></i></div><div class="name">Название</div><div><i class="fa fa-check-square-o"></i></div></li>
                            <li><div><i class="fa fa-truck"></i></div><div class="name">Название</div><div><i class="fa fa-square-o"></i></div></li>
                            <li><div><i class="fa fa-bus"></i></div><div class="name">Название</div><div><i class="fa fa-square-o"></i></div></li>
                        </ul>
                        
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-primary userpanel">
            <div class="panel-heading">
               <h3 class="panel-title">Аккаунт</h3>
            </div> 
            <div class="panel-body">
                <div id="content">
                    <div class="btn-group btn-group-sm">
                        <a class="btn btn-default" title="Профиль"><i class="fa fa-user"></i></a>
                        <a href="javascript:UserOptionsPopUpShow()" class="btn btn-default" title="Настройки"><i class="fa fa-cogs"></i></a>
                        <a class="btn btn-default" title="Графики"><i class="fa fa-bar-chart"></i></a>
                        <a class="btn btn-default" title="Баланс"><i class="fa fa-rub"></i></a>
                        <a class="btn btn-default" title="Помощь"><i class="fa fa-question"></i></a>
                        <a class="btn btn-default" title="Выйти"><i class="fa fa-sign-out"></i></a>
                    </div>
                </div>
            </div>
        </div>          
<?php
// Ищем userid в базе
$result =  mysql_query("SELECT * FROM $table_users WHERE userid=$UserIdFromUrl[1] LIMIT 1") or die ("<br>Doesn't work");
while ($data=mysql_fetch_assoc($result)){
    $usercat = $data["user_cat"];
    $permits = mysql_query("SELECT * FROM userpermits WHERE permitvalue='$usercat'") or die('');
    $permitsall = mysql_query("SELECT * FROM userpermits") or die('');
    $permitsnum = mysql_num_rows($permitsall);
    $scriptname = $_SERVER['SCRIPT_NAME'];
?>
        <div class="b-popup" id="popup2">
            <div class="b-popup-content">
                <a href="javascript:UserOptionsPopUpHide()" id="closePopup" class="closePopup">X</a>
                <form class="form-horizontal" action="<?=$scriptname?>">  
                    <div class="form-group">
                        <label class="col-sm-3 control-label">ID:</label>
                        <div class="col-sm-9">
                            <p class="form-control-static"><?=$data["userid"]?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Логин:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Идентификатор" value="<?=$data["user_login"]?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Пароль:</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" placeholder="Идентификатор" value="<?=$data["user_password"]?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Телефон:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Идентификатор" aria-describedby="basic-addon1" value="<?=$data["user_phone1"]?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">E-mail:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Идентификатор" aria-describedby="basic-addon1" value="<?=$data["user_email"]?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Адрес:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Идентификатор" aria-describedby="basic-addon1" value="<?=$data["user_address"]?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">ИНН:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Идентификатор" aria-describedby="basic-addon1" value="<?=$data["user_inn"]?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">ОГРН:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Идентификатор" aria-describedby="basic-addon1" value="<?=$data["user_ogrn"]?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Категория:</label>
                        <div class="col-sm-9">
                            <select class="form-control">
<?php while ($permitsdata = mysql_fetch_assoc($permits) AND $permitsalldata = mysql_fetch_assoc($permitsall) AND $i<=$permitsnum) { $i++;?>
                                <option value="<?=$permitsalldata["permitvalue"]?>"><?=$i?></option>
            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Дата регистрации:</label>
                        <div class="col-sm-9">
                            <p class="form-control-static"><?=$data["datereg"]?></p>
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="col-sm-offset-8 col-sm-12">
                          <button type="submit" class="btn btn-default">Изменить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
            
<?php } 

$request = $_REQUEST['AddNewTracker'];

// Делаем запрос в таблицу с трекерами
$resulttrackers =  mysql_query("SELECT * FROM $table_trackers WHERE userid='$UserIdFromUrl[1]' ORDER BY treckerid");
$num = mysql_num_rows($resulttrackers);
if (!isset($request)) {?>    
<form action="http://<?=$_SERVER['SERVER_NAME']?>/operations/addtracker.php">
    <table>
        <input type="text" name="userid" value="<?=$UserIdFromUrl[1]?>" hidden>
        <tr><td>Название трекера:</td><td><input type="text" name="trackername" value=""></td></tr>
        <tr><td>Марка трекера:</td><td><input type="text" name="trackermark" value=""></td></tr>
        <tr><td>IMEI:</td><td><input type="text" name="trackerimei" value=""></td></tr>
        <tr><td><input type="submit" name="AddNewTracker" value="Добавить трекер"></td></tr>
    </table>
        </form>
<?php }
    if ($num>0){
?>
        <h3>Зарегистрированные трекеры</h3>
        <table style="width: 100%; margin: 10px; border: 2px solid black;">
        <tr>
            <td>ID</td>
            <td>Имя</td>
            <td>Марка</td>
            <td>IMEI</td>
        </tr>
<?php 
while ($data=mysql_fetch_assoc($resulttrackers)){?>
        <tr>
            <td><a href="http://<?=$_SERVER['SERVER_NAME']?>/users/<?=$UserIdFromUrl[1]?>/?imei=<?=$data["imei"]?>"><?=$data["treckerid"]?></a></td>
            <td><?=$data["name"]?></td>
            <td><?=$data["mark"]?></td>
            <td><?=$data["imei"]?></td>
        </tr>
<?php } ?>
        </table>
<?php }

else {echo "<br><b>Зарегистрированных трекеров нет</b><br>";}
}

else { echo "Вероятно, это не ваша страница.";}
?>
        <div class="b-popup" id="popup1">
            <div class="b-popup-content">
                <?php  require_once $_SERVER['DOCUMENT_ROOT'].'/forms/addtracker.html';?>
                <script>
                    $(document).ready(function(){
                        $("#userid").val("<?=$UserIdFromUrl[1]?>");
                    });
                </script>
            </div>
        </div>
    </body>
</html>
