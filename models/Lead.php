<?php

namespace pantera\leads\models;

use Yii;

/**
 * This is the model class for table "{{%lead}}".
 *
 * @property int $id
 * @property string $ip
 * @property string $user_agent
 * @property string $created_at
 * @property string $data
 */
class Lead extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lead}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ip', 'user_agent'], 'required'],
            [['user_agent', 'data'], 'string'],
            [['created_at'], 'safe'],
            [['ip'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'Ip',
            'user_agent' => 'User Agent',
            'created_at' => 'Created At',
            'data' => 'Data',
        ];
    }
}
