<script type="text/javascript">
<!-- Setup the ligbulb after menu title-->
$(document).ready(function(){
	$(".home").removeClass("active");
	$(".websites").removeClass("active");
	$(".appsgrabb").removeClass("active");
	$(".os").removeClass("active");
	$(".category").removeClass("active");
	$(".application").removeClass("active");
	
	$(".section").addClass("active");
	
	//$(".id_os").val(1);
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
		var category_cl = new CanvasLoader('category_canvasloader-container');
		category_cl.setDiameter(20); // default is 40
		category_cl.setDensity(41); // default is 40
		category_cl.setRange(0.5); // default is 1.3
		category_cl.setFPS(24); // default is 24
		//cl.hide(); // Hidden by default
		var edit_category_cl = new CanvasLoader('edit_category_canvasloader-container');
		edit_category_cl.setDiameter(20); // default is 40
		edit_category_cl.setDensity(41); // default is 40
		edit_category_cl.setRange(0.5); // default is 1.3
		edit_category_cl.setFPS(24); // default is 24
		
	$('.id_website').change(function() {//triggers also $('.id_os').trigger('change')
		$(".update_os_warning").hide();
		$('.id_os').removeAttr('disabled');
		$('.id_category').removeAttr('disabled');
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
					var t=setTimeout(function(){cl.hide();$('.id_os').trigger('change');},500);
					
				} else {
					$(".update_os_warning").show();
					$(".update_os_warning").html(json.message);
					var t=setTimeout(function(){cl.hide()},500);
					$('.id_os').attr('disabled', 'disabled');
					$('.id_category').attr('disabled', 'disabled');
						}
				}
		});//end of ajax
		
		});
	$('.id_os').change(function() {
		$(".update_category_warning").hide();
		$('.id_category').removeAttr('disabled');
		category_cl.show();
		var id_os = $(".id_os") .val();
		var json = "{"+" \"id_os\" : \""+id_os+"\" }";
		$.ajax({ 
			type : "POST",
			url : "/administration/update_category_list",
			data : json,
			success : function(data) {
				var json = $.parseJSON(data);
				if (!json.err) {
					var new_category_list = "";
					json.category_list.forEach(function(category){
							new_category_list += "<option value="+category["id_category"]+">"+category["label_category"]+"</option>";
						});
					$(".id_category").html(new_category_list);
					var t=setTimeout(function(){category_cl.hide()},500);
					
				} else {
					$(".update_category_warning").show();
					$(".update_category_warning").html(json.message);
					var t=setTimeout(function(){category_cl.hide()},500);
					$('.id_category').attr('disabled', 'disabled');
						}
				}
		});//end of ajax
		});
	$(".add_section").click(function(){
		var label_section = $(".label_section").val();
		var id_category = $(".id_category").val();
			var pattern = new RegExp("^[a-zA-Z0-9\_\-]{1,30}$")
			if(pattern.test(label_section)){
				var json = '{';
				json += ' "label_section" : "'+label_section+'", ';
				json += ' "id_category" : "'+id_category+'", ';
				json +='}';
				$.ajax({ 
					type : "POST",
					url : "/section_add",
					data : json,
					success : function(data) {
						var json = $.parseJSON(data);
						if (!json.err) {
							$(".section_add_success").show();$(".section_add_error").hide();
							$(".section_add_success").html(json.message);
						} else {
							$(".section_add_error").show();$(".section_add_success").hide();
							$(".section_add_error").html(json.message);
								}
						}
				});//end of ajax
		}else{
			$(".section_add_error").show();$(".section_add_success").hide();
			$(".section_add_error").html("Label value is rong : "+label_section);				
		}//end if pattern
	});//end section_add.click()
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
	$('.edit_id_os').change(function() {
		$(".edit_update_category_warning").hide();
		$('.edit_id_category').removeAttr('disabled');
		edit_category_cl.show();
		var id_os = $(".edit_id_os") .val();
		var json = "{"+" \"id_os\" : \""+id_os+"\" }";
		$.ajax({ 
			type : "POST",
			url : "/administration/update_category_list",
			data : json,
			success : function(data) {
				var json = $.parseJSON(data);
				if (!json.err) {
					var new_category_list = "";
					json.category_list.forEach(function(category){
							new_category_list += "<option value="+category["id_category"]+">"+category["label_category"]+"</option>";
						});
					$(".edit_id_category").html(new_category_list);
					var t=setTimeout(function(){edit_category_cl.hide()},500);
					
				} else {
					$(".edit_update_category_warning").show();
					$(".edit_update_category_warning").html(json.message);
					var t=setTimeout(function(){edit_category_cl.hide()},500);
					$('.edit_id_category').attr('disabled', 'disabled');
						}
				}
		});//end of ajax
		});
	$(".update_section").click(function(){
		var update_id_section = $(".edit_id_section").val();
		var update_id_category = $(".edit_id_category") .val();
		var update_label_section = $(".edit_label_section") .val();
			var pattern = new RegExp("^[a-zA-Z0-9]{1,30}$")
			if(pattern.test(update_label_section)){
				var json = '{';
				json += ' "id_section" : "'+update_id_section+'", ';
				json += ' "label_section" : "'+update_label_section+'", ';
				json += ' "id_category" : "'+update_id_category+'" ';
				json +='}';
				$.ajax({ 
					type : "POST",
					url : "/section_update",
					data : json,
					success : function(data) {
						var json = $.parseJSON(data);
						if (!json.err) {
							$(".section_edit_success").show();$(".section_edit_warning").hide();
							$(".section_edit_success").html(json.message);
						} else {
							$(".section_edit_warning").show();$(".section_edit_success").hide();
							$(".section_edit_warning").html(json.message);
								}
						}
				});//end of ajax
		}else{
			$(".section_edit_warning").show();$(".section_edit_success").hide();
			$(".section_edit_warning").html("Label value is rong : "+update_label_section);				
		}//end if pattern
	});//end update_section.click()

	
	$(".section_edit").live("click", function(event) {
		var id_section = $(this).parents("tr.section_row").find("td.id_section").html();
		var json = "{"+" \"id_section\" : \""+id_section+"\" }";
		$.ajax({
			type:"POST",
			url:"/section_edit",
			data:json,
			success: function(data){
					var json = $.parseJSON(data);
					if(!json.err){
						$(".edit_id_section").val(json.id_section);
						$(".edit_label_section").val(json.label_section);
						$(".edit_id_website").val(json.id_website);
						$(".edit_id_os").val(json.id_os);
						$(".edit_id_category").val(json.id_category);
						$("#edit_section_div").dialog("option", {modal: true}).dialog("open");
						event.preventDefault();
					}else{
						alert("Error from server : "+json.message);
					}
				}
			});
	});
	$("#edit_section_div").dialog({//prepare edit dialog
		autoOpen: false, 
		title: "section edit form", 
		modal: true, 
		width: "640",
	});
	$("#delete_section_div").dialog({//prepare delete dialog
		autoOpen: false, 
		title: "Delete a section", 
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
						var id_section = $("strong.delete_id").html();
						var json = "{"+" \"id_section\" : \""+id_section+"\" }";
						$.ajax({ 
							type : "POST",
							url : "/section_delete",
							data : json,
							success : function(data) {
								var json = $.parseJSON(data);
								if (!json.err) {
									$.jGrowl(json.message, {header: "Deleted", position: "bottom-right"});
									$("#delete_section_div").dialog("close");
								} else {
									alert(json.message);
									$("#delete_section_div").dialog("close");
										}
								}
						});//end of ajax
					}}
				]
	});
	$(".section_delete").live("click",function(event){
		var id_section = $(this).parents("tr.section_row").find("td.id_section").html();
		$(".delete_id").html(id_section);
		$("#delete_section_div").dialog("option", {modal: true}).dialog("open");
		event.preventDefault();
		});
	//$('.label_section').focus(function() {
		$('.id_website').trigger('change');//this one triggers  $('.id_os').trigger('change') look up
		//var t=setTimeout(function(){$('.id_os').trigger('change')},500);
		//});
});
</script>
<!-- add section -->
<div class="grid_4">
	<div class="da-panel collapsible">
		<div class="da-panel-header">
			<span class="da-panel-title"> <img
				src="<?php echo $this->baseurl; ?>/images/icons/black/16/plus_small.png"
				alt="" /> Add a section
			</span>
		</div>
		<div class="da-panel-content">
			<form id="da-ex-validate1" class="da-form">
				<div class="da-form-inline">
					<div class="da-form-row">
						<label>Label</label>
						<div class="da-form-item">
							<span class="formNote">Ex : Agenda / Adbloc / Calculator </span>
							<input type="text" name="req1" class="label_section" />
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
									echo "<option value=".$os->id_os.">".$os->label_os."</option>";
							}?>
							</select>
						</div>
					</div>
					<div class="da-form-row">
						<label>Category<span id="category_canvasloader-container" class="wrapper"></span>
						</label>
						<div class="da-form-item">
							<select class="id_category" name="category">
								<?php foreach($category_list as $category){
									echo "<option value=".$category->id_category.">".$category->label_category."</option>";
							}?>
							</select>
						</div>
					</div>
					<div class="da-message success section_add_success" hidden="true"></div>
					<div class="da-message error section_add_error" hidden="true"></div>
					<div class="da-message error update_os_warning" hidden="true"></div>
					<div class="da-message error update_category_warning" hidden="true"></div>
					<div class="da-button-row">
						<span class="da-button green add_section"> <img
							src="<?php echo $this->baseurl; ?>/images/icons/color/add.png">&nbsp;&nbsp;Add
						</span>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- section list -->
