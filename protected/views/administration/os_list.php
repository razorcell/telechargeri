<script type="text/javascript">
<!-- Setup the ligbulb after menu title-->
$(document).ready(function(){
	$(".home").removeClass("active");
	$(".websites").removeClass("active");
	$(".appsgrabb").removeClass("active");
	$(".os").addClass("active");
	$(".add_os").click(function(){
		var label_os = $(".label_os") .val();
		var id_website = $(".id_website") .val();
			var pattern = new RegExp("^[a-zA-Z0-9]{1,30}$")
			if(pattern.test(label_os)){
				var json = '{';
				json += ' "label_os" : "'+label_os+'", ';
				json += ' "id_website" : "'+id_website+'" ';
				json +='}';
				$.ajax({ 
					type : "POST",
					url : "/os_add",
					data : json,
					success : function(data) {
						var json = $.parseJSON(data);
						if (!json.err) {
							$(".os_add_success").show();$(".os_add_error").hide();
							$(".os_add_success").html(json.message);
						} else {
							$(".os_add_error").show();$(".os_add_success").hide();
							$(".os_add_error").html(json.message);
								}
						}
				});//end of ajax
		}else{
			$(".os_add_error").show();$(".os_add_success").hide();
			$(".os_add_error").html("Label value is rong : "+label_os);				
		}//end if pattern
	});//end os_add.click()
	$(".update_os").click(function(){
		var update_id_os = $(".edit_id_os").val();
		var update_label_os = $(".edit_label_os") .val();
		var update_id_website = $(".edit_id_website") .val();
			var pattern = new RegExp("^[a-zA-Z0-9]{1,30}$")
			if(pattern.test(update_label_os)){
				var json = '{';
				json += ' "id_os" : "'+update_id_os+'", ';
				json += ' "label_os" : "'+update_label_os+'", ';
				json += ' "id_website" : "'+update_id_website+'" ';
				json +='}';
				$.ajax({ 
					type : "POST",
					url : "/os_update",
					data : json,
					success : function(data) {
						var json = $.parseJSON(data);
						if (!json.err) {
							$(".os_edit_success").show();$(".os_edit_warning").hide();
							$(".os_edit_success").html(json.message);
						} else {
							$(".os_edit_warning").show();$(".os_edit_success").hide();
							$(".os_edit_warning").html(json.message);
								}
						}
				});//end of ajax
		}else{
			$(".os_edit_warning").show();$(".os_edit_success").hide();
			$(".os_edit_warning").html("Label value is rong : "+update_label_os);				
		}//end if pattern
	});//end update_os.click()

	
	$(".os_edit").live("click", function(event) {
		var id_os = $(this).parents("tr.os_row").find("td.id_os").html();
		var json = "{"+" \"id_os\" : \""+id_os+"\" }";
		$.ajax({
			type:"POST",
			url:"/os_edit",
			data:json,
			success: function(data){
					var json = $.parseJSON(data);
					if(!json.err){
						$(".edit_id_os").val(json.id_os);
						$(".edit_label_os").val(json.label_os);
						$(".edit_id_website").val(json.id_website);
						$("#edit_os_div").dialog("option", {modal: true}).dialog("open");
						event.preventDefault();
					}else{
						alert("Error from server : "+json.message);
					}
				}
			});
	});
	$("#edit_os_div").dialog({//prepare edit dialog
		autoOpen: false, 
		title: "os edit form", 
		modal: true, 
		width: "640",
	});
	$("#delete_os_div").dialog({//prepare delete dialog
		autoOpen: false, 
		title: "Delete an Operating system", 
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
						var id_os = $("strong.delete_id").html();
						var json = "{"+" \"id_os\" : \""+id_os+"\" }";
						$.ajax({ 
							type : "POST",
							url : "/os_delete",
							data : json,
							success : function(data) {
								var json = $.parseJSON(data);
								if (!json.err) {
									$.jGrowl(json.message, {header: "Deleted", position: "bottom-right"});
									$("#delete_os_div").dialog("close");
								} else {
									alert(json.message);
									$("#delete_os_div").dialog("close");
										}
								}
						});//end of ajax
					}}
				]
	});
	$(".os_delete").live("click",function(event){
		var id_os = $(this).parents("tr.os_row").find("td.id_os").html();
		$(".delete_id").html(id_os);
		$("#delete_os_div").dialog("option", {modal: true}).dialog("open");
		event.preventDefault();
		});
});
</script>


