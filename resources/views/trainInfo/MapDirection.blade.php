
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <title>Add a GeoJSON line</title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.52.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.52.0/mapbox-gl.css' rel='stylesheet' />
    {{-- Online JQuery Link --}}
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <style>
        body { margin:0; padding:0; }
        #map { position:absolute; top:0; bottom:0; width:100%; }
    </style>
</head>
<body>

<div id='map' style='width: 100%; height: 60%;'></div>
<div style="margin-top: 40%;">
  <input type="text" id="tNo">
  <input type="button" value="click" id="trainByNumber">
  <!-- <input type="button" value="dummyTest" id="test"> -->
</div>
<script>
  var temp;
  $('#trainByNumber').on('click', function(){
    var coordinateRailway = [];
    var apiKey = 'YOUR_API_KEY_HERE';
    var url = 'https://RAILWAY_SERVER/v2/route/train/';
    $.ajax({
        url  : url+($('#tNo').val())+'/apikey/'+apiKey+'/',
        type : 'GET',
        dataType : 'JSON',
        success : function(response){
            $('#response').text(response.train.number+" - "+response.train.name);
            $.each(response.route, function(key, value){
                var singleCoordinates = [];
                singleCoordinates.push(value.station.lat, value.station.lng);
                coordinateRailway.push(singleCoordinates);
            });
            temp = coordinateRailway;
            console.log(JSON.stringify(temp));
            x();
        }
    });
    // console.log(coordinateRailway);
  });

function x() {
  var coordinates =   [[22.5882216,88.323139],[23.25,87.75],[23.47533785,87.4312527454583],[26.73720775,86.3284822995452],[23.6105991,87.119735],[23.6871297,86.9746587],[23.7421515,86.8171649],[23.7952809,86.4309638],[23.8717293,86.1524866],[23.987738,86.0377584],[23.8903906,85.3150201657408],[24.385588,85.562498606583],[24.7964355,85.0079563],[13.0197618,80.2207713229754],[24.90776,84.1901412],[24.9509656,84.0148733],[25.0415131,83.6086173],[28.62788925,77.1122717940814],[25.1281931,82.8835399],[25.1461346,82.5689952],[25.1643804,82.5043173],[25.377121,81.86711059999999],[25.1919015,81.6126232],[26.4125282,87.1270854],[24.5,81],[24.2565898,80.7639082],[23.8779575,80.4535902],[23.1608938,79.9497702],[23.039731,79.4844499],[22.9467047,79.1980228],[62.6194031,33.4920267],[22.9236049,78.784917],[26.97787545,85.5302366649697],[22.6124961,77.762753],[22.3388828,77.0929933],[21.8205346,76.3568299],[21.4525873,76.3911591],[21.3118839,76.2291992],[21.0472554,75.7880594],[21.0137606,75.5627048],[20.4585,75.0023],[20.2519828,74.4392286],[-29.9589872,30.9838676],[19.8965492,73.8367402],[19.6952545,73.5651436],[19.2431167,73.1403065356846],[-8.5408434,120.0364024],[16.6971936,74.2212636]];

    mapboxgl.accessToken = 'pk.eyJ1Ijoic2NvcnBpb25zYW0iLCJhIjoiY2pyNjltcTFkMDIwOTQzbnN2NWRvZXRzZiJ9.4eP_mVxhpSgfz2muCetqwA';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v9',
        center: [-122.486052, 37.830348],
        zoom: 15
    });

    map.on('load', function () {

        map.addLayer({
            "id": "route",
            "type": "line",
            "source": {
                "type": "geojson",
                "data": {
                    "type": "Feature",
                    "properties": {},
                    "geometry": {
                        "type": "LineString",
                        "coordinates": coordinates
                    }
                }
            },
            "layout": {
                "line-join": "round",
                "line-cap": "round"
            },
            "paint": {
                "line-color": "#888",
                "line-width": 8
            }
        });
    });
}
</script>

</body>
</html>
