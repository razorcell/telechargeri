<?php
/* @var $this OsController */
/* @var $data Os */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_os')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_os), array('view', 'id'=>$data->id_os)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('label_os')); ?>:</b>
	<?php echo CHtml::encode($data->label_os); ?>
	<br />


</div>