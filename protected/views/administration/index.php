

<?php
/* @var $this AdministrationController */
/*
 $this->breadcrumbs=array(
 		'Administration',
 );*/
?>
<h1>
	<?php echo $this->id . '/' . $this->action->id; ?>
</h1>

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
				<?php echo var_dump($res);?>
				<p style="white-space:nowrap"><?php echo htmlentities($content);?></p>
			</div>
		</div>
	</div>
</div>



