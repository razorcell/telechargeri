<?php

/**
 * This is the model class for table "Status".
 *
 * The followings are the available columns in table 'Status':
 * @property string $id
 * @property string $website
 * @property string $os
 * @property string $category
 * @property string $section
 * @property string $list_link
 * @property string $application_link
 * @property string $application_name
 * @property integer $downloaded_pages
 * @property integer $applications_added
 * @property integer $applications_updated
 */
class Status extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Status the static model class
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
		return 'Status';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('downloaded_pages, applications_added, applications_updated', 'numerical', 'integerOnly'=>true),
			array('website, os, category, section', 'length', 'max'=>30),
			array('list_link, application_link, application_name', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, website, os, category, section, list_link, application_link, application_name, downloaded_pages, applications_added, applications_updated', 'safe', 'on'=>'search'),
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
			'website' => 'Website',
			'os' => 'Os',
			'category' => 'Category',
			'section' => 'Section',
			'list_link' => 'List Link',
			'application_link' => 'Application Link',
			'application_name' => 'Application Name',
			'downloaded_pages' => 'Downloaded Pages',
			'applications_added' => 'Applications Added',
			'applications_updated' => 'Applications Updated',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('os',$this->os,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('section',$this->section,true);
		$criteria->compare('list_link',$this->list_link,true);
		$criteria->compare('application_link',$this->application_link,true);
		$criteria->compare('application_name',$this->application_name,true);
		$criteria->compare('downloaded_pages',$this->downloaded_pages);
		$criteria->compare('applications_added',$this->applications_added);
		$criteria->compare('applications_updated',$this->applications_updated);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}