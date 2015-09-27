<?php
// Запускаем  сессию
session_name("Auth");
session_start();
$dataUrl = "http://".$_SERVER['SERVER_NAME']."/ajax/data.php";
$templatesRequire = $_SERVER['DOCUMENT_ROOT']."/templates/headScriptsStyles.html";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */ ?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once $templatesRequire;?>
        <script>
            $(function() {
                $( ".panel" ).draggable();
              });
            $(function() {
                $( "#from" ).datepicker({
                    defaultDate: 0,
                    nextText: "Позже",
                    changeMonth: true,
                    changeYear: true,
                    firstDay: 1,
                    maxDate: 0,
                    dateFormat: "yy-mm-dd",
                    numberOfMonths: 1,
                    onClose: function( selectedDate ) {
                        var datefrom = $( "#to" ).datepicker( "option", "minDate", selectedDate );
                        $( "#to" ).datepicker( "option", "minDate", selectedDate );
                    }
                });
                $( "#to" ).datepicker({
                  defaultDate: 0,
                  changeMonth: true,
                  changeYear: true,
                  dateFormat: "yy-mm-dd",
                  maxDate: 0,
                  firstDay: 1,
                  numberOfMonths: 1,
                  onClose: function( selectedDate ) {
                    $( "#from" ).datepicker( "option", "maxDate", selectedDate );
                  }
                });
              });
              var datepickerFrom;
              var datepickerTo;
              	function datepickerFrom_value(o){
                    datepickerFrom = o.value;
                    datepickerFrom = datepickerFrom + " 00:00:01";
                }
              	function datepickerTo_value(o){
                    datepickerTo = o.value;
                    datepickerTo = datepickerTo + " 23:59:59";
                }
        </script>
    </head>
    <body>
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
        <div class="panel panel-primary datepicker">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-info" style="padding-right: 5px;"></i>Календарь</h3>
            </div>
            <div class="panel-body">
                <div id="content">
                    <div><input type="text" id="from" name="from" onchange="datepickerFrom_value(this);" size="7" placeholder="Начало" readonly></div>
                    <div><input type="text" id="to" name="to" onchange="datepickerTo_value(this);" size="7" placeholder="Конец"  readonly></div>
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
        <div class="b-popup" id="popup2">
            <div class="b-popup-content">
                <a href="javascript:UserOptionsPopUpHide()" id="closePopup" class="closePopup">X</a>
                <form class="form-horizontal" action="<?=$scriptname?>">  
                    <div class="form-group">
                        <label class="col-sm-3 control-label">ID:</label>
                        <div class="col-sm-9">
                            <p class="form-control-static">1</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Логин:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="admin" value="" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Пароль:</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" placeholder="kakoitopassword" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Телефон:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="+7894557654324" aria-describedby="basic-addon1" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">E-mail:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="angara@gmail.com" aria-describedby="basic-addon1" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Адрес:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="г. Иркутск, Лермонтова, 345/5" aria-describedby="basic-addon1" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">ИНН:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="4654657624" aria-describedby="basic-addon1" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">ОГРН:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="795646132487889" aria-describedby="basic-addon1" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Категория:</label>
                        <div class="col-sm-9">
                            <select class="form-control">
                                <option value="">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Дата регистрации:</label>
                        <div class="col-sm-9">
                            <p class="form-control-static"><?php echo date("d.m.Y В G:i:s"); ?></p>
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
    </body>
</html>

