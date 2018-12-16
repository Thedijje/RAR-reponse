
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="<?=base_url('static/js/general.js');?>"></script>

<script src="https://apis.mapmyindia.com/advancedmaps/v1/xe9pbe71hd88ovgnyf7ya6wroy1yitsr/map_load?v=1.1"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
	<script>
		$(document).on("load",function(){
			setTimeout(function(){
				console.log("dhile hai ssaale");
				$('.no_response_from_here').trigger("click");
			},5000);
		});
		$(document).on("click",".leaving-btn",function(){
			var incident_id = 1;
			var this_device_id = 1;
			var response = $(this).data('leave_time');
			$.ajax({
				url:base_url+'respond/'+incident_id,
				type:'POST',
				dataType: 'json',
                mozSystem: true,
				data:{'response':response},
				success:function(res){
					if(res.success='true'){
						$(".screen-content").html(res.view);
						// render map from MapMyIndia API in html5 content
					}
				}
			});
		});
	</script>
</body>
</html>