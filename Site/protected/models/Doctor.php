<?php

/**
 * This is the model class for table "{{doctor}}".
 *
 * The followings are the available columns in table '{{doctor}}':
 * @property string $IMEI
 * @property integer $DOCTOR_ID
 * @property string $SNCHAR
 * @property string $SECOND_NAME
 * @property string $FIRST_NAME
 * @property string $THIRD_NAME
 * @property integer $HOSPITAL_ID
 * @property string $TEL
 * @property string $EMAIL
 * @property string $POSITION_
 * @property string $SPECIALITY
 * @property integer $FILE_ID
 *
 * The followings are the available model relations:
 * @property UploadFiles $fILE
 */
class Doctor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{doctor}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('IMEI, DOCTOR_ID, FILE_ID', 'required'),
			array('DOCTOR_ID, HOSPITAL_ID, FILE_ID', 'numerical', 'integerOnly'=>true),
			array('IMEI', 'length', 'max'=>15),
			array('SNCHAR', 'length', 'max'=>1),
			array('SECOND_NAME, FIRST_NAME, THIRD_NAME', 'length', 'max'=>255),
			array('TEL, EMAIL, POSITION_, SPECIALITY', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('IMEI, DOCTOR_ID, SNCHAR, SECOND_NAME, FIRST_NAME, THIRD_NAME, HOSPITAL_ID, TEL, EMAIL, POSITION_, SPECIALITY, FILE_ID', 'safe', 'on'=>'search'),
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
			'fILE' => array(self::BELONGS_TO, 'UploadFiles', 'FILE_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'IMEI' => 'Imei',
			'DOCTOR_ID' => 'Doctor',
			'SNCHAR' => 'Snchar',
			'SECOND_NAME' => 'Second Name',
			'FIRST_NAME' => 'First Name',
			'THIRD_NAME' => 'Third Name',
			'HOSPITAL_ID' => 'Hospital',
			'TEL' => 'Tel',
			'EMAIL' => 'Email',
			'POSITION_' => 'Position',
			'SPECIALITY' => 'Speciality',
			'FILE_ID' => 'File',
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

		$criteria->compare('IMEI',$this->IMEI,true);
		$criteria->compare('DOCTOR_ID',$this->DOCTOR_ID);
		$criteria->compare('SNCHAR',$this->SNCHAR,true);
		$criteria->compare('SECOND_NAME',$this->SECOND_NAME,true);
		$criteria->compare('FIRST_NAME',$this->FIRST_NAME,true);
		$criteria->compare('THIRD_NAME',$this->THIRD_NAME,true);
		$criteria->compare('HOSPITAL_ID',$this->HOSPITAL_ID);
		$criteria->compare('TEL',$this->TEL,true);
		$criteria->compare('EMAIL',$this->EMAIL,true);
		$criteria->compare('POSITION_',$this->POSITION_,true);
		$criteria->compare('SPECIALITY',$this->SPECIALITY,true);
		$criteria->compare('FILE_ID',$this->FILE_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Doctor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
