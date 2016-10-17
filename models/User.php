<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    const ROLE_ADMIN = 20;
    const ROLE_USER = 0;

    public static function tableName()
    {
        return 'user';
    }

    //добавление пользователя
    public function addUser($validPost)
    {   
        $user = new User();
        $user->username = $validPost['username'];
        $user->password = \Yii::$app->getSecurity()->generatePasswordHash($validPost['password']);
        $user->email = $validPost['email'];
        $user->address = $validPost['address'];
        $user->phone = $validPost['phone'];
        $user->save();
    
    return $user;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
         return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public static function findByUserMail($mail)
    {
        return static::findOne(['email' => $mail]);
    }

    public static function getUserEmail($email)
        {
            return static::findOne(['email' => $email]);
        }
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        //Yii::$app->getSecurity()->validatePassword($password, $hash)
        return \Yii::$app->security->validatePassword($password, $this->password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = \Yii::$app->security->generateRandomString();
    }

    public function getAllUsers ()
    {
        $users = new User();
        $users = $users->find()->orderBy('id desc')->all();
        return $users;
    }

    public function editUser ($id, $validPost)
    {
        $user = User::findOne($id);
        $user->username = $validPost['username'];
        $user->password = \Yii::$app->getSecurity()->generatePasswordHash($validPost['password']);
        $user->email = $validPost['email'];
        $user->phone = $validPost['phone'];
        $user->address = $validPost['address'];
        $user->save();
    
    return $user;
    }

     public function delUser ($id)
    {
        $user = User::findOne($id);
        $user->delete();
    }

    //Используя метод findOne ищем запись с соответствующим именем и ролью Администратора. Если запись не будет найдена, возвращаем false.
    public static function isUserAdmin($username)
    {
        if (static::findOne(['username' => $username, 'salt' => self::ROLE_ADMIN]))
        {
            return true;
        } else {
            return false;
        }
    }

    public static function isUser($username)
    {
        if (static::findOne(['username' => $username, 'salt' => self::ROLE_USER]))
        {
            return true;
        } else {
            return false;
        }
    }
}
