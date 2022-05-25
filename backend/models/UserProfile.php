<?php

namespace backend\models;

use backend\behaviors\AvatarBehavior;
use common\models\User;
use Yii;

/**
 * This is the model class for table "{{%user_profile}}".
 *
 * @property int $user_id
 * @property int|null $surname
 * @property string|null $name
 * @property string|null $patronymic
 * @property int|null $birthday
 * @property string|null $about
 * @property string|null $avatar
 *
 * @property User $user
 */
class UserProfile extends \yii\db\ActiveRecord
{
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'birthday'], 'integer'],
            [['name', 'patronymic', 'surname'], 'string', 'max' => 32],
            [['about'], 'string', 'max' => 255],
            [['avatar'], 'file', 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024, 'on' => ['insert', 'update']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => \mohorev\file\UploadImageBehavior::class,
                'attribute' => 'avatar',
                'scenarios' => ['insert', 'update'],
                'path' => '@frontend/web/uploads/{id}',
                'url' => '/uploads/{id}',
                'thumbs' => [
                    'thumb' => ['width' => 400, 'quality' => 200],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'surname' => Yii::t('app', 'Фамилия'),
            'name' => Yii::t('app', 'Имя'),
            'patronymic' => Yii::t('app', 'Отчество'),
            'birthday' => Yii::t('app', 'День рождение'),
            'about' => Yii::t('app', 'О вас'),
            'avatar' => Yii::t('app', 'Аватар'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
