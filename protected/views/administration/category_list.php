<script type="text/javascript">
<!-- Setup the ligbulb after menu title-->
$(document).ready(function(){
	$(".home").removeClass("active");
	$(".websites").removeClass("active");
	$(".appsgrabb").removeClass("active");
	$(".os").removeClass("active");
	$(".category").addClass("active");
	
	<!-- This script creates a new CanvasLoader instance and places it in the wrapper div -->
		var cl = new CanvasLoader('canvasloader-container');
		cl.setDiameter(20); // default is 40
		cl.setDensity(41); // default is 40
		cl.setRange(0.5); // default is 1.3
		cl.setFPS(24); // default is 24
		var edit_cl = new CanvasLoader('edit_canvasloader-container');
		edit_cl.setDiameter(20); // default is 40
		edit_cl.setDensity(41); // default is 40
		edit_cl.setRange(0.5); // default is 1.3
		edit_cl.setFPS(24); // default is 24
		//cl.hide(); // Hidden by default
	$('.id_website').change(function() {
		$(".update_os_warning").hide();
		$('.id_os').removeAttr('disabled');
		cl.show();
		var id_website = $(".id_website") .val();
		var json = "{"+" \"id_website\" : \""+id_website+"\" }";
		$.ajax({ 
			type : "POST",
			url : "/administration/update_os_list",
			data : json,
			success : function(data) {
				var json = $.parseJSON(data);
				if (!json.err) {
					var new_os_list = "";
					json.os_list.forEach(function(os){
							new_os_list += "<option value="+os["id_os"]+">"+os["label_os"]+"</option>";
						});
					$(".id_os").html(new_os_list);
					var t=setTimeout(function(){cl.hide()},500);
					
				} else {
					$(".update_os_warning").show();
					$(".update_os_warning").html(json.message);
					var t=setTimeout(function(){cl.hide()},500);
					$('.id_os').attr('disabled', 'disabled');
						}
				}
		});//end of ajax
		});
	$('.edit_id_website').change(function() {
		edit_cl.show();
		var id_website = $(".edit_id_website") .val();
		var json = "{"+" \"id_website\" : \""+id_website+"\" }";
		$.ajax({ 
			type : "POST",
			url : "/administration/update_os_list",
			data : json,
			success : function(data) {
				var json = $.parseJSON(data);
				if (!json.err) {
					var new_os_list = "";
					json.os_list.forEach(function(os){
							new_os_list += "<option value="+os["id_os"]+">"+os["label_os"]+"</option>";
						});
					$(".edit_id_os").html(new_os_list);
					var t=setTimeout(function(){edit_cl.hide()},500);
					
				} else {
					alert("error from server")
						}
				}
		});//end of ajax
		});
	
	$(".add_category").click(function(){
		var label_category = $(".label_category").val();
		var id_website = $(".id_website") .val();
		var id_os = $(".id_os").val();
			var pattern = new RegExp("^[a-zA-Z0-9\_\-]{1,30}$")
			if(pattern.test(label_category)){
				var json = '{';
				json += ' "label_category" : "'+label_category+'", ';
				json += ' "id_os" : "'+id_os+'", ';
				json += ' "id_website" : "'+id_website+'" ';
				json +='}';
				$.ajax({ 
					type : "POST",
					url : "/category_add",
					data : json,
					success : function(data) {
						var json = $.parseJSON(data);
						if (!json.err) {
							$(".category_add_success").show();$(".category_add_error").hide();
							$(".category_add_success").html(json.message);
						} else {
							$(".category_add_error").show();$(".category_add_success").hide();
							$(".category_add_error").html(json.message);
								}
						}
				});//end of ajax
		}else{
			$(".category_add_error").show();$(".category_add_success").hide();
			$(".category_add_error").html("Label value is rong : "+label_category);				
		}//end if pattern
	});//end category_add.click()
	$(".update_category").click(function(){
		var update_id_category = $(".edit_id_category").val();
		var update_label_category = $(".edit_label_category") .val();
		var update_id_website = $(".edit_id_website") .val();
		var update_id_os = $(".edit_id_category").val();
			var pattern = new RegExp("^[a-zA-Z0-9]{1,30}$")
			if(pattern.test(update_label_category)){
				var json = '{';
				json += ' "id_category" : "'+update_id_category+'", ';
				json += ' "id_os" : "'+update_id_os+'", ';
				json += ' "label_category" : "'+update_label_category+'", ';
				json += ' "id_website" : "'+update_id_website+'" ';
				json +='}';
				$.ajax({ 
					type : "POST",
					url : "/category_update",
					data : json,
					success : function(data) {
						var json = $.parseJSON(data);
						if (!json.err) {
							$(".category_edit_success").show();$(".category_edit_warning").hide();
							$(".category_edit_success").html(json.message);
						} else {
							$(".category_edit_warning").show();$(".category_edit_success").hide();
							$(".category_edit_warning").html(json.message);
								}
						}
				});//end of ajax
		}else{
			$(".category_edit_warning").show();$(".category_edit_success").hide();
			$(".category_edit_warning").html("Label value is rong : "+update_label_category);				
		}//end if pattern
	});//end update_category.click()

	
	$(".category_edit").live("click", function(event) {
		var id_category = $(this).parents("tr.category_row").find("td.id_category").html();
		var json = "{"+" \"id_category\" : \""+id_category+"\" }";
		$.ajax({
			type:"POST",
			url:"/category_edit",
			data:json,
			success: function(data){
					var json = $.parseJSON(data);
					if(!json.err){
						$(".edit_id_category").val(json.id_category);
						$(".edit_label_category").val(json.label_category);
						$(".edit_id_website").val(json.id_website);
						$("#edit_category_div").dialog("option", {modal: true}).dialog("open");
						event.preventDefault();
					}else{
						alert("Error from server : "+json.message);
					}
				}
			});
	});
	$("#edit_category_div").dialog({//prepare edit dialog
		autoOpen: false, 
		title: "category edit form", 
		modal: true, 
		width: "640",
	});
	$("#delete_category_div").dialog({//prepare delete dialog
		autoOpen: false, 
		title: "Delete a Category", 
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
						var id_category = $("strong.delete_id").html();
						var json = "{"+" \"id_category\" : \""+id_category+"\" }";
						$.ajax({ 
							type : "POST",
							url : "/category_delete",
							data : json,
							success : function(data) {
								var json = $.parseJSON(data);
								if (!json.err) {
									$.jGrowl(json.message, {header: "Deleted", position: "bottom-right"});
									$("#delete_category_div").dialog("close");
								} else {
									alert(json.message);
									$("#delete_category_div").dialog("close");
										}
								}
						});//end of ajax
					}}
				]
	});
	$(".category_delete").live("click",function(event){
		var id_category = $(this).parents("tr.category_row").find("td.id_category").html();
		$(".delete_id").html(id_category);
		$("#delete_category_div").dialog("option", {modal: true}).dialog("open");
		event.preventDefault();
		});
});
</script>


