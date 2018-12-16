
<div class="jumbotron">
    <h1 class="display-4 text-center">Respond Now!</h1>
    <div class="card" style="">
        <div id="map"></div>
        <br>
        <p class="lead text-center strong">
            Address of the location
        </p>
    </div>
</div>

<!-- <script src="https://apis.mapmyindia.com/advancedmaps/v1/xe9pbe71hd88ovgnyf7ya6wroy1yitsr/map_load?v=01."></script> -->
<style> #map {margin: 0;padding: 0;width: 100%;height: 100%;} </style>
<script>
    // var live_data = 'https://apis.mapmyindia.com/intouch/v1/xe9pbe71hd88ovgnyf7ya6wroy1yitsr/getLiveData';
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                x_coord: position.coords.latitude,
                y_coord: position.coords.longitude
            };
            $.get("https://apis.mapmyindia.com/advancedmaps/v1/xe9pbe71hd88ovgnyf7ya6wroy1yitsr/map_load?v=01.",function()
            {
                // +lat+","+lng
                var map=new MapmyIndia.Map("map",{ center:[x_coord, y_coord],zoomControl: true,hybrid:true });
                L.marker([28.61, 77.23]).addTo(map);
        });
    }

</script>