<?php

/**
 * This is the model class for table "{{hospital}}".
 *
 * The followings are the available columns in table '{{hospital}}':
 * @property string $IMEI
 * @property integer $HOSPITAL_ID
 * @property string $NAME
 * @property string $ADRESS
 * @property string $NEAREST_METRO
 * @property string $REG_PHONE
 * @property integer $FILE_ID
 *
 * The followings are the available model relations:
 * @property UploadFile $file
 */
class Hospital extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{hospital}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('IMEI, HOSPITAL_ID, FILE_ID', 'required'),
			array('HOSPITAL_ID, FILE_ID', 'numerical', 'integerOnly'=>true),
			array('IMEI', 'length', 'max'=>15),
			array('NAME, ADRESS', 'length', 'max'=>255),
			array('NEAREST_METRO', 'length', 'max'=>50),
			array('REG_PHONE', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('IMEI, HOSPITAL_ID, NAME, ADRESS, NEAREST_METRO, REG_PHONE, FILE_ID', 'safe', 'on'=>'search'),
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
			'file' => array(self::BELONGS_TO, 'UploadFile', 'file_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'IMEI' => 'Imei',
			'HOSPITAL_ID' => 'Hospital',
			'NAME' => 'Name',
			'ADRESS' => 'Adress',
			'NEAREST_METRO' => 'Nearest Metro',
			'REG_PHONE' => 'Reg Phone',
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
		$criteria->compare('HOSPITAL_ID',$this->HOSPITAL_ID);
		$criteria->compare('NAME',$this->NAME,true);
		$criteria->compare('ADRESS',$this->ADRESS,true);
		$criteria->compare('NEAREST_METRO',$this->NEAREST_METRO,true);
		$criteria->compare('REG_PHONE',$this->REG_PHONE,true);
		$criteria->compare('FILE_ID',$this->FILE_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Hospital the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
