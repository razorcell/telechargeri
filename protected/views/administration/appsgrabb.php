<script type="text/javascript">
<!-- Setup the ligbulb after menu title-->
$(document).ready(function(){
	$(".home").removeClass("active");
	$(".websites").removeClass("active");
	$(".appsgrabb").addClass("active");

});
</script>
<h1>Apps</h1>

<div class="grid_4">
	<div class="da-panel scrollable">
		<div class="da-panel-header">
			<span class="da-panel-title"> <img
				src="images/icons/black/16/computer_imac.png" alt="Panel" />
				Scrollable Panel (Works on Touch Devices)
			</span>

		</div>
		<div class="da-panel-content">
			<div class="with-padding">
				<?php echo $global_apps_list;?>
			</div>
		</div>
	</div>
</div>


