<?php
/**
 * Created by PhpStorm.
 * User: singletonn
 * Date: 9/24/18
 * Time: 12:15 PM
 */

namespace pantera\leads\controllers;

use pantera\leads\models\Lead;
use pantera\leads\Module;
use Yii;
use yii\filters\AjaxFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use function is_null;

class DefaultController extends Controller
{
    /* @var Module */
    public $module;

    public function behaviors()
    {
        return [
            [
                'class' => AjaxFilter::class,
                'only' => ['modal', 'save'],
            ],
        ];
    }

    /**
     * Рендеринг модалки с формой
     * @return string
     * @throws BadRequestHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionModal()
    {
        $config = $this->getConfig();
        /* @var $model Lead */
        $model = Yii::createObject($config['className']);
        $this->layout = 'modal';
        return $this->render($config['view'], [
            'model' => $model,
            'key' => Yii::$app->request->get('key'),
        ]);
    }

    /**
     * Сохранение данных с формы
     * @return \yii\web\Response
     * @throws BadRequestHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionSave()
    {
        $config = $this->getConfig();
        /* @var $model Lead */
        $model = Yii::createObject($config['className']);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $result = [
                'status' => true,
                'swal' => [
                    'title' => $config['swal-title'],
                    'html' => $config['swal-html'],
                    'btn' => $config['swal-btn'],
                ],
            ];
        } else {
            $result = [
                'status' => false,
            ];
        }
        return $this->asJson($result);
    }

    protected function getConfig(): array
    {
        $key = Yii::$app->request->get('key');
        if (is_null($key)) {
            throw new BadRequestHttpException('Отсутствует параметр {key}');
        }
        return $this->module->getConfig($key);
    }
}