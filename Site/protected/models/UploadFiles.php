<?php

/**
 * This is the model class for table "{{upload_files}}".
 *
 * The followings are the available columns in table '{{upload_files}}':
 * @property integer $ID
 * @property string $IMEI
 * @property string $TYPE
 * @property string $HASH
 * @property string $TIMESTAMP
 * @property string $FILE
 * @property string $ERR
 *
 * The followings are the available model relations:
 * @property Doctor[] $doctors
 * @property HPlanneritem[] $hPlanneritems
 * @property Hospital[] $hospitals
 */
class UploadFiles extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{upload_file}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('IMEI, TYPE, HASH, FILE', 'required'),
			array('IMEI', 'length', 'max'=>15),
			array('TYPE', 'length', 'max'=>255),
			array('HASH', 'length', 'max'=>32),
			array('ERR', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, IMEI, TYPE, HASH, TIMESTAMP, FILE, ERR', 'safe', 'on'=>'search'),
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
			'doctors' => array(self::HAS_MANY, 'Doctor', 'FILE_ID'),
			'hPlanneritems' => array(self::HAS_MANY, 'HPlanneritem', 'file_id'),
			'hospitals' => array(self::HAS_MANY, 'Hospital', 'file_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'IMEI' => 'Imei',
			'TYPE' => 'Type',
			'HASH' => 'Hash',
			'TIMESTAMP' => 'Timestamp',
			'FILE' => 'File',
			'ERR' => 'Err',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('IMEI',$this->IMEI,true);
		$criteria->compare('TYPE',$this->TYPE,true);
		$criteria->compare('HASH',$this->HASH,true);
		$criteria->compare('TIMESTAMP',$this->TIMESTAMP,true);
		$criteria->compare('FILE',$this->FILE,true);
		$criteria->compare('ERR',$this->ERR,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UploadFiles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
