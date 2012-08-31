<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $Id_customer
 * @property integer $adult_section
 *
 * The followings are the available model relations:
 * @property Customer $idCustomer
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	static private $_user = null;
	
	/**
	* Returns the static model of the specified AR class.
	* @param string $className active record class name.
	* @return User the static model class
	*/
	
	public static function isAdult()
	{
		$user = User::model()->findByPk(Yii::app()->user->Id);
		return $user->adult_section;
	}
	
	public static function getCurrentUser()
	{
		if(!isset(self::$_user))
		{
			self::$_user = User::model()->findByPk(Yii::app()->user->Id);
		}
		return self::$_user;
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email, Id_customer', 'required'),
			array('Id_customer, adult_section', 'numerical', 'integerOnly'=>true),
			array('username, password, email', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('username, password, email, Id_customer, adult_section', 'safe', 'on'=>'search'),
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
			'customer' => array(self::BELONGS_TO, 'Customer', 'Id_customer'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'Id_customer' => 'Id Customer',
			'adult_section' => 'Adult Section',
		);
	}

	public function sincronizeFromServer()
	{
		$requests = array();
		$pelicanoCliente = new Pelicano;
		$idCustomer = null;
		$modelUser = User::getCurrentUser();
		$idCustomer = (isset($modelUser))?$modelUser->Id_customer:null; 
		
		if(isset($idCustomer))
		{
			$UserResponseArray = $pelicanoCliente->getNewUser($idCustomer);
			foreach ($UserResponseArray as $user) {
					
				try {
		
					$modelDB = User::model()->findByPk($user->username);
					if(isset($modelDB))
					{
						if($user->deleted == 0)
						{
							$modelDB->username = $user->username;
							$modelDB->password = $user->password;
							$modelDB->email = $user->email;
							$modelDB->adult_section = $user->adult_section;
							$modelDB->save();
						}
						else
						{
							$modelDB->delete();
						}
					}
					else
					{
						if($user->deleted == 0)
						{
							$model = new User();
							$model->username = $user->username;
							$model->password = $user->password;
							$model->email = $user->email;
							$model->Id_customer = $idCustomer;
							$model->adult_section = $user->adult_section;						
							$model->save();
							
							$assDB = Assignments::model()->findByAttributes(array('userid'=>$user->username));
							if(!isset($assDB)){
								$ass = new Assignments();
								$ass->userid = $user->username;
								$ass->data = 's:0:"";';
								$ass->itemname = 'Customer';
								$ass->save();
							}
						}
					}
		
				} catch (Exception $e) {
				}
					
				$request= new UserStateRequest;
				$request->username = $user->username;
				$request->password =$user->passowrd;
				$request->email =$user->email;
					
				$requests[]=$request;
			}
		
			$status = $pelicanoCliente->setUserState($requests);
		}
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

		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('Id_customer',$this->Id_customer);
		$criteria->compare('adult_section',$this->adult_section);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}