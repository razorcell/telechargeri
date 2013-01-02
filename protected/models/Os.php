<?php

/**
 * This is the model class for table "Os".
 *
 * The followings are the available columns in table 'Os':
 * @property string $id_os
 * @property string $label_os
 *
 * The followings are the available model relations:
 * @property WebsiteOs[] $websiteOses
 */
class Os extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Os the static model class
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
		return 'Os';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('label_os', 'required'),
			array('label_os', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_os, label_os', 'safe', 'on'=>'search'),
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
			'websiteOses' => array(self::HAS_MANY, 'WebsiteOs', 'id_os'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_os' => 'Id Os',
			'label_os' => 'Label Os',
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

		$criteria->compare('id_os',$this->id_os,true);
		$criteria->compare('label_os',$this->label_os,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}