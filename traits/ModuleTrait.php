<?php

namespace pantera\leads\traits;

use pantera\leads\Module;
use Yii;

/**
 * Created by PhpStorm.
 * User: singletonn
 * Date: 9/13/18
 * Time: 2:35 PM
 *
 * @property Module $module
 */
trait ModuleTrait
{
    public function getModule()
    {
        return Yii::$app->getModule('leads');
    }
}