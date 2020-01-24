<?php

class User extends CActiveRecord
{
    private $_identity;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username', 'required',"on" => "login"),
            array('password', 'required',"on" => "login"),

            array('username', 'required',"on" => "register"),
            array('username', 'unique',"on" => "register"),
            array('password', 'required',"on" => "register"),
            array('email', 'required',"on" => "register"),
            array('email', 'unique',"on" => "register"),
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
            "locations" => [self::HAS_MANY,"Location","user_id"]
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
            'login' => 'Login',
        );
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



    public function login()
    {
        if($this->_identity===null)
        {
            $this->_identity = new UserIdentity($this->username,$this->password);
            $this->_identity->authenticate();
        }

        if($this->_identity->errorCode === UserIdentity::ERROR_NONE)
        {
            Yii::app()->user->login($this->_identity,3600*24*30);
            return true;
        }
        else
            return false;
    }

    public function register($data)
    {
        return Yii::app()->db->createCommand()->insert("users",[
            "username" => $data["username"],
            "email" => $data["email"],
            "password" => $data["password"],
        ]);
    }
}