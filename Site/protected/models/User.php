<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $USER_ID
 * @property string $SECOND_NAME
 * @property string $IMEI
 * @property string $FIRST_NAME
 * @property string $THIRD_NAME
 * @property string $LOGIN
 * @property string $BIRTH_DATE
 * @property integer $MANAGER_ID
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('LOGIN, BIRTH_DATE', 'required'),
			array('MANAGER_ID', 'numerical', 'integerOnly'=>true),
			array('SECOND_NAME, FIRST_NAME, THIRD_NAME', 'length', 'max'=>50),
			array('IMEI', 'length', 'max'=>15),
			array('LOGIN', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('USER_ID, SECOND_NAME, IMEI, FIRST_NAME, THIRD_NAME, LOGIN, BIRTH_DATE, MANAGER_ID', 'safe', 'on'=>'search'),
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
			'USER_ID' => 'User',
			'SECOND_NAME' => 'Second Name',
			'IMEI' => 'Imei',
			'FIRST_NAME' => 'First Name',
			'THIRD_NAME' => 'Third Name',
			'LOGIN' => 'Login',
			'BIRTH_DATE' => 'Birth Date',
			'MANAGER_ID' => 'Manager',
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

		$criteria->compare('USER_ID',$this->USER_ID);
		$criteria->compare('SECOND_NAME',$this->SECOND_NAME,true);
		$criteria->compare('IMEI',$this->IMEI,true);
		$criteria->compare('FIRST_NAME',$this->FIRST_NAME,true);
		$criteria->compare('THIRD_NAME',$this->THIRD_NAME,true);
		$criteria->compare('LOGIN',$this->LOGIN,true);
		$criteria->compare('BIRTH_DATE',$this->BIRTH_DATE,true);
		$criteria->compare('MANAGER_ID',$this->MANAGER_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
	public function getFIO()
	{
            return trim($this->SECOND_NAME.' '.$this->FIRST_NAME.' '.$this->THIRD_NAME);
	}
        
        public function primaryKey() {
            parent::primaryKey();
            return 'USER_ID';
        }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
}
