
<div class="jumbotron">
    <h1 class="display-4 text-center">Respond Now!</h1>
    <div class="card" style="height:400px;">
    
        <div id="map"></div>
        
    </div>
</div>

<style> html, body, #map {margin: 0;padding: 0;width: 100%;height: 100%;} </style>

<script>

var x = document.getElementById("demo");
var x_coord = '';
function getLocation() {
    var y_coord = '';
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            render_map(position);
            x_coord =  position;
            x_coord =  position.coords.longitude;
            console.log( "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude);
        });
    } else { 
            console.log( "Geolocation is not supported by this browser.");
    }
  return x_coord;
}
function render_map(position) {
    my_lat = position.coords.latitude;
    my_lon = position.coords.longitude;

    lat_to_go = '<?=$lat_to_go;?>';
    lon_to_go = '<?=$lon_to_go;?>';

    var pts = [new L.LatLng(my_lat, my_lon), /*WGS location object*/
            new L.LatLng(lat_to_go, lon_to_go)]; /*WGS location object*/
    // var pt = new L.LatLng(28.549948, 77.268241); /*WGS location object*/
    // map.setView(pt, 12); /*function that modifies both center map position and zoom leveL.*/
    console.log(pts);
    $.ajax({
        data:{my_lat:my_lat,my_lon:my_lon,dest_lat:lat_to_go,dest_lon:lon_to_go},
        type:'POST',
        dataType:'json',
        url:base_url+'get_route',
        success:function(res){
            // console.log(res.response);
            // var pts = [ 
            //     new L.LatLng(center.lat - 150 / 10000, center.lng - 150 / 10000),
            //     new L.LatLng(center.lat + 0 / 10000, center.lng - 50 / 10000),
            //     new L.LatLng(center.lat + 50 / 10000, center.lng - 100 / 10000),
            //     new L.LatLng(center.lat + 70 / 10000, center.lng + 50 / 10000),
            //     new L.LatLng(center.lat - 70 / 10000, center.lng + 100 / 10000) 
            // ];
            // var advice
            var polylineParam = 
                { 
                weight: 4, // The thickness of the polyline 
                opacity: 0.5 //The opacity of the polyline colour 
                };
            var poly = new L.Polyline(pts, polylineParam);
            map.addLayer(poly);
        },
        failure:function(){}

    });
    // L.marker(pts).addTo(map);

    // $("#mov_center").click(function() {
    // });
}
$().ready(function(){
    x_coord = '<?=$x_coord?>';
    y_coord = '<?=$y_coord?>';
    var position = getLocation();
    
    // console.log(position);
    // Window.map = L.Map('map');
    window.map = new MapmyIndia.Map("map",{ center:[x_coord, y_coord],zoomControl: true,hybrid:true });

    // $.get("http://apis.mapmyindia.com/advancedmaps/v1//still_image?center=28.595939499830784,77.22556114196777",function(){

    // });
});
</script>