<!-- add category -->
<div class="grid_4">
	<div class="da-panel collapsible">
		<div class="da-panel-header">
			<span class="da-panel-title"> <img
				src="<?php echo $this->baseurl; ?>/images/icons/black/16/plus_small.png"
				alt="" /> Add a category
			</span>
		</div>
		<div class="da-panel-content">
			<form id="da-ex-validate1" class="da-form">
				<div class="da-form-inline">
					<div class="da-form-row">
						<label>Label</label>
						<div class="da-form-item">
							<span class="formNote">Ex : Windows / Windows7 / Mac </span> <input
								type="text" name="req1" class="label_category" />
						</div>
					</div>
					<div class="da-form-row">
						<label>Website</label>
						<div class="da-form-item">
							<select class="id_website" name="website">
								<?php 
								foreach($website_list as $website){
									echo "<option value=".$website->id_website.">".$website->label_website."</option>";
							}?>
							</select>
						</div>
					</div>
					<div class="da-form-row">
						<label>Os<span id="canvasloader-container" class="wrapper"></span>
						</label>
						<div class="da-form-item">
							<select class="id_os" name="os">
								<?php foreach($os_list as $os){
									if($os["id_website"] == 1){
										echo "<option value=".$os->id_os.">".$os->label_os."</option>";
									}
							}?>
							</select>
						</div>
					</div>
					<div class="da-message success category_add_success" hidden="true"></div>
					<div class="da-message error category_add_error" hidden="true"></div>
					<div class="da-message warning update_os_warning" hidden="true"></div>
					<div class="da-button-row">
						<span class="da-button green add_category"> <img
							src="<?php echo $this->baseurl; ?>/images/icons/color/add.png">&nbsp;&nbsp;Add
						</span>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- category list -->
