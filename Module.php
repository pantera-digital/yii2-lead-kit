<?php
/**
 * Created by PhpStorm.
 * User: singletonn
 * Date: 9/24/18
 * Time: 11:56 AM
 */

namespace pantera\leads;

use pantera\leads\models\CallMe;
use pantera\leads\models\Question;
use yii\base\InvalidArgumentException;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use function array_walk;
use function class_exists;

class Module extends \yii\base\Module
{
    public $config;

    public function init()
    {
        parent::init();
        $this->config = ArrayHelper::merge([
            'callMe' => [
                'className' => CallMe::class,
                'view' => '@pantera/leads/views/default/call-me',
            ],
            'question' => [
                'className' => Question::class,
                'view' => '@pantera/leads/views/default/question',
            ],
        ], $this->config);
        array_walk($this->config, function (&$item) {
            $item['swal-title'] = ArrayHelper::getValue($item, 'swal-title', 'Мы Вам перезвоним');
            $item['swal-html'] = ArrayHelper::getValue($item, 'swal-html', 'Благодарим! Наш менеджер свяжется с Вами в самое ближайшее время');
            $item['swal-btn'] = ArrayHelper::getValue($item, 'swal-btn', 'Ок');
        });
    }

    /**
     * Получить конфиг формы по ключу
     * @param string $key Ключ по которму будем искать конфиг
     * @return array
     * @throws InvalidConfigException
     */
    public function getConfig(string $key): array
    {
        $config = ArrayHelper::getValue($this->config, $key);
        if (is_null($config)) {
            throw new InvalidArgumentException('По переданному ключу не найден конфиг');
        }
        $className = ArrayHelper::getValue($config, 'className');
        if (class_exists($className) === false) {
            throw new InvalidConfigException('Класс {' . $className . '} не найден');
        }
        return $config;
    }
}