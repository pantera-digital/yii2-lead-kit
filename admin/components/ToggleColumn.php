<?php

namespace pantera\leads\admin\components;

use yii\helpers\Html;

/**
 * Created by PhpStorm.
 * User: singletonn
 * Date: 9/24/18
 * Time: 4:45 PM
 */
class ToggleColumn extends \pheme\grid\ToggleColumn
{
    protected function renderDataCellContent($model, $key, $index)
    {
        $url = [$this->action, 'id' => $model->{$this->primaryKey}];
        $attribute = $this->attribute;
        $value = $model->$attribute;
        $options = [
            'class' => 'toggle-column btn btn-xs',
            'data-method' => 'post',
            'data-pjax' => '0',
        ];
        if ($value === null || $value == true) {
            Html::addCssClass($options, 'btn-default');
            $title = $this->offText;
        } else {
            Html::addCssClass($options, 'btn-info');
            $title = $this->onText;
        }
        return Html::a($title, $url, $options);
    }
}