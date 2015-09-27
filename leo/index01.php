<?php header('Content-Type: text/html; charset=utf-8');
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Примеры. Ломаные</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Если вы используете API локально, то в URL ресурса необходимо указывать протокол в стандартном виде (http://...)-->
	<script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <style>
        html, body, #map {
            width: 100%; height: 100%; padding: 0; margin: 0;
        }
    </style>
</head>
<body>


<script type="text/javascript">
</script>


<script type="text/javascript">
var myMap;

ymaps.ready(init);


function init() {
    // Создаем карту.
    var myMap = new ymaps.Map("map", {
            center: [52.52395, 103.780975],
            zoom: 7
        });

		// таймер
		setInterval(function () {
			
				// удалить все предыдущие объекты
				  myMap.geoObjects.each(function(context) {
						myMap.geoObjects.remove(context);
				  });

				
				$.ajax({
				url:'data.php',
				dataType: "json",
				success:function(data){
				
				
						var myGeoObject = new ymaps.GeoObject({
							// Описываем геометрию геообъекта.
							geometry: {
								type: "LineString",
								coordinates: data
								
							},
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
						myMap.geoObjects.add(myGeoObject)	
					
					
				}
				});
					
			
		}, 2000); // время обновления
		
		
		
	
    }

</script>
		 
	
  
<div id="map"></div>
</body>
</html>
