<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property string $email
 * @property string $joinDate
 * @property int $level_id
 * @property string $avatar
 *
 * @property Comment[] $comments
 * @property News[] $news
 * @property Raputation[] $raputations
 * @property Raputation[] $raputations0
 * @property Thread[] $threads
 * @property Threadstar[] $threadstars
 * @property Level $level
 */
class TblUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'authKey', 'accessToken', 'email', 'level_id'], 'required'],
            [['joinDate'], 'safe'],
            [['level_id'], 'integer'],
            [['username'], 'string', 'max' => 20],
            [['password', 'authKey', 'accessToken', 'email'], 'string', 'max' => 50],
            [['avatar'], 'string', 'max' => 30],
            [['username'], 'unique'],
            [['level_id'], 'exist', 'skipOnError' => true, 'targetClass' => Level::className(), 'targetAttribute' => ['level_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'email' => 'Email',
            'joinDate' => 'Join Date',
            'level_id' => 'Level ID',
            'avatar' => 'Avatar',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaputations()
    {
        return $this->hasMany(Raputation::className(), ['pemberi_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaputations0()
    {
        return $this->hasMany(Raputation::className(), ['penerima_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThreads()
    {
        return $this->hasMany(Thread::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThreadstars()
    {
        return $this->hasMany(Threadstar::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(Level::className(), ['id' => 'level_id']);
    }
}
