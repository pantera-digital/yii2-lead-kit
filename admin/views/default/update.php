<?php
/**
 * Created by PhpStorm.
 * User: singletonn
 * Date: 11/13/18
 * Time: 12:29 PM
 */

use kartik\form\ActiveForm;
use pantera\leads\models\Lead;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model Lead */
?>
<?php $form = ActiveForm::begin([
    'disabled' => true,
]) ?>

<?= $form->field($model, 'ip') ?>

<?= $form->field($model, 'user_agent') ?>

<?= $form->field($model, 'referrer') ?>

<?= $form->field($model, 'created_at') ?>

<?= $form->field($model, 'data')->textarea([
    'rows' => 10,
    'disabled' => false,
]) ?>

<?= Html::submitButton('Сохранить', [
    'class' => 'btn btn-success',
]) ?>

<?php ActiveForm::end();
