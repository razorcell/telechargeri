<?php

/**
 * This is the model class for table "Application".
 *
 * The followings are the available columns in table 'Application':
 * @property string $id_application
 * @property string $label_application
 * @property string $description
 * @property string $image_link
 * @property string $version
 * @property string $insert_date
 * @property string $id_category
 * @property string $id_section
 * @property string $id_website
 *
 * The followings are the available model relations:
 * @property Website $idWebsite
 * @property Category $idCategory
 * @property Section $idSection
 * @property DownloadLink[] $downloadLinks
 */
class Application extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Application the static model class
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
		return 'Application';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('label_application, description, image_link, version, insert_date, id_category, id_website', 'required'),
			array('label_application, insert_date', 'length', 'max'=>100),
			array('image_link', 'length', 'max'=>300),
			array('version', 'length', 'max'=>20),
			array('id_category, id_section, id_website', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_application, label_application, description, image_link, version, insert_date, id_category, id_section, id_website', 'safe', 'on'=>'search'),
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
			'idWebsite' => array(self::BELONGS_TO, 'Website', 'id_website'),
			'idCategory' => array(self::BELONGS_TO, 'Category', 'id_category'),
			'idSection' => array(self::BELONGS_TO, 'Section', 'id_section'),
			'downloadLinks' => array(self::HAS_MANY, 'DownloadLink', 'id_application'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_application' => 'Id Application',
			'label_application' => 'Label Application',
			'description' => 'Description',
			'image_link' => 'Image Link',
			'version' => 'Version',
			'insert_date' => 'Insert Date',
			'id_category' => 'Id Category',
			'id_section' => 'Id Section',
			'id_website' => 'Id Website',
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

		$criteria->compare('id_application',$this->id_application,true);
		$criteria->compare('label_application',$this->label_application,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image_link',$this->image_link,true);
		$criteria->compare('version',$this->version,true);
		$criteria->compare('insert_date',$this->insert_date,true);
		$criteria->compare('id_category',$this->id_category,true);
		$criteria->compare('id_section',$this->id_section,true);
		$criteria->compare('id_website',$this->id_website,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}