<?php

/**
 * This is the model class for table "Download_link".
 *
 * The followings are the available columns in table 'Download_link':
 * @property string $id_download_link
 * @property string $label_download_link
 * @property string $id_application
 *
 * The followings are the available model relations:
 * @property Application $idApplication
 */
class DownloadLink extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DownloadLink the static model class
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
		return 'Download_link';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('label_download_link, id_application', 'required'),
			array('label_download_link', 'length', 'max'=>300),
			array('id_application', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_download_link, label_download_link, id_application', 'safe', 'on'=>'search'),
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
			'idApplication' => array(self::BELONGS_TO, 'Application', 'id_application'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_download_link' => 'Id Download Link',
			'label_download_link' => 'Label Download Link',
			'id_application' => 'Id Application',
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

		$criteria->compare('id_download_link',$this->id_download_link,true);
		$criteria->compare('label_download_link',$this->label_download_link,true);
		$criteria->compare('id_application',$this->id_application,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}