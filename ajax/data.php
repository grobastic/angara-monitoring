<?php   
// @mode:
// 1 - отправка координат
function __autoload ($class_name) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/'.$class_name.'.php';
}  
$sql1 = new MySQLConnection("217.12.64.42", "DataLoger", "Cthutq62924", "points");
if ($_REQUEST['mode'] == 1) {
    $dateFrom = $_REQUEST['dateFrom']; 
    $dateTo = $_REQUEST['dateTo']; 
    $dateToday = date("Y-m-d");

    $gpsdata = "gpsdata";
    $colorsArray = array("#CC6600","#FF3333","#FF00CC","#6600FF","#33CC66");
       
    $coordinates = array ();
    $timestamp = array ();
    if (!isset($dateFrom) || !isset($dateTo) || $dateFrom == "undefined" || $dateTo == "undefined") {
        $queryWhere = "WHERE Timestamp = '$dateToday'";
    }
    else {
        $queryWhere = "WHERE Timestamp >= '$dateFrom' AND Timestamp <= '$dateTo'";
    }
    $query = mysql_query("SELECT Latitude, Longitude, Timestamp FROM $gpsdata $queryWhere ORDER BY id", $sql1->sql) or die ("Не удается подключиться к базе: ".  mysql_error());
        // Приводим данные из базы данных в ассоциативный массив
	while ($row = mysql_fetch_assoc($query) AND $count <= mysql_num_rows($query)) {
            $currentCoordinates = array();
            $currentCoordinates[] = $row["Longitude"];
            $currentCoordinates[] = $row["Latitude"];
            $currentTimestamp = array();
            $currentTimestamp[] = $row["Timestamp"];
            $timestamp[] = $currentTimestamp; // Помещяем время в массив 
            $coordinates[] = $currentCoordinates; // Помещяем широту и долготу в массив с координатами линии маршрута       
	}
        $count = count($coordinates);
        // Удаляем повторяющиеся подряд координаты и время
        for ($i=0; $i<=$count; $i++) {
            if ($coordinates[$i] == $coordinates[$i+1]) {
                unset($coordinates[$i]);
                unset($timestamp[$i]);    
            }
        }  
        $count = count($coordinates);
        $coordinates = array_values($coordinates); // Пересчитываем ключи массива с координатами
        sort($timestamp); // Сортируем массив с данными о времени  
//        echo json_encode($coordinates);
        

        $CoordinatesSlised = array(); //Пустой массив для нарезки координат
        
//        for ($i = 1; $i<=$count; $i++){
//            // Выбираем каждыю N-ю координату и делаем её промежуточной точкой
//            if (!($i % 5)) {
//            $intermedPoint = array(
//                "type" => "Feature",
//                "properties" => array(
//                    "name" => "Intermediary",
//                    "popupContent" => "Промежуточная точка"),
//                "geometry" => array(
//                    "type" => "Point",
//                    "coordinates" => $coordinates[$i]
//                    )
//                );
//            array_push($CoordinatesSlised, $intermedPoint); // Добавляем промежуточную точку в массив
//            }
//        }
 
        $coordinatescount = count($CoordinatesSlised);
        $startPoint = array("type" => "Feature",
            "properties" => array(
            "name" => "Startpoint",
            "popupContent" => "Поехали!"
                ),
            "geometry" => array(
            "type" => "Point",
            "coordinates" => $coordinates[0]
                )
            );
            
        
        for ($i=1; $i<=$count-1; $i++) {
            
            $raznost = strtotime($timestamp[$i][0])-strtotime($timestamp[$i-1][0]); // При каждой интеррации вычитаем прошлое значение из текущего
            //Если разница больше 1800 (30 минут), то происходит выборка данных из массива
            
            if ($raznost>=1800) {
                $color = array_shift($colorsArray);
                $CoordinatesSlised[$coordinatescount] = array (
                    "type" => "Feature", 
                    "properties" => array(
                        "name" => "Line", 
                        "popupContent" => "Маршрут: ".$coordinatescount,
                        "style" => array(
                            "color" => $color, 
                            "weight" => 5,
                            "opacity" => 1
                            )
                        ), 
                    "geometry" => array(
                        "type" => "LineString"
                        )
                    );
                $CoordinatesSlised[$coordinatescount]["geometry"]["coordinates"] = array_slice($coordinates,0,$i); // Выбираем координаты и помещаем в массив
                $coordinatescount++;
                $countforStoppoint = count(array_slice($coordinates,0,$i));
                // Генерируем точку старта
                $CoordinatesSlised[$coordinatescount] = array("type" => "Feature",
                    "properties" => array(
                    "name" => "Timeoutpoint",
                    "popupContent" => "Точка таймаута!"
                    ),
                    "geometry" => array(
                    "type" => "Point",
                    "coordinates" => $CoordinatesSlised[$coordinatescount-1]["geometry"]["coordinates"][0]
                        )
                    ); 
                $coordinatescount++;
                // Генерируем точку финиша
                $CoordinatesSlised[$coordinatescount] = array("type" => "Feature",
                    "properties" => array(
                    "name" => "Timeoutpoint",
                    "popupContent" => "Точка таймаута!"
                    ),
                    "geometry" => array(
                    "type" => "Point",
                    "coordinates" => $CoordinatesSlised[$coordinatescount-2]["geometry"]["coordinates"][$countforStoppoint-1]
                        )
                    ); 
                $coordinatescount++;
                array_splice($coordinates,0,$i); // Удаляем выбранные координаты              
            }
        }
 
        $CoordinatesSlised[$coordinatescount] = array (
                    "type" => "Feature", 
                    "properties" => array(
                        "name" => "Line", 
                        "popupContent" => "Маршрут: ".$coordinatescount,
                        "style" => array(
                            "color" => "#33CC66", 
                            "weight" => 5,
                            "opacity" => 1
                            )
                        ), 
                    "geometry" => array(
                        "type" => "LineString"
                        )
                    );
        $CoordinatesSlised[$coordinatescount]["geometry"]["coordinates"] = $coordinates; // Помещаем оставшиеся данные в массив
        // Генерируем точку финиша
        $stopPoint = array("type" => "Feature",
                    "properties" => array(
                        "name" => "Stoppoint",
                        "popupContent" => "Приехали!"
                        ),
                    "geometry" => array(
                        "type" => "Point",
                        "coordinates" => $CoordinatesSlised[$coordinatescount]['geometry']['coordinates'][count($CoordinatesSlised[$coordinatescount]['geometry']['coordinates'])-1]
                )
            );
        array_push($CoordinatesSlised, $startPoint); // Добавляем точку финиша в массив
        array_push($CoordinatesSlised, $stopPoint); // Добавляем точку финиша в массив
        

//        echo "<pre>";
//        print_r($CoordinatesSlised);
//        echo "</pre>";
//        echo count($CoordinatesSlised);
//        $arrayCount = ""; // Обнуляем счетчик для безопасности
//        $arrayCount = count($coordinates[0]['geometry']['coordinates']); // Пересчитываем количество точек с координатами      
        echo json_encode($CoordinatesSlised);
}