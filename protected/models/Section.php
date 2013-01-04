<?php

/**
 * This is the model class for table "Section".
 *
 * The followings are the available columns in table 'Section':
 * @property string $id_section
 * @property string $label_section
 * @property string $id_category
 *
 * The followings are the available model relations:
 * @property Application[] $applications
 * @property Category $idCategory
 */
class Section extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Section the static model class
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
		return 'Section';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('label_section', 'required'),
			array('label_section', 'length', 'max'=>30),
			array('id_category', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_section, label_section, id_category', 'safe', 'on'=>'search'),
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
			'applications' => array(self::HAS_MANY, 'Application', 'id_section'),
			'idCategory' => array(self::BELONGS_TO, 'Category', 'id_category'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_section' => 'Id Section',
			'label_section' => 'Label Section',
			'id_category' => 'Id Category',
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

		$criteria->compare('id_section',$this->id_section,true);
		$criteria->compare('label_section',$this->label_section,true);
		$criteria->compare('id_category',$this->id_category,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}