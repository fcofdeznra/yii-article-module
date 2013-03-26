<?php

/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'article':
 * @property integer $id
 * @property string $title
 * @property string $description
 */
class Article extends CActiveRecord
{
	public $body;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Article the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'article';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description', 'required'),
			array('title', 'length', 'max'=>Yii::app()->controller->module->titleLength),
			array('description', 'length', 'max'=>Yii::app()->controller->module->descriptionLength),
			array('body', 'filter', 'filter'=>array(new CHtmlPurifier(), 'purify')),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'description' => 'Description',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function afterSave()
	{
		parent::afterSave();
		$this->saveBody();
	}
	
	protected function afterFind()
	{
		parent::afterFind();
		$this->loadBody();
	}
	
	protected function afterDelete()
	{
		parent::afterDelete();
		$this->deleteBody();
	}
	
	private function saveBody()
	{
		$file=fopen($this->getPath(), "w");
		fwrite($file, $this->body);
		fclose($file);
	}
	
	private function loadBody()
	{
		if(filesize($this->getPath())>0)
		{
			$file=fopen($this->getPath(), "r");
			$this->body=fread($file, filesize($this->getPath()));
			fclose($file);
		}
	}
	
	private function deleteBody()
	{
		unlink($this->getPath());
	}
	
	private function getPath()
	{
		return 	Yii::app()->basePath.DIRECTORY_SEPARATOR.
		Yii::app()->controller->module->articlesPath.DIRECTORY_SEPARATOR.
		$this->id.'.html';
	}
}