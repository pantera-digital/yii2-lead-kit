<?php
/**
 * Created by PhpStorm.
 * User: singletonn
 * Date: 9/24/18
 * Time: 2:15 PM
 */

use yii\web\View;

/* @var $this View */
/* @var $content string */
?>
<?php $this->beginPage() ?>
<?php $this->beginBody() ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">✕</button>
    <div class="modal-title">
        <?= $this->title ?>
    </div>
</div>
<div class="modal-body">
    <?= $content ?>
</div>
<?php $this->endBody() ?>
<?php $this->endPage() ?>
