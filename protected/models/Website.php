<?php

/**
 * This is the model class for table "Website".
 *
 * The followings are the available columns in table 'Website':
 * @property string $id_website
 * @property string $label_website
 * @property string $language
 *
 * The followings are the available model relations:
 * @property Application[] $applications
 * @property Category[] $categories
 * @property Os[] $oses
 */
class Website extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Website the static model class
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
		return 'Website';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('label_website, language', 'required'),
			array('label_website', 'length', 'max'=>70),
			array('language', 'length', 'max'=>7),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_website, label_website, language', 'safe', 'on'=>'search'),
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
			'applications' => array(self::HAS_MANY, 'Application', 'id_website'),
			'categories' => array(self::HAS_MANY, 'Category', 'id_website'),
			'oses' => array(self::HAS_MANY, 'Os', 'id_website'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_website' => 'Id Website',
			'label_website' => 'Label Website',
			'language' => 'Language',
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

		$criteria->compare('id_website',$this->id_website,true);
		$criteria->compare('label_website',$this->label_website,true);
		$criteria->compare('language',$this->language,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}