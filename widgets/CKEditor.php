<?php

class CKEditor extends CInputWidget
{
	public $path;
	
	private $_path;
	
	public function init()
	{
		$this->_path=Yii::app()->basePath.DIRECTORY_SEPARATOR.$this->path;
	}
	
	public function run()
	{
		$url=Yii::app()->getAssetManager()->publish($this->_path);
		Yii::app()->getClientScript()->registerScriptFile($url.'/ckeditor.js', CClientScript::POS_HEAD);
		
		echo CHtml::activeTextArea($this->model, $this->attribute);
		
		list($name, $id)=$this->resolveNameID();
		$script="CKEDITOR.replace('$id');";
		Yii::app()->getClientScript()->registerScript($id.'_ckeditor_script', $script, CClientScript::POS_END);
	}
}