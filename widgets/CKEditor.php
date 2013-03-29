<?php

class CKEditor extends CInputWidget
{
	public $path;
	public $browseUrl;
	
	public function run()
	{
		$url=Yii::app()->assetManager->publish($this->path);
		Yii::app()->clientScript->registerScriptFile($url.'/ckeditor.js', CClientScript::POS_HEAD);
		
		echo CHtml::activeTextArea($this->model, $this->attribute);
		
		list($name, $id)=$this->resolveNameID();
		$script=<<<EOT
CKEDITOR.replace('$id', {
	filebrowserBrowseUrl: '{$this->browseUrl}',
});
EOT
		;
		Yii::app()->clientScript->registerScript($id.'_ckeditor_script', $script, CClientScript::POS_END);
	}
}