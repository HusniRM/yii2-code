<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;


/**
 * This is the model class for table "post".
 *
 * @property string $id
 * @property string $title
 * @property string $body
 * @property string $created_at
 * @property string $updated_at
 */
class Post extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'body'], 'required'],
            [['body'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'body' => 'Body',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
