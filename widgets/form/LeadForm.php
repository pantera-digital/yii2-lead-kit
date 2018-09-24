<?php
/**
 * Created by PhpStorm.
 * User: singletonn
 * Date: 9/24/18
 * Time: 12:10 PM
 */

namespace pantera\leads\widgets\form;

use pantera\leads\traits\ModuleTrait;
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
    public $link;
    /* @var array Массив параметров ссылки */
    public $linkOptions = [];
    /* @var array Конфиг формы */
    private $_config;

    static $modalRender = false;

    public function run()
    {
        parent::run();
        $text = Html::tag('span', $this->link, [
            'class' => 'ladda-label',
        ]);
        return Html::a($text, ['/leads/default/modal', 'key' => $this->key], $this->linkOptions);
    }

    public function init()
    {
        parent::init();
        if (empty($this->key)) {
            throw new InvalidConfigException('Отсутствует параметр {key}');
        }
        $this->_config = $this->module->getConfig($this->key);
        if (array_key_exists('class', $this->linkOptions) === false) {
            Html::addCssClass($this->linkOptions, 'btn btn-default');
        }
        Html::addCssClass($this->linkOptions, 'ladda-button');
        $this->linkOptions = ArrayHelper::merge($this->linkOptions, [
            'data' => [
                'target' => '#modal-lead',
                'toggle' => 'modal',
                'style' => 'zoom-in',
            ],
        ]);
        Event::on(View::class, View::EVENT_END_BODY, function (Event $e) {
            if (self::$modalRender === false) {
                echo '<div class="modal modal-default" id="modal-lead">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>';
                self::$modalRender = true;
            }
        });
        LeadFormAsset::register($this->view);
    }
}