<div class="grid_4">
	<div class="da-panel collapsible">
		<div class="da-panel-header">
			<span class="da-panel-title"> <img
				src="<?php echo $this->baseurl; ?>/images/icons/black/16/list.png"
				alt="" /> Sections
			</span>
		</div>
		<div class="da-panel-content">
			<table id="da-ex-datatable-numberpaging" class="da-table">
				<thead>
					<tr>
						<th>Id</th>
						<th>Label</th>
						<th>Categorie</th>
						<th>Os</th>
						<th>Website</th>


						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach($section_list as $section){
						$current_category_os_id = NULL;
						$current_os_website_id = NULL;
						echo '<tr class="section_row">';
						echo "<td class=\"id_section\">".$section->id_section.'</td>';
						echo "<td>".$section->label_section.'</td>';
						foreach($category_list as $category){
							if($category["id_category"] == $section["id_category"]){
								echo "<td class=\"label_category\">".$category["label_category"]."</td>";
								$current_category_os_id = $category["id_os"];
							}
						}
						foreach($os_list as $os){
							if($os["id_os"] == $current_category_os_id){
								echo "<td>".$os["label_os"].'</td>';
								$current_os_website_id = $os["id_website"];
							}
						}
						foreach($website_list as $website){
							if($website["id_website"] == $current_os_website_id){
								echo "<td>".$website["label_website"].'</td>';
							}
						}
						echo "";
						echo "<td class=\"da-icon-column\">";
						echo "<img class=\"section_edit\" style=\"cursor:pointer\" src=".Yii::app()->request->baseUrl."/images/icons/color/pencil.png>&nbsp;&nbsp;";
						echo "<img class=\"section_delete\" style=\"cursor:pointer\" src=".Yii::app()->request->baseUrl."/images/icons/color/cross.png>";
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
<div id="edit_section_div" class="no-padding">
	<form id="da-ex-validate1" class="da-form">
		<div class="da-form-inline">
			<div class="da-form-row">
				<label>Id</label>
				<div class="da-form-item">
					<input type="text" name="req1" class="edit_id_section" disabled />
				</div>
			</div>
			<div class="da-form-row">
				<label>Label</label>
				<div class="da-form-item">
					<span class="formNote">Ex : Agenda / Adbloc / Calculator </span> <input
						type="text" name="req1" class="edit_label_section" />
				</div>
			</div>
			<div class="da-form-row">
				<label>Website</label>
				<div class="da-form-item">
					<select class="edit_id_website" name="edit_website">
						<?php 
						foreach($website_list as $website){
							echo "<option value=".$website->id_website.">".$website->label_website."</option>";
							}?>
					</select>
				</div>
			</div>
			<div class="da-form-row">
				<label>Os<span id="edit_canvasloader-container" class="wrapper"></span>
				</label>
				<div class="da-form-item">
					<select class="edit_id_os" name="edit_os">
						<?php foreach($os_list as $os){
							echo "<option value=".$os->id_os.">".$os->label_os."</option>";
							}?>
					</select>
				</div>
			</div>
			<div class="da-form-row">
				<label>Category<span id="edit_category_canvasloader-container" class="wrapper"></span>
				</label>
				<div class="da-form-item">
					<select class="edit_id_category" name="edit_category">
						<?php foreach($category_list as $category){
							echo "<option value=".$category->id_category.">".$category->label_category."</option>";
							}?>
					</select>
				</div>
			</div>
			<div class="da-message success section_edit_success" hidden="true"></div>
			<div class="da-message warning section_edit_warning" hidden="true"></div>
			<div class="da-button-row">
				<span class="da-button green update_section"> <img
					src="<?php echo $this->baseurl; ?>/images/icons/color/pencil.png">&nbsp;&nbsp;Update
				</span>
			</div>
		</div>
	</form>
</div>
<!-- end edit dialog -->
<div id="delete_section_div" style="display: none;">
	<blockquote>
		You are about to <strong><font color="#A6D037">DELETE</font> </strong>
		section id : <font color="#A6D037"><strong class="delete_id"></strong>
		</font>,&nbsp;&nbsp;are you sure ?
	</blockquote>
</div>









