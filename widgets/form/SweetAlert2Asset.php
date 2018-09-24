<?php

namespace pantera\leads\widgets\form;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class SweetAlert2Asset extends AssetBundle
{
    public $sourcePath = '@bower/sweetalert2/dist';
    public $css = [
        'sweetalert2.min.css',
    ];
    public $js = [
        'sweetalert2.min.js'
    ];
    public $depends = [
        JqueryAsset::class,
    ];
}
