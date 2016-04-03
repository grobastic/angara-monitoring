function onEachFeature(feature, layer) {
    // does this feature have a property named popupContent?
    layer.bindPopup(feature.properties.popupContent);
    }
function style(feature) {
    return feature.properties.style;            
    }
function pointToLayer(feature, latlng) {
    var geojsonMarkerOptions = {
            radius: 8,
            fillColor: "#8cceff",
            color: "#0092ff",
            weight: 1,
            opacity: 1,
            fillOpacity: 0.8
            };
var geojsonMarkerOptionsStop = {
            radius: 10,
            fillColor: "#000000",
            color: "#0092ff",
            weight: 1,
            opacity: 1,
            fillOpacity: 0.8
            };
var geojsonMarkerOptionsStart = {
            radius: 10,
            fillColor: "#ffffff",
            color: "#0092ff",
            weight: 1,
            opacity: 1,
            fillOpacity: 0.8
            };
var geojsonMarkerOptionsTimeoutpoint = {
            radius: 8,
            fillColor: "#00ff00",
            color: "#0092ff",
            weight: 1,
            opacity: 1,
            fillOpacity: 0.8
            };
    switch (feature.properties.name) {
        case 'Stoppoint': return L.circleMarker(latlng, geojsonMarkerOptionsStop);
        case 'Startpoint': return L.circleMarker(latlng, geojsonMarkerOptionsStart);
        case 'Timeoutpoint': return L.circleMarker(latlng, geojsonMarkerOptionsTimeoutpoint);
        default: return L.circleMarker(latlng, geojsonMarkerOptions);
    }
}
function start (url) {
    map.addLayer(yndx);
    $.ajax({
	url:url,
	dataType: "json",
        data:'mode=1',
        cache: false,
	success:function(data) {  
            var myLayer = L.geoJson(data, {style: style,onEachFeature: onEachFeature,pointToLayer:pointToLayer }).addTo(map);
            setInterval(function() {map.removeLayer(myLayer);}, 5000);
            }                       
    });
    
}
function start2 (url) {
    setInterval(function() {
        $.ajax({
            url:url,
            data:"mode=1&dateFrom=1" + datepickerFrom + "&dateTo=9999999999999999" + datepickerTo + "&trackerimei=" + trackerimei,
            dataType: "json",
            cache: false,
            success:function(data) {
                var myLayer = L.geoJson(data, {style: style,onEachFeature: onEachFeature,pointToLayer:pointToLayer }).addTo(map);
                setInterval(function() {map.removeLayer(myLayer);}, 5000);
            } 
        });
    }, 5000);
}
//Функция отображения PopUp
    function AddTrackerPopUpShow(){
        $("#popup1").show().focus();
    }
    //Функция скрытия PopUp
    function AddTrackerPopUpHide(){
        $("#popup1").hide();
        $('#AddNewTracker').clearForm();
        $("#result").empty();
    }
    function UserOptionsPopUpShow(){
        $("#popup2").show().focus();
    }
    function UserOptionsPopUpHide(){
        $("#popup2").hide();
        $('#AddNewTracker').clearForm();
        $("#result").empty();
    }