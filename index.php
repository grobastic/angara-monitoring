<?php 
function __autoload ($class_name) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/'.$class_name.'.php';
}
// Запускаем сессию
$sessionname = "Auth";
session_name($sessionname);
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="ru">
    <head>
        <?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/headScriptsStyles.html"; ?>
    </head>
    <body>
        
<?php 
$permitslvl = $_SESSION[$sessionname]['user_cat'];
$tablename = "users";

$vars = new sqlvariable();
$sql = new MySQLConnection($vars->sqlservername,$vars->sqluser, $vars->sqlpass, $vars->sqldbname);
$MenuMine = new MenuMine('articles', $sessionname, $permitslvl, 1, 0);
$MenuMine->MenuQuery();
?>
        <?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/header_template.html"; ?>
        <div class="main" style="margin-bottom: -80px;">
            <div class="greyline">
                <div class="banners-big front">
                    <div class="maxwidth-banner">
                        <div class="flexslider unstyled flexslider-init flexslider-control-nav flexslider-direction-nav" data-plugin-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;directionNav&quot;: true, &quot;controlNav&quot; :true, &quot;animationLoop&quot;: true, &quot;slideshow&quot;: true, &quot;slideshowSpeed&quot;: 5000, &quot;animationSpeed&quot;: 600, &quot;counts&quot;: [1, 1, 1]}">
                            <div class="flex-viewport" style="overflow: hidden; position: relative;"><ul class="slides items" style="width: 1000%; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);">
                                <li class="item shown current" id="bx_3218110189_482" style="width: 1916px; float: left; display: block; background: url(http://scorp.aspro-demo.ru/upload/iblock/482/4823ab1b2e95465793b37c6b59dd8e07.jpg) 50% 50% no-repeat !important;">
                                    <div class="maxwidth-theme">
                                        <div class="row dark ">
                                            <div class="col-md-6 text">
                                                <div class="inner" style="padding-top: 76px;">
                                                    <div class="title">Спутниковый мониторинг</div>
                                                        <div class="text-block">
                                                            Неограниченное количество GPS-трекеров: носимые трекеры, автомобильные GPS-трекеры, автономные GPS-трекеры. Выберите свой</div>
                                                    <a href="/services/" class="btn btn-default">Узнать больше</a>
                                                    <a href="/services/" class="btn btn-default white">Заказать</a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 img">
                                                <div class="inner">
                                                    <img src="http://scorp.aspro-demo.ru/upload/iblock/828/8288136a871f4d0d6aa69c6de7457c6d.png" alt="Адаптация под фирменный стиль" title="Адаптация под фирменный стиль" draggable="false">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                </ul></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="maxwidth-theme">
                        <div class="col-md-12">
                            <div class="banners-small front">
                                <div class="items row">
                                    <div class="col-md-3 col-sm-6">
                                        <div class="item" id="bx_651765591_487">
                                            <div class="image">
                                                <img src="http://scorp.aspro-demo.ru/upload/iblock/bd7/bd7faa88c62a1bb2e8bc847c8c74936b.png">
                                            </div>
                                            <div class="title" style="padding-top: 33px;">
                                                <a href="/">Низкие цены  и широкий ассортимент</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="item" id="bx_651765591_488">
                                            <div class="image">
                                                <img src="http://scorp.aspro-demo.ru/upload/iblock/a03/a03b6ffb0c5ad2df7cecbf95f71837da.png">
                                            </div>
                                            <div class="title" style="padding-top: 33px;">
                                                <a href="/">Широкая сеть  представительств</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="item" id="bx_651765591_489">
                                            <div class="image">
                                                <img src="http://scorp.aspro-demo.ru/upload/iblock/6c9/6c957dd7991589116a0643aa0b644dfe.png">
                                            </div>
                                            <div class="title" style="padding-top: 33px;">
                                                <a href="/">Весь товар  сертифицирован</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="item" id="bx_651765591_490">
                                            <div class="image">
                                                <img src="http://scorp.aspro-demo.ru/upload/iblock/380/3801add222ded313530f934d013d2929.png">
                                            </div>
                                            <div class="title" style="padding-top: 33px;">
                                                <a href="/">Оперативная доставка и выгрузка товара</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="maxwidth-theme">
                        <div class="col-md-12">
                            <div class="item-views sections teasers front">
                                <div id="bx_incl_area_11_1">
                                    <h3 class="underline">Предоставляемые услуги</h3>
                                    <p>Компания специализируется на оказании широкого спектра услуг как для корпоративных клиентов так и для частных лиц. Профессионализм и ответственность ключевые преимущества нашей компании.</p>
                                </div>
                                <div class="items row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="item noborder" id="bx_1373509569_491" style="height: 230px;">
                                            <div class="image">
                                                <a href="/" class="blink"><img src="http://scorp.aspro-demo.ru/upload/iblock/c1a/c1aaf772f4ddc637cfe6669853cd1777.jpg" alt="Установка GPS-трекеров" title="Установка GPS-трекеров" class="img-responsive" style="opacity: 1;">
                                                </a>
                                            </div>						
                                            <div class="info">
                                                <div class="title" style="height: 18px;">
                                                    <a href="/">Установка GPS-трекеров</a>
                                                </div>
                                                <div class="text">
                                                    Осуществляется от имени и в интересах лиц, участвующих в деле: сторон, третьих лиц, заявителей и иных заинтересованных лиц.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="item noborder" id="bx_1373509569_492" style="height: 230px;">
                                            <div class="image">
                                                <a href="/" class="blink">
                                                    <img src="http://scorp.aspro-demo.ru/upload/iblock/cc9/cc920b383fcd4df5060ab6f6a217ac0e.png" alt="Сервисное обслуживание" title="Сервисное обслуживание" class="img-responsive">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <div class="title" style="height: 18px;">
                                                    <a href="/">Сервисное обслуживание</a>
                                                </div>
                                                <div class="text">
                                                    Частичная или полная передача работ по поддержке, обслуживанию и модернизации ИТ-инфраструктуры в руки компаний.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="item noborder" id="bx_1373509569_493" style="height: 230px;">
                                            <div class="image">
                                                <a href="/" class="blink">
                                                    <img src="http://scorp.aspro-demo.ru/upload/iblock/023/0230db91bad4faca43bf9dfa9a8d9452.jpg" alt="Спутниковый мониторинг" title="Спутниковый мониторинг" class="img-responsive" style="opacity: 1;">
                                                </a>
                                            </div>						
                                            <div class="info">
                                                <div class="title" style="height: 18px;">
                                                    <a href="/">
                                                        Спутниковый мониторинг
                                                    </a>
                                                </div>
                                                <div class="text">
                                                    Веб-разработчик знает, что впервые его. Значительно различается при оценке качества восприятия макета.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="item noborder" id="bx_1373509569_494" style="height: 230px;">
                                            <div class="image">
                                                <a href="/" class="blink">
                                                    <img src="http://scorp.aspro-demo.ru/upload/iblock/ffd/ffd658951f111c7073b15acb03dfd1a2.jpg" alt="Сотрудничество по установке" title="Сотрудничество по установке" class="img-responsive">
                                                </a>
                                            </div>					
                                            <div class="info">
                                                <div class="title" style="height: 18px;">
                                                    <a href="/">
                                                        Сотрудничество по установке
                                                    </a>
                                                </div>
                                                <div class="text">
                                                    Все аспекты, связанные с определением, достижением и поддержанием конфиденциальности, целостности информации.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="item noborder" id="bx_1373509569_495" style="height: 230px;">
                                            <div class="image">
                                                <a href="/" class="blink">
                                                    <img src="http://scorp.aspro-demo.ru/upload/iblock/828/828185eedd337e500d5947df5ed4c780.jpg" alt="Тестирование и настройка оборудования" title="Тестирование и настройка оборудования" class="img-responsive">
                                                </a>
                                            </div>						
                                            <div class="info">
                                                <div class="title" style="height: 18px;">
                                                    <a href="/">
                                                        Тестирование и настройка оборудования
                                                    </a>
                                                </div>
                                                <div class="text">
                                                    Проверка финансово-экономической деятельности организации, проводимая аудитором.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="item noborder" id="bx_1373509569_496" style="height: 230px;">
                                            <div class="image">
                                                <a href="/" class="blink">
                                                    <img src="http://scorp.aspro-demo.ru/upload/iblock/9b4/9b45eb076468e2fe6c083a05fd70c233.jpg" alt="Носимые GPS-трекеры" title="Носимые GPS-трекеры" class="img-responsive">
                                                </a>
                                            </div>						
                                            <div class="info">
                                                <div class="title" style="height: 18px;">
                                                    <a href="/">
                                                        Носимые GPS-трекеры
                                                    </a>	
                                                </div>
                                                <div class="text">
                                                    Выполнение специального аудиторского задания по рассмотрению бухгалтерских и налоговых отчетов экономического субъекта.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="maxwidth-theme">
                        <div class="col-md-12">
                            <div class="styled-block front">
                                <div class="row">
                                    <div class="col-md-9 col-sm-9">
                                        <h2>Консультация по услугам</h2>
                                        <span>Менеджеры компании с радостью ответят на ваши вопросы и произведут расчет стоимости услуг и подготовят индивидуальное коммерческое предложение.</span>
                                    </div>
                                    <div class="col-md-3 col-sm-3" style="height: 76px; line-height: 76px;">
                                        <span class="btn btn-default white btn-lg" data-event="jqm" data-param-id="123" data-name="question">Задать вопрос</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/footer_template.html"; ?>      
    </body>
</html>

