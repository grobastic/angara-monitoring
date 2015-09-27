<?php 
function __autoload ($class_name) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/'.$class_name.'.php';
}
$PageSpeed = new PageSpeed();
// Запускаем сессию
$sessionname = "Auth";
session_name($sessionname);
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="ru">
    <head>
        <meta charset="utf-8">   
        <meta http-equiv="content-language" content="ru">
            <script src="js/server.js"></script>
        <link rel="stylesheet" href="http://<?=$_SERVER['SERVER_NAME']?>/css/styles.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="main">
<?php 
$permitslvl = $_SESSION[$sessionname]['user_cat'];
$tablename = "users";

$vars = new sqlvariable();
$sql = new MySQLConnection($vars->sqlservername,$vars->sqluser, $vars->sqlpass, $vars->sqldbname);
$MenuMine = new MenuMine('articles', $sessionname, $permitslvl, 1, 0);
$MenuMine->MenuQuery();
?>
            <header class="topmenu-LIGHT canfixed">
                <div class="logo_and_menu-row">
                    <div class="logo-row row">
                        <div class="maxwidth-theme">
                            <div class="col-md-3 col-sm-4">
                                <div class="logo colored">
                                    <a href="/">
                                        <img src="http://scorp.aspro-demo.ru/logo.png" alt="Аспро: Корпоративный сайт Scorp" title="Аспро: Корпоративный сайт Scorp">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-8 col-xs-12">
                                <div class="top-description col-md-4 hidden-sm hidden-xs">Корпоративный сайт<br> современной компании</div>
                                <div class="top-callback col-md-8">
                                    <div class="callback pull-right hidden-xs"><span href="javascript:;" class="btn btn-default white btn-xs">Заказать звонок</span></div>
                                    <div class="phone pull-right hidden-xs">
                                    <div class="phone-number">
                                        <i class="fa fa-phone"></i>
                                        <div><span style="color: #969ba5;">+7 (999)</span> 765-34-21</div>
                                    </div>
                                </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="menu-row row">
                        <div class="maxwidth-theme">
                            <div class="col-md-12">
                                <div class="nav-main-collapse collapse">
                                    <div clas="menu-only">
                                        <nav class="mega-menu">
                                            <div class="table-menu hidden-xs">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td class=" " style="visibility: visible;">
                                                                <div class="wrap">
                                                                    <a class="" href="/index/" title="Главная">Главная</a>
								</div>
                                                            </td>
                                                            <td class=" " style="visibility: visible;">
                                                                <div class="wrap">
                                                                    <a class="" href="/map/" title="Карта">Карта</a>
								</div>
                                                            </td>
                                                            <td class=" " style="visibility: visible;">
                                                                <div class="wrap">
                                                                    <a class="" href="/prod/" title="Продукция">Продукция</a>
								</div>
                                                            </td>
                                                            <td class=" " style="visibility: visible;">
                                                                <div class="wrap">
                                                                    <a class="" href="/contacts/" title="Контакты">Контакты</a>
								</div>
                                                            </td>
                                                            <td class=" " style="visibility: visible;">
                                                                <div class="wrap">
                                                                    <a class="" href="/about/" title="О компании">О компании</a>
								</div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php //<nav><?=$MenuMine->MenuResult() </nav> ?>
            </header>
            <div class="main">
                <div class="greyline">
                    <div class="banners-big front">
                        <div class="maxwidth-banner">
                            <div class="flexslider unstyled flexslider-init flexslider-control-nav flexslider-direction-nav" data-plugin-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;directionNav&quot;: true, &quot;controlNav&quot; :true, &quot;animationLoop&quot;: true, &quot;slideshow&quot;: true, &quot;slideshowSpeed&quot;: 5000, &quot;animationSpeed&quot;: 600, &quot;counts&quot;: [1, 1, 1]}">
        			<div class="flex-viewport" style="overflow: hidden; position: relative;"><ul class="slides items" style="width: 1000%; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);">
                                    <li class="item shown current" id="bx_3218110189_482" style="width: 1903px; float: left; display: block; background: url(http://scorp.aspro-demo.ru/upload/iblock/482/4823ab1b2e95465793b37c6b59dd8e07.jpg) 50% 50% no-repeat !important;">
                                        <div class="maxwidth-theme">
                                            <div class="row dark ">
                                                <div class="col-md-6 text">
                                                    <div class="inner" style="padding-top: 76px;">
                                                        <div class="title">Адаптация под фирменный стиль</div>
                                                            <div class="text-block">
                                                                Неограниченная палитра цветов, универсальные текстуры и библиотека иконок — выбирайте любую гамму без каких-то усилий, просто изменив пару строк</div>
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
                                                    <a href="/services/audit/nalogovyy-audit/">Низкие цены  и широкий ассортимент</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="item" id="bx_651765591_488">
                                                <div class="image">
                                                    <img src="http://scorp.aspro-demo.ru/upload/iblock/a03/a03b6ffb0c5ad2df7cecbf95f71837da.png">
                                                </div>
                                                <div class="title" style="padding-top: 33px;">
                                                    <a href="/services/audit/auditorskaya-proverka/">Широкая сеть  представительств</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="item" id="bx_651765591_489">
                                                <div class="image">
                                                    <img src="http://scorp.aspro-demo.ru/upload/iblock/6c9/6c957dd7991589116a0643aa0b644dfe.png">
                                                </div>
                                                <div class="title" style="padding-top: 33px;">
                                                    <a href="/services/autsorsing/zashchita-informatsii/">Весь товар  сертифицирован</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="item" id="bx_651765591_490">
                                                <div class="image">
                                                    <img src="http://scorp.aspro-demo.ru/upload/iblock/380/3801add222ded313530f934d013d2929.png">
                                                </div>
                                                <div class="title" style="padding-top: 33px;">
                                                    <a href="/services/autsorsing/soprovozhdenie-1s/">Оперативная доставка и выгрузка товара</a>
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
                                                    <a href="/services/proektirovanie/" class="blink"><img src="http://scorp.aspro-demo.ru/upload/iblock/c1a/c1aaf772f4ddc637cfe6669853cd1777.jpg" alt="Строительство зданий" title="Строительство зданий" class="img-responsive" style="opacity: 1;">
                                                    </a>
                                                </div>						
						<div class="info">
                                                    <div class="title" style="height: 18px;">
                                                        <a href="/services/proektirovanie/">Строительство зданий</a>
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
                                                    <a href="/services/" class="blink">
                                                        <img src="http://scorp.aspro-demo.ru/upload/iblock/cc9/cc920b383fcd4df5060ab6f6a217ac0e.png" alt="Ремонт оборудования" title="Ремонт оборудования" class="img-responsive">
                                                    </a>
                                                </div>
                                                <div class="info">
                                                    <div class="title" style="height: 18px;">
                                                        <a href="/services/">Ремонт оборудования</a>
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
                                                    <a href="/services/proektirovanie/proektirovanie-zdaniy/" class="blink">
                                                        <img src="http://scorp.aspro-demo.ru/upload/iblock/023/0230db91bad4faca43bf9dfa9a8d9452.jpg" alt="Проектирование зданий" title="Проектирование зданий" class="img-responsive" style="opacity: 1;">
                                                    </a>
                                                </div>						
						<div class="info">
                                                    <div class="title" style="height: 18px;">
                                                        <a href="/services/proektirovanie/proektirovanie-zdaniy/">
                                                            Проектирование зданий
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
                                                    <a href="/services/audit/" class="blink">
                                                        <img src="http://scorp.aspro-demo.ru/upload/iblock/ffd/ffd658951f111c7073b15acb03dfd1a2.jpg" alt="Аудит и консалтинг" title="Аудит и консалтинг" class="img-responsive">
                                                    </a>
                                                </div>					
						<div class="info">
                                                    <div class="title" style="height: 18px;">
                                                        <a href="/services/audit/">
                                                            Аудит и консалтинг
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
                                                    <a href="/study/" class="blink">
                                                        <img src="http://scorp.aspro-demo.ru/upload/iblock/828/828185eedd337e500d5947df5ed4c780.jpg" alt="Курсы английского" title="Курсы английского" class="img-responsive">
                                                    </a>
                                                </div>						
						<div class="info">
                                                    <div class="title" style="height: 18px;">
                                                        <a href="/study/">
                                                            Курсы английского
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
                                                    <a href="/study/derevo/" class="blink">
                                                        <img src="http://scorp.aspro-demo.ru/upload/iblock/9b4/9b45eb076468e2fe6c083a05fd70c233.jpg" alt="Школа танцев" title="Школа танцев" class="img-responsive">
                                                    </a>
                                                </div>						
						<div class="info">
                                                    <div class="title" style="height: 18px;">
                                                        <a href="/study/derevo/">
                                                            Школа танцев
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
                                            <span class="btn btn-default btn-lg" data-event="jqm" data-param-id="123" data-name="question">Задать вопрос</span>
                                        </div>
                                    </div>
				</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <footer id="footer" style="margin-top: -171px;">
			<div class="container">
				<div class="row">
					<div class="maxwidth-theme">
						<div class="col-md-3 hidden-sm hidden-xs">
							<div class="copy">
								© 2015 Компания<br>Все права защищены.							</div>
							<div id="bx-composite-banner"></div>
						</div>
						<div class="col-md-9 col-sm-12">
							<div class="row">
								<div class="col-md-9 col-sm-9">
										<div class="bottom-menu">
		<div class="items row">
											<div class="col-md-4 col-sm-6">
					<div class="item">
						<div class="title">
															<a href="/catalog/">Каталог</a>
													</div>
					</div>
				</div>
											<div class="col-md-4 col-sm-6">
					<div class="item">
						<div class="title">
															<a href="/projects/">Проекты</a>
													</div>
					</div>
				</div>
											<div class="col-md-4 col-sm-6">
					<div class="item">
						<div class="title">
															<a href="/services/">Услуги</a>
													</div>
					</div>
				</div>
											<div class="col-md-4 col-sm-6">
					<div class="item">
						<div class="title">
															<a href="/info/news/">Новости</a>
													</div>
					</div>
				</div>
											<div class="col-md-4 col-sm-6">
					<div class="item">
						<div class="title">
															<a href="/info/articles/">Статьи</a>
													</div>
					</div>
				</div>
											<div class="col-md-4 col-sm-6">
					<div class="item">
						<div class="title">
															<a href="/info/faq/">Вопросы и ответы</a>
													</div>
					</div>
				</div>
											<div class="col-md-4 col-sm-6">
					<div class="item">
						<div class="title">
															<a href="/company/vacancy/">Вакансии</a>
													</div>
					</div>
				</div>
											<div class="col-md-4 col-sm-6">
					<div class="item">
						<div class="title">
															<a href="/company/">Компания</a>
													</div>
					</div>
				</div>
											<div class="col-md-4 col-sm-6">
					<div class="item">
						<div class="title">
															<a href="/contacts/">Контакты</a>
													</div>
					</div>
				</div>
					</div>
	</div>
								</div>
								<div class="col-md-3 col-sm-3">
									<div class="info">
										<div class="phone">
											<i class="fa fa-phone"></i> 
											<span style="color: #969ba5;">+7 (999)</span> 765-34-21										</div>
										<div class="email">
											<i class="fa fa-envelope"></i>
											<a href="mailto:info@scorp.aspro-demo.ru">info@aspro.ru</a>										</div>
									</div>
									<div class="social">
										<div class="social-icons">
	<ul>
					<li class="twitter">
				<a href="http://twitter.com/aspro_ru" target="_blank" title="Ссылка на страницу сайта в Twitter">
					Ссылка на страницу сайта в Twitter					<i class="fa fa-twitter"></i>
					<i class="fa fa-twitter hide"></i>
				</a>
			</li>
							<li class="facebook">
				<a href="http://www.facebook.com/aspro74" target="_blank" title="Ссылка на страницу сайта в Facebook">
					Ссылка на страницу сайта в Facebook					<i class="fa fa-facebook"></i>
					<i class="fa fa-facebook hide"></i>
				</a>
			</li>
							<li class="vk">
				<a href="http://vk.com/aspro74" target="_blank" title="Ссылка на страницу сайта в ВКонтакте">
					Ссылка на страницу сайта в ВКонтакте					<i class="fa fa-vk"></i>
					<i class="fa fa-vk hide"></i>
				</a>
			</li>
							<li class="lj">
				<a href="http://youtube.com/" target="_blank" title="Ссылка на страницу сайта в YouTube">
					Ссылка на страницу сайта в YouTube					<i class="fa fa-youtube"></i>
					<i class="fa fa-youtube hide"></i>
				</a>
			</li>
			</ul>
</div>									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-3 hidden-md hidden-lg">
							<div class="copy">
								© 2015 Компания<br>Все права защищены.							</div>
							<div id="bx-composite-banner"></div>
						</div>
					</div>
				</div>
			</div>
		</footer>
            
    </body>
</html>

