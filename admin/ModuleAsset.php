<?php
/**
 * Created by PhpStorm.
 * User: singletonn
 * Date: 8/24/18
 * Time: 4:41 PM
 */

namespace pantera\leads\admin;


use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class ModuleAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';
    public $js = [
        'js/script.js',
    ];

    public $depends = [
        JqueryAsset::class,
    ];
}