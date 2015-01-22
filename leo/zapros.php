<?php
function __autoload ($class_name) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/'.$class_name.'.php';
}
$PageSpeed = new PageSpeed();

$ipmysql = $_REQUEST['ip']; 
if (!isset($ipmysql) || $ipmysql == FALSE) { ?>
        <form action="<?=$_SERVER['SCRIPT_NAME']?>">
            <p>Введите IP сервера MySQL:</p><input type="text" name="ip">
            <input type="submit" value="Ready">
        </form>
<?php   
 exit();
}
if ($ipmysql = "localhost") {

$vars = new sqlvariable();

$tablename = "gpsdata";
$scriptname = $_SERVER['SCRIPT_NAME'];
$request = $_REQUEST['NewUser'];

  $i= mysql_query("SELECT LATITUDE, LONGITUDE FROM $tablename ORDER BY ID");
 
      
?>
<!DOCTYPE html>
<html>
<head>
    <title>Примеры. Ломаные</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Если вы используете API локально, то в URL ресурса необходимо указывать протокол в стандартном виде (http://...)-->
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>

    <style>
        html, body, #map {
            width: 100%; height: 100%; padding: 0; margin: 0;
        }
    </style>

<script type="text/javascript">
ymaps.ready(init);
function init() {
    // Создаем карту.
    var myMap = new ymaps.Map("map", {
            center: [52.52395, 103.780975],
            zoom: 10
        });

    // Создаем ломаную, используя класс GeoObject.
    var myGeoObject = new ymaps.GeoObject({
            // Описываем геометрию геообъекта.
            geometry: {
                // Тип геометрии - "Ломаная линия".
                type: "LineString",
                // Указываем координаты вершин ломаной.
                coordinates: [ 
<?php    while ($row = mysql_fetch_assoc($i)) {$Latitude = json_encode($row["LATITUDE"]).",";
    $Longitude = json_encode($row["LONGITUDE"]);
    echo "[".$Latitude." ".$Longitude."], ";
  }   
?>
                    ]
            },
            // Описываем свойства геообъекта.
            properties:{
                // Содержимое хинта.
                hintContent: "Я геообъект",
                // Содержимое балуна.
                balloonContent: "Маршрут"
            }
        }, {
            // Задаем опции геообъекта.
            // Включаем возможность перетаскивания ломаной.
            draggable: false,
            // Цвет линии.
            strokeColor: "#FFFF00",
            // Ширина линии.
            strokeWidth: 5
        });

        // Добавляем линии на карту.
    myMap.geoObjects
        .add(myGeoObject)
    }

</script>
</head>
<body>
<div id="map"></div>
</body>
</html>
<?php }    
else {
$sqlservername = $ipmysql;
$sqluser = "angara";
$sqlpass = "Cthutq62924";
$sqldbname = "points";

$tablename = "gpsdata";

$sql = new MySQLConnection($sqlservername,$sqluser, $sqlpass, $sqldbname);


$scriptname = $_SERVER['SCRIPT_NAME'];
$request = $_REQUEST['NewUser'];

  $i= mysql_query("SELECT LATITUDE, LONGITUDE FROM $tablename ORDER BY ID");
 
      
?>
<!DOCTYPE html>
<html>
<head>
    <title>Примеры. Ломаные</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Если вы используете API локально, то в URL ресурса необходимо указывать протокол в стандартном виде (http://...)-->
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>

    <style>
        html, body, #map {
            width: 100%; height: 100%; padding: 0; margin: 0;
        }
    </style>

<script type="text/javascript">
ymaps.ready(init);
function init() {
    // Создаем карту.
    var myMap = new ymaps.Map("map", {
            center: [52.52395, 103.780975],
            zoom: 10
        });

    // Создаем ломаную, используя класс GeoObject.
    var myGeoObject = new ymaps.GeoObject({
            // Описываем геометрию геообъекта.
            geometry: {
                // Тип геометрии - "Ломаная линия".
                type: "LineString",
                // Указываем координаты вершин ломаной.
                coordinates: [ 
<?php    while ($row = mysql_fetch_assoc($i)) {$Latitude = json_encode($row["LATITUDE"]).",";
    $Longitude = json_encode($row["LONGITUDE"]);
    echo "[".$Latitude." ".$Longitude."], ";
  }   
?>
                    ]
            },
            // Описываем свойства геообъекта.
            properties:{
                // Содержимое хинта.
                hintContent: "Я геообъект",
                // Содержимое балуна.
                balloonContent: "Маршрут"
            }
        }, {
            // Задаем опции геообъекта.
            // Включаем возможность перетаскивания ломаной.
            draggable: false,
            // Цвет линии.
            strokeColor: "#FFFF00",
            // Ширина линии.
            strokeWidth: 5
        });

        // Добавляем линии на карту.
    myMap.geoObjects
        .add(myGeoObject)
    }

</script>
</head>
<body>
<div id="map"></div>
</body>
</html>
<?php }?>
