<!DOCTYPE html>
<html>
<head>
    <title>Примеры. Ломаные</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Если вы используете API локально, то в URL ресурса необходимо указывать протокол в стандартном виде (http://...)-->
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript" src="jquery.js"></script>
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
    <script>document.write(content)</script>
      
    <script>  
        function show()  
        {  
            $.ajax({  
                url: "time.php",  
                cache: false,  
                success: function(html){  
                    $("#content").html(html);  
                }  
            });  
        }  
      
        $(document).ready(function(){  
            show();  
            setInterval('show()',1000);  
        });  
    </script>  
<div id="map"></div>
</body>
</html>
