<?php

namespace pantera\leads\models;

use Yii;
use function get_class_vars;
use function implode;
use function nl2br;

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
     * Получить все поля модели ввиде простой строчки
     * @return string
     */
    public function toText(): string
    {
        $properties = [];
        foreach ($this->getAllProperty() as $propertyName => $propertyValue) {
            $label = $this->getAttributeLabel($propertyName);
            $properties[] = $label . ': ' . $propertyValue;
        }
        return implode("\n", $properties);
    }

    /**
     * Получить все поля модели ввиде html
     * @return string
     */
    public function toHtml(): string
    {
        return nl2br($this->toText());
    }

    /**
     * Получить массив всех свойст и их значения
     * @return array
     */
    protected function getAllProperty()
    {
        $objectVars = get_class_vars(static::class);
        $properties = [];
        foreach ($objectVars as $key => $value) {
            $properties[$key] = $this->{$key};
        }
        return $properties;
    }

    public function beforeValidate()
    {
        $this->ip = Yii::$app->request->getUserIP();
        $this->user_agent = Yii::$app->request->getUserAgent();
        $this->data = $this->toText();
        return parent::beforeValidate();
    }

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
