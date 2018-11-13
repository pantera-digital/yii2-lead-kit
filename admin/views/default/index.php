<?php

use pantera\leads\admin\components\ToggleColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel \pantera\leads\admin\models\LeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Leads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lead-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <p>
        <?= Html::a('Удалить выбранное', ['delete-group'], [
            'class' => 'btn btn-danger leads-group-delete',
        ]) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'cssClass' => 'selection',
                'options' => [
                    'style' => 'width: 20px !important;'
                ],
                'contentOptions' => [
                    'style' => 'width: 20px !important;'
                ],
            ],
            'id',
            'key',
            'ip',
            [
                'attribute' => 'user_agent',
                'contentOptions' => [
                    'style' => 'white-space: normal;',
                ],
            ],
            'referrer',
            'created_at:datetime',
            'data:ntext',
            [
                'class' => ToggleColumn::class,
                'attribute' => 'is_viewed',
                'onText' => 'Прочитать',
                'offText' => 'Прочитано',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