<div class="grid_4">
	<div class="da-panel collapsible">
		<div class="da-panel-header">
			<span class="da-panel-title"> <img
				src="<?php echo $this->baseurl; ?>/images/icons/black/16/list.png"
				alt="" />Categories
			</span>
		</div>
		<div class="da-panel-content">
			<table id="da-ex-datatable-numberpaging" class="da-table">
				<thead>
					<tr>
						<th>Id</th>
						<th>Label</th>
						<th>Website</th>
						<th>Os</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach($category_list as $category){

						echo '<tr class="category_row">';
						echo "<td class=\"id_category\">".$category->id_category.'</td>';
						echo "<td>".$category->label_category.'</td>';
						foreach($os_list as $os){
							if($os["id_os"] == $category["id_os"]){
								echo "<td>".$os["label_os"].'</td>';
							}
						}
						foreach($website_list as $website){
							if($website["id_website"] == $category["id_website"]){
								echo "<td>".$website["label_website"].'</td>';
							}
						}
						echo "<td class=\"da-icon-column\">";
						echo "<img class=\"category_edit\" style=\"cursor:pointer\" src=".Yii::app()->request->baseUrl."/images/icons/color/pencil.png>&nbsp;&nbsp;";
						echo "<img class=\"category_delete\" style=\"cursor:pointer\" src=".Yii::app()->request->baseUrl."/images/icons/color/cross.png>";
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
<div id="edit_category_div" class="no-padding">
	<form id="da-ex-validate1" class="da-form">
		<div class="da-form-inline">
			<div class="da-form-row">
				<label>Id</label>
				<div class="da-form-item">
					<input type="text" name="req1" class="edit_id_category" disabled />
				</div>
			</div>
			<div class="da-form-row">
				<label>Label</label>
				<div class="da-form-item">
					<span class="formNote">Ex : Windows / Windows7 / Mac </span> <input
						type="text" name="req1" class="edit_label_category" />
				</div>
			</div>
			<div class="da-form-row">
				<label>website</label>
				<div class="da-form-item">
					<select class="edit_id_website" name="website">
						<?php foreach($website_list as $website){
							echo "<option value=".$website->id_website.">".$website->label_website."</option>";
							}?>
					</select>
				</div>
			</div>
			<div class="da-form-row">
				<label>Os<span id="edit_canvasloader-container" class="wrapper"></span></label>
				<div class="da-form-item">
					<select class="edit_id_os" name="os">
						<?php foreach($os_list as $os){
							echo "<option value=".$os->id_os.">".$os->label_os."</option>";
							}?>
					</select>
				</div>
			</div>
			<div class="da-message success category_edit_success" hidden="true"></div>
			<div class="da-message warning category_edit_warning" hidden="true"></div>
			<div class="da-button-row">
				<span class="da-button green update_category"> <img
					src="<?php echo $this->baseurl; ?>/images/icons/color/pencil.png">&nbsp;&nbsp;Update
				</span>
			</div>
		</div>
	</form>
</div>
<!-- end edit dialog -->
<div id="delete_category_div" style="display: none;">
	<blockquote>
		You are about to <strong><font color="#A6D037">DELETE</font> </strong>
		category id : <font color="#A6D037"><strong class="delete_id"></strong>
		</font>,&nbsp;&nbsp;are you sure ?
	</blockquote>
</div>









