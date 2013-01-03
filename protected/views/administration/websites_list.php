


<script type="text/javascript">
<!-- Setup the ligbulb after menu title-->
$(document).ready(function(){
	$(".home").removeClass("active");
	$(".os").removeClass("active");
	$(".appsgrabb").removeClass("active");
	$(".websites").addClass("active");
	$(".add_website").click(function(){
		var label_website = $(".label_website") .val();
		var language = $(".language") .val();
			var pattern = new RegExp("^[0-9a-z-]+(\.(com|fr|net|org|edu|gov|uk|ca|de|jp|au|us|co|c))+$")
			if(pattern.test(label_website)){
				var json = '{';
				json += ' "label_website" : "'+label_website+'", ';
				json += ' "language" : "'+language+'" ';
				json +='}';
				$.ajax({ 
					type : "POST",
					url : "/website_add",
					data : json,
					success : function(data) {
						var json = $.parseJSON(data);
						if (!json.err) {
							$(".success").show();$(".error").hide();
							$(".success").html(json.message);
						} else {
							$(".error").show();$(".success").hide();
							$(".error").html(json.message);
								}
						}
				});//end of ajax
		}else{
			$(".error").show();$(".success").hide();
			$(".error").html("Label value is rong : "+label_website);				
		}//end if pattern
	});//end website_add.click()
	$(".update_website").click(function(){
		var update_id_website = $(".edit_id_website").val();
		var update_label_website = $(".edit_label_website") .val();
		var update_language = $(".edit_language") .val();
			var pattern = new RegExp("^[0-9a-z-]+(\.(com|fr|net|org|edu|gov|uk|ca|de|jp|au|us|co|c))+$")
			if(pattern.test(update_label_website)){
				var json = '{';
				json += ' "id_website" : "'+update_id_website+'", ';
				json += ' "label_website" : "'+update_label_website+'", ';
				json += ' "language" : "'+update_language+'" ';
				json +='}';
				$.ajax({ 
					type : "POST",
					url : "/website_update",
					data : json,
					success : function(data) {
						var json = $.parseJSON(data);
						if (!json.err) {
							$(".edit_success").show();$(".edit_error").hide();
							$(".edit_success").html(json.message);
						} else {
							$(".edit_error").show();$(".edit_success").hide();
							$(".edit_error").html(json.message);
								}
						}
				});//end of ajax
		}else{
			$(".edit_error").show();$(".edit_success").hide();
			$(".edit_error").html("Label value is rong : "+update_label_website);				
		}//end if pattern
	});//end update_website.click()

	
	$(".website_edit").live("click", function(event) {
		var id_website = $(this).parents("tr.website_row").find("td.id_website").html();
		var json = "{"+" \"id_website\" : \""+id_website+"\" }";
		$.ajax({
			type:"POST",
			url:"/website_edit",
			data:json,
			success: function(data){
					var json = $.parseJSON(data);
					if(!json.err){
						$(".edit_id_website").val(json.id_website);
						$(".edit_label_website").val(json.label_website);
						$(".edit_language").val(json.language);
						$("#edit_website_div").dialog("option", {modal: true}).dialog("open");
						event.preventDefault();
					}else{
						alert("Error from server : "+json.message);
					}
				}
			});
	});
	$("#edit_website_div").dialog({
		autoOpen: false, 
		title: "Website edit form", 
		modal: true, 
		width: "640",
	});

});//end of .ready() body
</script>


<?php
/* @var $this WebsiteController */
/* @var $dataProvider CActiveDataProvider */

/*$this->breadcrumbs=array(
 'Websites',
);

$this->menu=array(
		array('label'=>'Create Website', 'url'=>array('create')),
		array('label'=>'Manage Website', 'url'=>array('admin')),
);*/
?>
<div class="grid_4">
	<div class="da-panel collapsible">
		<div class="da-panel-header">
			<span class="da-panel-title"> <img
				src="<?php echo $this->baseurl; ?>/images/icons/black/16/plus_small.png"
				alt="" /> Add a website
			</span>
		</div>
		<div class="da-panel-content">
			<form id="da-ex-validate1" class="da-form">
				<div class="da-form-inline">
					<div class="da-form-row">
						<label>Label</label>
						<div class="da-form-item">
							<span class="formNote">Ex : 03site.com / 58-site.com /
								13-site.co.com</span> <input type="text" name="req1"
								class="label_website" />
						</div>
					</div>
					<div class="da-form-row">
						<label>Language</label>
						<div class="da-form-item">
							<select class="language" name="language">
								<option value="French" selected="selected">French</option>
								<option value="English">English</option>
							</select>
						</div>
					</div>
					<div class="da-message success" hidden="true">This is an error
						message</div>
					<div class="da-message error" hidden="true">This is an error
						message</div>
					<div class="da-button-row">
						<span class="da-button green add_website"> <img
							src="<?php echo $this->baseurl; ?>/images/icons/color/add.png">&nbsp;&nbsp;Add
						</span>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="grid_4">
	<div class="da-panel collapsible">
		<div class="da-panel-header">
			<span class="da-panel-title"> <img
				src="<?php echo $this->baseurl; ?>/images/icons/black/16/list.png"
				alt="" /> Websites
			</span>

		</div>
		<div class="da-panel-content">
			<table id="da-ex-datatable-numberpaging" class="da-table">
				<thead>
					<tr>
						<th>Id</th>
						<th>Label</th>
						<th>Language</th>
						<th></th>

					</tr>
				</thead>
				<tbody>
					<?php 
					foreach($website_list as $website){
						$id = $website->id_website;
						echo '<tr class="website_row">';
						echo "<td class=\"id_website\">".$website->id_website.'</td>';
						echo "<td>".$website->label_website.'</td>';
						echo "<td>".$website->language.'</td>';
						echo "<td class=\"da-icon-column\">";
						echo "<img class=\"website_edit\" style=\"cursor:pointer\" src=".Yii::app()->request->baseUrl."/images/icons/color/pencil.png>&nbsp;&nbsp;";
						echo "<img class=\"website_delete\" style=\"cursor:pointer\" src=".Yii::app()->request->baseUrl."/images/icons/color/cross.png>";
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
<div id="edit_website_div" class="no-padding">
	<form id="da-ex-validate1" class="da-form">
		<div class="da-form-inline">
		<div class="da-form-row">
				<label>Id</label>
				<div class="da-form-item">
					<input type="text" name="req1" class="edit_id_website" disabled/>
				</div>
			</div>
			<div class="da-form-row">
				<label>Label</label>
				<div class="da-form-item">
					<span class="formNote">Ex : 03site.com / 58-site.com /
						13-site.co.com</span> <input type="text" name="req1"
						class="edit_label_website" />
				</div>
			</div>
			<div class="da-form-row">
				<label>Language</label>
				<div class="da-form-item">
					<select class="edit_language" name="edit_language">
						<option value="French" selected="selected">French</option>
						<option value="English">English</option>
					</select>
				</div>
			</div>
			<div class="da-message success edit_success" hidden="true"></div>
			<div class="da-message error edit_error" hidden="true"></div>
			<div class="da-button-row">
				<span class="da-button blue update_website"> <img
					src="<?php echo $this->baseurl; ?>/images/icons/color/pencil.png">&nbsp;&nbsp;Update
				</span>
			</div>
		</div>
	</form>
</div>
<!-- end edit dialog -->








