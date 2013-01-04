<?php
/* @var $this OsController */
/* @var $model Os */

$this->breadcrumbs=array(
	'Oses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Os', 'url'=>array('index')),
	array('label'=>'Manage Os', 'url'=>array('admin')),
);
?>

<h1>Create Os</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>