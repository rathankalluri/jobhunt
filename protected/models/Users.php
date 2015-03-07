<?php

/**
 * This is the model class for table "is_users".
 *
 * The followings are the available columns in table 'is_users':
 * @property integer $id
 * @property integer $user_type
 * @property string $fname
 * @property string $lname
 * @property string $username
 * @property string $email
 * @property string $password
 * @property integer $created_by
 * @property string $created_date
 * @property integer $status
 * @property string $last_login_date
 *
 * The followings are the available model relations:
 * @property IsAnswers[] $isAnswers
 * @property IsCourses[] $isCourses
 * @property IsQuestions[] $isQuestions
 * @property IsLookup $userType
 */
class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'is_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_type, created_by, status', 'numerical', 'integerOnly'=>true),
			array('fname, lname, username, email, password', 'length', 'max'=>45),
			array('created_date, last_login_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_type, fname, lname, username, email, password, created_by, created_date, status, last_login_date', 'safe', 'on'=>'search'),
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
			'isAnswers' => array(self::HAS_MANY, 'IsAnswers', 'created_by'),
			'isCourses' => array(self::HAS_MANY, 'IsCourses', 'created_by'),
			'isQuestions' => array(self::HAS_MANY, 'IsQuestions', 'created_by'),
			'userType' => array(self::BELONGS_TO, 'IsLookup', 'user_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_type' => 'User Type',
			'fname' => 'Fname',
			'lname' => 'Lname',
			'username' => 'Username',
			'email' => 'Email',
			'password' => 'Password',
			'created_by' => 'Created By',
			'created_date' => 'Created Date',
			'status' => 'Status',
			'last_login_date' => 'Last Login Date',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_type',$this->user_type);
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('last_login_date',$this->last_login_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
