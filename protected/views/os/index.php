<?php
/* @var $this OsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Oses',
);

$this->menu=array(
	array('label'=>'Create Os', 'url'=>array('create')),
	array('label'=>'Manage Os', 'url'=>array('admin')),
);
?>

<h1>Oses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
