<?php
/* @var $this WebsiteController */
/* @var $model Website */

$this->breadcrumbs=array(
	'Websites'=>array('index'),
	$model->id_website=>array('view','id'=>$model->id_website),
	'Update',
);

$this->menu=array(
	array('label'=>'List Website', 'url'=>array('index')),
	array('label'=>'Create Website', 'url'=>array('create')),
	array('label'=>'View Website', 'url'=>array('view', 'id'=>$model->id_website)),
	array('label'=>'Manage Website', 'url'=>array('admin')),
);
?>

<h1>Update Website <?php echo $model->id_website; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>