<?php

/**
 * This is the model class for table "{{setts}}".
 *
 * The followings are the available columns in table '{{setts}}':
 * @property integer $WEEK_OF_START
 * @property string $PACKAGE_NAME
 * @property string $PHONE
 * @property string $DL_SITE
 * @property string $VERSION_FILE_NAME
 */
class Setts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{setts}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('WEEK_OF_START', 'required'),
			array('WEEK_OF_START', 'numerical', 'integerOnly'=>true),
			array('PACKAGE_NAME, VERSION_FILE_NAME', 'length', 'max'=>50),
			array('PHONE', 'length', 'max'=>15),
			array('DL_SITE', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('WEEK_OF_START, PACKAGE_NAME, PHONE, DL_SITE, VERSION_FILE_NAME', 'safe', 'on'=>'search'),
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
			'WEEK_OF_START' => 'Week Of Start',
			'PACKAGE_NAME' => 'Package Name',
			'PHONE' => 'Phone',
			'DL_SITE' => 'Dl Site',
			'VERSION_FILE_NAME' => 'Version File Name',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('WEEK_OF_START',$this->WEEK_OF_START);
		$criteria->compare('PACKAGE_NAME',$this->PACKAGE_NAME,true);
		$criteria->compare('PHONE',$this->PHONE,true);
		$criteria->compare('DL_SITE',$this->DL_SITE,true);
		$criteria->compare('VERSION_FILE_NAME',$this->VERSION_FILE_NAME,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Setts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
