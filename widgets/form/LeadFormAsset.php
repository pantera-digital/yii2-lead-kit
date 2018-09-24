<?php
/**
 * Created by PhpStorm.
 * User: singletonn
 * Date: 9/24/18
 * Time: 1:44 PM
 */

namespace pantera\leads\widgets\form;


use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class LeadFormAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';

    public $js = [
        'js/script.js',
    ];

    public $depends = [
        JqueryAsset::class,
        BootstrapPluginAsset::class,
        LaddaAsset::class,
        SweetAlert2Asset::class,
    ];
}