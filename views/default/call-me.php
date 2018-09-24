<?php
/**
 * Created by PhpStorm.
 * User: singletonn
 * Date: 9/24/18
 * Time: 1:33 PM
 */

use pantera\leads\models\CallMe;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model CallMe */
/* @var $key string */
$this->title = 'Заказать обратный звонок';

$form = ActiveForm::begin([
    'id' => 'lead-call-me-form',
    'action' => ['/leads/default/save', 'key' => $key],
]);

echo $form->field($model, 'name')->textInput([
    'placeholder' => 'Ваше имя',
]);

echo $form->field($model, 'phone')->textInput([
    'placeholder' => '+7(___)___-__-__',
]);

echo Html::submitButton(Html::tag('span', 'Отправить', [
    'class' => 'ladda-label',
]), [
    'class' => 'btn btn-success ladda-button',
    'data' => [
        'style' => 'zoom-in'
    ],
]);

ActiveForm::end();
