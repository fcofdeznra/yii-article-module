<?php

class ArticleModule extends CWebModule
{
	public $titleLength=128;
	public $descriptionLength=256;
	public $articlesPath;
	
	public $ckeditorPath;
	public $ckeditorBrowseUrl;
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'article.models.*',
			'article.components.*',
			'article.widgets.*',
		));
		
		$this->ckeditorPath=Yii::app()->basePath.DIRECTORY_SEPARATOR.$this->ckeditorPath;
		$this->ckeditorBrowseUrl=Yii::app()->createUrl(array_shift($this->ckeditorBrowseUrl), $this->ckeditorBrowseUrl);
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
