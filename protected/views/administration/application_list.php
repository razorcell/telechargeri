<script type="text/javascript">
<!--
$(document).ready(function(){
	$(".home").removeClass("active");
	$(".websites").removeClass("active");
	$(".os").removeClass("active");
	$(".category").removeClass("active");
	$(".section").removeClass("active");
	$(".application").addClass("active");
	$(".appsgrabb").removeClass("active");

	$("#delete_application_div").dialog({//prepare delete dialog
		autoOpen: false, 
		title: "Delete a application", 
		modal: true, 
		width: "640",
		buttons: [{
				text: "Cancel", 
				click: function() {
					$( this ).dialog( "close" );
				}},
				{
					text: "Continue", 
					click: function() {
						var id_application = $("strong.delete_id").html();
						var json = "{"+" \"id_application\" : \""+id_application+"\" }";
						$.ajax({ 
							type : "POST",
							url : "/application_delete",
							data : json,
							success : function(data) {
								var json = $.parseJSON(data);
								if (!json.err) {
									$.jGrowl(json.message, {header: "Deleted", position: "bottom-right"});
									$("#delete_application_div").dialog("close");
								} else {
									alert(json.message);
									$("#delete_application_div").dialog("close");
										}
								}
						});//end of ajax
					}}
				]
	});
	$(".application_delete").live("click",function(event){
		var id_application = $(this).parents("tr.application_row").find("td.id_application").html();
		$(".delete_id").html(id_application);
		$("#delete_application_div").dialog("option", {modal: true}).dialog("open");
		event.preventDefault();
		});
	$(".application_edit").live("click", function(event) {
		var id_application = $(this).parents("tr.application_row").find("td.id_application").html();
		var json = "{"+" \"id_application\" : \""+id_application+"\" }";
		$.ajax({
			type:"POST",
			url:"/application_edit",
			data:json,
			success: function(data){
					var json = $.parseJSON(data);
					if(!json.err){
						$(".edit_id_application").val(json.id_application);
						$(".edit_description_application").html(json.description);
						$("#edit_application_div").dialog("option", {modal: true}).dialog("open");
						event.preventDefault();
					}else{
						alert("Error from server : "+json.message);
					}
				}
			});
	});
	$("#edit_application_div").dialog({//prepare edit dialog
		autoOpen: false, 
		title: "Application edit form", 
		modal: true, 
		width: "640",
	});
	$(".update_application").click(function(){
		var update_id_application = $(".edit_id_application").val();
		var update_description_application = $(".edit_description_application") .val();
				var json = '{';
				json += ' "id_application" : "'+update_id_application+'", ';
				json += ' "description" : "'+update_description_application+'"';
				json +='}';
				$.ajax({ 
					type : "POST",
					url : "/application_update",
					data : json,
					success : function(data) {
						var json = $.parseJSON(data);
						if (!json.err) {
							$(".application_edit_success").show();$(".application_edit_warning").hide();
							$(".application_edit_success").html(json.message);
						} else {
							$(".application_edit_warning").show();$(".application_edit_success").hide();
							$(".application_edit_warning").html(json.message);
								}
						}
				});//end of ajax
	});//end update_application.click()
});

//-->
</script>


<!-- application list -->
<div class="grid_4">
	<div class="da-panel collapsible">
		<div class="da-panel-header">
			<span class="da-panel-title"> <img
				src="<?php echo $this->baseurl; ?>/images/icons/black/16/list.png"
				alt="" />Applications
			</span>
		</div>
		<div class="da-panel-content">
			<table id="da-ex-datatable-numberpaging" class="da-table">
				<thead>
					<tr>
						<th>Id</th>
						<th>Label</th>
						<th>Os</th>
						<th>Category</th>
						<th>Section</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach($application_list as $application){
						$current_id_os = NULL;
						$current_label_category = NULL;
						echo '<tr class="application_row">';
						echo "<td class=\"id_application\">".$application->id_application.'</td>';
						echo "<td>".$application->label_application.'</td>';
						foreach($category_list as $category){
							if($application["id_category"] == $category["id_category"]){
								$current_label_category = $category["label_category"];
								$current_os_id = $category["id_os"];
							}
						}
						foreach($os_list as $os){
							if($os["id_os"] == $current_os_id){
								echo "<td class=\"label_os\">".$os["label_os"].'</td>';
							}
						}
						echo "<td class=\"label_category\">".$current_label_category.'</td>';
						if(!is_null($application["id_section"])){
							foreach($section_list as $section){
								if($section["id_section"] == $application["id_section"]){
									echo "<td class=\"label_section\">".$section["label_section"].'</td>';
								}
							}
						}
						echo "<td class=\"da-icon-column\">";
						echo "<img class=\"application_edit\" style=\"cursor:pointer\" src=".Yii::app()->request->baseUrl."/images/icons/color/pencil.png>&nbsp;&nbsp;";
						echo "<img class=\"application_delete\" style=\"cursor:pointer\" src=".Yii::app()->request->baseUrl."/images/icons/color/cross.png>";
						echo "</td>";
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- edit dialog -->
<div id="edit_application_div" class="no-padding">
	<form id="da-ex-validate1" class="da-form">
		<div class="da-form-inline">
			<div class="da-form-row">
				<label>Id</label>
				<div class="da-form-item">
					<input type="text" name="req1" class="edit_id_application" disabled />
				</div>
			</div>
			<div class="da-form-row">
				<label>Description</label>
				<div class="da-form-item large">
					<span class="formNote">You can edit the description if you don't like some content</span>
					<textarea class="edit_description_application" rows="auto" cols="auto"></textarea>
				</div>
			</div>
			<div class="da-message success application_edit_success"
				hidden="true"></div>
			<div class="da-message warning application_edit_warning"
				hidden="true"></div>
			<div class="da-button-row">
				<span class="da-button green update_application"> <img
					src="<?php echo $this->baseurl; ?>/images/icons/color/pencil.png">&nbsp;&nbsp;Update
				</span>
			</div>
		</div>
	</form>
</div>
<!-- end edit dialog -->
<!-- Delete div -->
<div id="delete_application_div" style="display: none;">
	<blockquote>
		You are about to <strong><font color="#A6D037">DELETE</font> </strong>
		application id : <font color="#A6D037"><strong class="delete_id"></strong>
		</font>,&nbsp;&nbsp;are you sure ?
	</blockquote>
</div>
