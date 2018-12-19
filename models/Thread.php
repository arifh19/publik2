<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "thread".
 *
 * @property int $id
 * @property string $judul
 * @property string $isi
 * @property int $user_id
 * @property string $daerah
 * @property string $file
 * @property string $agreement
 * @property int $kategori_id
 * @property string $tanggalPost
 *
 * @property Comment[] $comments
 * @property User $user
 * @property Kategori $kategori
 * @property Threadstar[] $threadstars
 */
class Thread extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'thread';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['judul', 'isi', 'user_id', 'daerah', 'file', 'agreement', 'kategori_id'], 'required'],
            [['isi'], 'string'],
            [['user_id', 'kategori_id'], 'integer'],
            [['tanggalPost'], 'safe'],
            [['judul'], 'string', 'max' => 255],
            [['daerah', 'file', 'agreement'], 'string', 'max' => 50],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['kategori_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kategori::className(), 'targetAttribute' => ['kategori_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'judul' => 'Judul',
            'isi' => 'Isi',
            'user_id' => 'User ID',
            'daerah' => 'Daerah',
            'file' => 'File',
            'agreement' => 'Agreement',
            'kategori_id' => 'Kategori ID',
            'tanggalPost' => 'Tanggal Post',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['thread_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategori()
    {
        return $this->hasOne(Kategori::className(), ['id' => 'kategori_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThreadstars()
    {
        return $this->hasMany(Threadstar::className(), ['thread_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ThreadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ThreadQuery(get_called_class());
    }
}
