<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    public static function tableName()
    {
        return 'user';
    }
    // не пойму почему эти переменные пустые

    //добавление пользователя
    public function addUser($validPost)
    {
        $user = new User();
        $user->username = $validPost['username'];
        $user->password = \Yii::$app->getSecurity()->generatePasswordHash($validPost['password']);
        $user->email = $validPost['email'];
        $user->phone = $validPost['phone'];
        $user->address = $validPost['address'];
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

    //helper для auth_key
    // почитать для чего используеться
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
    
    return $meal;
    }

     public function delUser ($id)
    {
        $user = User::findOne($id);
        $user->delete();
    }
}
