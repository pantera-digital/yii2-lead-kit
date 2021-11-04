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
    public $mode = self::MODE_AJAX;
    /* @var bool Флаг нужно ли отрендерить модалку */
    public $isRenderModal = true;
    /* @var array Конфиг формы */
    protected $_config;

    /* @var string Форма будет загруженна асинхронно */
    const MODE_AJAX = 'ajax';
    /* @var string Форма с модалкой рендерится сразу */
    const MODE_DEFAULT = 'default';
    /* @var string Инлайн форма */
    const MODE_INLINE = 'inline';

    public function run()
    {
        parent::run();
        $text = Html::tag('span', $this->text, [
            'class' => 'ladda-label',
        ]);
        if ($this->mode === self::MODE_AJAX) {
            return Html::a($text, ['/leads/default/modal', 'key' => $this->key], $this->options);
        } elseif ($this->mode === self::MODE_DEFAULT) {
            return Html::button($text, $this->options);
        } else {
            $model = Yii::createObject($this->_config['className']);
            return $this->render($this->_config['view'], [
                'key' => $this->key,
                'model' => $model,
            ]);
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
        if ($this->mode !== self::MODE_INLINE && $this->isRenderModal) {
            Event::on(View::class, View::EVENT_END_BODY, function () use ($id) {
                $content = '';
                $options = [
                    'id' => $id,
                    'class' => 'modal modal-default lead-modal',
                ];
                if ($this->mode === self::MODE_DEFAULT) {
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
        }
        LeadFormAsset::register($this->view);
    }
}