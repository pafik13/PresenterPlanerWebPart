<?php

/**
 * This is the model class for table "{{demonstration}}".
 *
 * The followings are the available columns in table '{{demonstration}}':
 * @property integer $DEMONSTRATION_ID
 * @property string $IMEI
 * @property integer $DOCTOR_ID
 * @property string $VISIT_DATE
 * @property string $VISIT_TIME
 * @property string $ANALYZE
 * @property string $INSERT_TIME
 * @property integer $FILE_ID
 */
class Demonstration extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{demonstration}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('IMEI, DOCTOR_ID, VISIT_DATE, VISIT_TIME, FILE_ID', 'required'),
			array('DOCTOR_ID, FILE_ID', 'numerical', 'integerOnly'=>true),
			array('IMEI', 'length', 'max'=>15),
			array('ANALYZE', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('DEMONSTRATION_ID, IMEI, DOCTOR_ID, VISIT_DATE, VISIT_TIME, ANALYZE, INSERT_TIME, FILE_ID', 'safe', 'on'=>'search'),
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
			'DEMONSTRATION_ID' => 'Demonstration',
			'IMEI' => 'Imei',
			'DOCTOR_ID' => 'Doctor',
			'VISIT_DATE' => 'Visit Date',
			'VISIT_TIME' => 'Visit Time',
			'ANALYZE' => 'Analyze',
			'INSERT_TIME' => 'Insert Time',
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

		$criteria->compare('DEMONSTRATION_ID',$this->DEMONSTRATION_ID);
		$criteria->compare('IMEI',$this->IMEI,true);
		$criteria->compare('DOCTOR_ID',$this->DOCTOR_ID);
		$criteria->compare('VISIT_DATE',$this->VISIT_DATE,true);
		$criteria->compare('VISIT_TIME',$this->VISIT_TIME,true);
		$criteria->compare('ANALYZE',$this->ANALYZE,true);
		$criteria->compare('INSERT_TIME',$this->INSERT_TIME,true);
		$criteria->compare('FILE_ID',$this->FILE_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Demonstration the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
