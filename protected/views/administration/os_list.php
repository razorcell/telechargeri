


<script type="text/javascript">
<!-- Setup the ligbulb after menu title-->
$(document).ready(function(){
	$(".home").removeClass("active");
	$(".websites").removeClass("active");
	$(".os").addClass("active");

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
				alt="" /> Add Os
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
							<input type="text" name="req1" />
						</div>
					</div>
					<div class="da-form-row">
						<label>Website</label>
						<div class="da-form-item">
							<select>
								<?php 
								foreach($website_list as $website){
									echo "<option value=\"".$website->id_website."\">".$website->label_website."</option>\n";
								}
								?>
							</select>
						</div>
					</div>
					<div class="da-button-row">
						<span class="da-button green"> <img
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
				alt="" />Os list
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
					foreach($os_list as $os){
						echo '<tr>';
						echo '<td>'.$os->id_os.'</td>';
						echo '<td>'.$os->label_os.'</td>';
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>









