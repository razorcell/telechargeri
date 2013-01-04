<?php

/**
 * This is the model class for table "Category".
 *
 * The followings are the available columns in table 'Category':
 * @property string $id_category
 * @property string $label_category
 * @property string $id_website
 * @property string $id_os
 *
 * The followings are the available model relations:
 * @property Application[] $applications
 * @property Os $idOs
 * @property Website $idWebsite
 * @property Section[] $sections
 */
class Category extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Category the static model class
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
		return 'Category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('label_category, id_website, id_os', 'required'),
			array('label_category', 'length', 'max'=>30),
			array('id_website, id_os', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_category, label_category, id_website, id_os', 'safe', 'on'=>'search'),
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
			'applications' => array(self::HAS_MANY, 'Application', 'id_category'),
			'idOs' => array(self::BELONGS_TO, 'Os', 'id_os'),
			'idWebsite' => array(self::BELONGS_TO, 'Website', 'id_website'),
			'sections' => array(self::HAS_MANY, 'Section', 'id_category'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_category' => 'Id Category',
			'label_category' => 'Label Category',
			'id_website' => 'Id Website',
			'id_os' => 'Id Os',
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

		$criteria->compare('id_category',$this->id_category,true);
		$criteria->compare('label_category',$this->label_category,true);
		$criteria->compare('id_website',$this->id_website,true);
		$criteria->compare('id_os',$this->id_os,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}