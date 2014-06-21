<?php

/**
 * This is the model class for table "{{h_planneritem}}".
 *
 * The followings are the available columns in table '{{h_planneritem}}':
 * @property integer $IMEI
 * @property integer $HOSPITAL_ID
 * @property integer $WEEKNUM
 * @property string $DAY_OF_WEEK
 * @property integer $FILE_ID
 *
 * The followings are the available model relations:
 * @property UploadFiles $file
 */
class HPlannerItem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{h_planneritem}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('IMEI, HOSPITAL_ID, WEEKNUM, DAY_OF_WEEK, FILE_ID', 'required'),
			array('IMEI, HOSPITAL_ID, WEEKNUM, FILE_ID', 'numerical', 'integerOnly'=>true),
			array('DAY_OF_WEEK', 'length', 'max'=>9),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('IMEI, HOSPITAL_ID, WEEKNUM, DAY_OF_WEEK, FILE_ID', 'safe', 'on'=>'search'),
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
			'file' => array(self::BELONGS_TO, 'UploadFiles', 'file_id'),
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
			'WEEKNUM' => 'Weeknum',
			'DAY_OF_WEEK' => 'Day Of Week',
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

		$criteria->compare('IMEI',$this->IMEI);
		$criteria->compare('HOSPITAL_ID',$this->HOSPITAL_ID);
		$criteria->compare('WEEKNUM',$this->WEEKNUM);
		$criteria->compare('DAY_OF_WEEK',$this->DAY_OF_WEEK,true);
		$criteria->compare('FILE_ID',$this->FILE_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HPlannerItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
