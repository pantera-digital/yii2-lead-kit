<?php
/**
 * Created by PhpStorm.
 * User: singletonn
 * Date: 9/24/18
 * Time: 11:56 AM
 */

namespace pantera\leads;

class Module extends \yii\base\Module
{
    /* @var array Массив ролей которым доступна админка */
    public $permissions = ['@'];

    public function getMenuItems()
    {
        return [
            ['label' => 'Leads', 'url' => ['/leads/default'], 'icon' => 'phone'],
        ];
    }
}