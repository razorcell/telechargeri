<?php
/* @var $this OsController */
/* @var $model Os */

$this->breadcrumbs=array(
	'Oses'=>array('index'),
	$model->id_os=>array('view','id'=>$model->id_os),
	'Update',
);

$this->menu=array(
	array('label'=>'List Os', 'url'=>array('index')),
	array('label'=>'Create Os', 'url'=>array('create')),
	array('label'=>'View Os', 'url'=>array('view', 'id'=>$model->id_os)),
	array('label'=>'Manage Os', 'url'=>array('admin')),
);
?>

<h1>Update Os <?php echo $model->id_os; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>