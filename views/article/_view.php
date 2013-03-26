<?php
/* @var $this ArticleController */
/* @var $data Article */
?>

<div class="view">

	<h3><?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?></h3>
	
	<h4><?php echo CHtml::encode($data->description); ?></h4>

</div>