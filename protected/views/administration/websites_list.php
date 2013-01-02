


<script type="text/javascript">
<!-- Setup the ligbulb after menu title-->
$(document).ready(function(){
	$(".home").removeClass("active");
	$(".websites").addClass("active");
	$(".add_website").click(function(){
			var pattern2 = new RegExp(".*");
			var pattern = new RegExp("([\da-z\-])*\.([a-z]{2,3})");
			if(pattern.test($(".label_website").val())){
				$(".label_website").val("OK");

				}else{
					$.jGrowl("Website label is rong : "+$(".label_website").val(), {header: "input error : ", position: "bottom-right"});

					}
				

		})

});


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
				src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/black/16/plus_small.png"
				alt="" /> Add a website
			</span>
		</div>
		<div class="da-panel-content">
			<form id="da-ex-validate1" class="da-form">
				<div id="da-ex-val1-error" class="da-message error"
					style="display: none;"></div>
				<div class="da-form-inline">
					<div class="da-form-row">
						<label>Label</label>
						<div class="da-form-item">
							<input type="text" name="req1" class="label_website" />
						</div>
					</div>
					<div class="da-form-row">
						<label>Language</label>
						<div class="da-form-item">
							<select>
								<option value="fr">French</option>
								<option value="eng">English</option>
							</select> 
						</div>
					</div>
					<div class="da-button-row">
						<span class="da-button green add_website"> <img
							src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/color/add.png">&nbsp;&nbsp;Send
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
				src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/black/16/list.png"
				alt="" /> Websites
			</span>

		</div>
		<div class="da-panel-content">
			<table id="da-ex-datatable-numberpaging" class="da-table">
				<thead>
					<tr>
						<th>Id</th>
						<th>Label</th>

					</tr>
				</thead>
				<tbody>
					<?php 
					foreach($website_list as $website){
						echo '<tr>';
						echo '<td>'.$website->id_website.'</td>';
						echo '<td>'.$website->label_website.'</td>';
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>









