<?php
/* @var $this WebsiteController */
/* @var $data Website */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_website')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_website), array('view', 'id'=>$data->id_website)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('label_website')); ?>:</b>
	<?php echo CHtml::encode($data->label_website); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language')); ?>:</b>
	<?php echo CHtml::encode($data->language); ?>
	<br />


</div>