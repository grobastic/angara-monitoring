<?php header('Content-Type: text/html; charset=utf-8');
function __autoload ($class_name) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/'.$class_name.'.php';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
var myMap;

ymaps.ready(init);


function init() {
    // Создаем карту.
       
            var myMap = new ymaps.Map('map', {
                center: [52.52395, 103.780975],
                zoom: 12
            }),
        objectManager = new ymaps.ObjectManager({
            // Мы хотим загружать данные для балуна перед открытием, поэтому
            // запретим автоматически открывать балун по клику.
            geoObjectOpenBalloonOnClick: false
        });
        myMap.geoObjects.add(objectManager);

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
				}).done(function(data) {
            objectManager.add(data);
        });
            objectManager.objects.events.add('click', function (e) {
        var objectId = e.get('objectId');
        if (hasBalloonData(objectId)) {
            objectManager.objects.balloon.open(objectId);
        } else {
            loadBalloonData(objectId).then(function (data) {
                var obj = objectManager.objects.getById(objectId);
                obj.properties.balloonContent = data;
                objectManager.objects.balloon.open(objectId);
            });
        }
    });
					
			
		}, 2000); // время обновления
    }

</script>
    <div id="map"></div>
    </body>
</html>




