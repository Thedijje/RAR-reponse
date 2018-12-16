
<div class="jumbotron">
    <h1 class="display-4 text-center">Respond Now!</h1>
    <div class="card" style="height:400px;">
        <h2 class="text-center  distance-map"></h2>
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
    var src = new L.LatLng(my_lat, my_lon); /*WGS location object*/
    map.setView(src, 12); /*function that modifies both center map position and zoom leveL.*/
    L.marker(src).addTo(map);
    var dest = new L.LatLng(lat_to_go, lon_to_go); /*WGS location object*/
    L.marker(dest).addTo(map);
    // console.log(pts);
    $.ajax({
        data:{my_lat:my_lat,my_lon:my_lon,dest_lat:lat_to_go,dest_lon:lon_to_go},
        type:'POST',
        dataType:'json',
        url:base_url+'get_route',
        success:function(res){
            
            var pts = []; 
            var advice = res.results.trips[0].advices;
            console.log(advice[0].pt);
            $.each(advice,function(){
                pts.push(this.pt);
            // console.log(this.pt);
            });
            var polylineParam = 
                { 
                weight: 4, // The thickness of the polyline 
                opacity: 0.8 //The opacity of the polyline colour 
                };
            var poly = new L.Polyline(pts, polylineParam);
            map.addLayer(poly);
        },
        failure:function(){}

    });


    $.ajax({
        data:{my_lat:my_lat,my_lon:my_lon,dest_lat:lat_to_go,dest_lon:lon_to_go},
        type:'POST',
        dataType:'json',
        url:base_url+'get_distance',
        success:function(res){
            
            // var pts = []; 
            // var advice = res.results.trips[0].advices;
            console.log(res.results[1].duration);
            var time = res.results[1].duration;
            secondsToHms = secondsToHms(time);
            // alert();
            $(".distance-map").html('<i class="fa fa-clock-o fa-fw fa-icon"></i>Approx. <strong>'+ secondsToHms + '</strong> to destination');
            
        },
        failure:function(){}

    });

    

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

function secondsToHms(d) {
    d = Number(d);
    var h = Math.floor(d / 3600);
    var m = Math.floor(d % 3600 / 60);
    var s = Math.floor(d % 3600 % 60);

    var hDisplay = h > 0 ? h + (h == 1 ? " : " : " : ") : "";
    var mDisplay = m > 0 ? m + (m == 1 ? " " : " ") : "";
    return hDisplay + mDisplay ; 
}
</script>