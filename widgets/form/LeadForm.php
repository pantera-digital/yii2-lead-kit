<?php
/**
 * Created by PhpStorm.
 * User: singletonn
 * Date: 9/24/18
 * Time: 12:10 PM
 */

namespace pantera\leads\widgets\form;

use pantera\leads\traits\ModuleTrait;
use Yii;
use yii\base\Event;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use function array_key_exists;

class LeadForm extends Widget
{
    use ModuleTrait;

    /* @var string Ключ по которому нужно получить конфиг формы */
    public $key;
    /* @var string Содержимое ссылки */
    public $text;
    /* @var array Массив параметров ссылки */
    public $options = [];
    /* @var bool Флаг что нужно загрузить форму асинхронно */
    public $ajaxMode = true;
    /* @var array Конфиг формы */
    private $_config;

    public function run()
    {
        parent::run();
        $text = Html::tag('span', $this->text, [
            'class' => 'ladda-label',
        ]);
        if ($this->ajaxMode) {
            return Html::a($text, ['/leads/default/modal', 'key' => $this->key], $this->options);
        } else {
            return Html::button($text, $this->options);
        }
    }

    public function init()
    {
        parent::init();
        if (empty($this->key)) {
            throw new InvalidConfigException('Отсутствует параметр {key}');
        }
        $this->_config = $this->module->getConfig($this->key);
        if (array_key_exists('class', $this->options) === false) {
            Html::addCssClass($this->options, 'btn btn-default');
        }
        Html::addCssClass($this->options, 'ladda-button open-lead-modal');
        $id = $this->getId() . '-' . $this->key;
        $this->options = ArrayHelper::merge($this->options, [
            'data' => [
                'target' => '#' . $id,
                'toggle' => 'modal',
                'style' => 'zoom-in',
            ],
        ]);
        Event::on(View::class, View::EVENT_END_BODY, function (Event $e) use ($id) {
            $content = '';
            $options = [
                'id' => $id,
                'class' => 'modal modal-default lead-modal',
            ];
            if ($this->ajaxMode === false) {
                $model = Yii::createObject($this->_config['className']);
                $content = $this->render($this->_config['view'], [
                    'key' => $this->key,
                    'model' => $model,
                ]);
                $content = $this->render('@pantera/leads/views/layouts/modal', [
                    'content' => $content,
                ]);
            } else {
                Html::addCssClass($options, 'lead-modal--ajax');
            }
            $modalContent = Html::tag('div', $content, [
                'class' => 'modal-content',
            ]);
            $modalDialog = Html::tag('div', $modalContent, [
                'class' => 'modal-dialog',
            ]);
            echo Html::tag('div', $modalDialog, $options);
        });
        LeadFormAsset::register($this->view);
    }
}