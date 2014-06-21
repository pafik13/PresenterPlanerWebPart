<?php

/**
 * This is the model class for table "{{d_show}}".
 *
 * The followings are the available columns in table '{{d_show}}':
 * @property integer $SHOW_ID
 * @property integer $NUMBER
 * @property double $TIME
 * @property double $LATITUDE
 * @property double $LONGTITUDE
 * @property integer $DEMO_ID
 */
class DShow extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{d_show}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NUMBER, TIME, LATITUDE, LONGTITUDE, DEMO_ID', 'required'),
			array('NUMBER, DEMO_ID', 'numerical', 'integerOnly'=>true),
			array('TIME, LATITUDE, LONGTITUDE', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('SHOW_ID, NUMBER, TIME, LATITUDE, LONGTITUDE, DEMO_ID', 'safe', 'on'=>'search'),
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
			'SHOW_ID' => 'Show',
			'NUMBER' => 'Number',
			'TIME' => 'Time',
			'LATITUDE' => 'Latitude',
			'LONGTITUDE' => 'Longtitude',
			'DEMO_ID' => 'Demo',
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

		$criteria->compare('SHOW_ID',$this->SHOW_ID);
		$criteria->compare('NUMBER',$this->NUMBER);
		$criteria->compare('TIME',$this->TIME);
		$criteria->compare('LATITUDE',$this->LATITUDE);
		$criteria->compare('LONGTITUDE',$this->LONGTITUDE);
		$criteria->compare('DEMO_ID',$this->DEMO_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DShow the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