<!-- add OS -->
<div class="grid_4">
	<div class="da-panel collapsible">
		<div class="da-panel-header">
			<span class="da-panel-title"> <img
				src="<?php echo $this->baseurl; ?>/images/icons/black/16/plus_small.png"
				alt="" /> Add a os
			</span>
		</div>
		<div class="da-panel-content">
			<form id="da-ex-validate1" class="da-form">
				<div class="da-form-inline">
					<div class="da-form-row">
						<label>Label</label>
						<div class="da-form-item">
							<span class="formNote">Ex : Windows / Windows7 / Mac
								</span> <input type="text" name="req1"
								class="label_os" />
						</div>
					</div>
					<div class="da-form-row">
						<label>website</label>
						<div class="da-form-item">
							<select class="id_website" name="website">
								<?php foreach($website_list as $website){
									echo "<option value=".$website->id_website.">".$website->label_website."</option>";
							}?>
							</select>
						</div>
					</div>
					<div class="da-message success os_add_success" hidden="true"></div>
					<div class="da-message error os_add_error" hidden="true"></div>
					<div class="da-button-row">
						<span class="da-button green add_os"> <img
							src="<?php echo $this->baseurl; ?>/images/icons/color/add.png">&nbsp;&nbsp;Add
						</span>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- OS list -->
<div class="grid_4">
	<div class="da-panel collapsible">
		<div class="da-panel-header">
			<span class="da-panel-title"> <img
				src="<?php echo $this->baseurl; ?>/images/icons/black/16/list.png"
				alt="" /> Operationg systems
			</span>
		</div>
		<div class="da-panel-content">
			<table id="da-ex-datatable-numberpaging" class="da-table">
				<thead>
					<tr>
						<th>Id</th>
						<th>Label</th>
						<th>website</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach($os_list as $os){
						$id = $os->id_os;
						echo '<tr class="os_row">';
						echo "<td class=\"id_os\">".$os->id_os.'</td>';
						echo "<td>".$os->label_os.'</td>';
						foreach($website_list as $website){
							if($website["id_website"] == $os["id_website"]){
								echo "<td>".$website["label_website"].'</td>';
							}
						}
						echo "<td class=\"da-icon-column\">";
						echo "<img class=\"os_edit\" style=\"cursor:pointer\" src=".Yii::app()->request->baseUrl."/images/icons/color/pencil.png>&nbsp;&nbsp;";
						echo "<img class=\"os_delete\" style=\"cursor:pointer\" src=".Yii::app()->request->baseUrl."/images/icons/color/cross.png>";
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
<div id="edit_os_div" class="no-padding">
	<form id="da-ex-validate1" class="da-form">
		<div class="da-form-inline">
			<div class="da-form-row">
				<label>Id</label>
				<div class="da-form-item">
					<input type="text" name="req1" class="edit_id_os" disabled />
				</div>
			</div>
			<div class="da-form-row">
				<label>Label</label>
				<div class="da-form-item">
					<span class="formNote">Ex : Windows / Windows7 / Mac
						</span> <input type="text" name="req1"
						class="edit_label_os" />
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
			<div class="da-message success os_edit_success" hidden="true"></div>
			<div class="da-message warning os_edit_warning" hidden="true"></div>
			<div class="da-button-row">
				<span class="da-button green update_os"> <img
					src="<?php echo $this->baseurl; ?>/images/icons/color/pencil.png">&nbsp;&nbsp;Update
				</span>
			</div>
		</div>
	</form>
</div>
<!-- end edit dialog -->
<div id="delete_os_div" style="display: none;">
	<blockquote>
		You are about to <strong><font color="#A6D037">DELETE</font> </strong>
		os id : <font color="#A6D037"><strong class="delete_id"></strong> </font>,&nbsp;&nbsp;are
		you sure ?
	</blockquote>
</div>









