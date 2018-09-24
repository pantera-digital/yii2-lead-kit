<?php
/**
 * Created by PhpStorm.
 * User: singletonn
 * Date: 9/24/18
 * Time: 12:12 PM
 */

namespace pantera\leads\admin;

use pantera\leads\models\Lead;
use function is_null;

class Module extends \yii\base\Module
{
    /* @var array Массив ролей которым доступна админка */
    public $permissions = ['@'];
    /* @var int|null Количество не прочитанных заявок */
    private $_countNotViewed;

    public function getMenuItems()
    {
        $item = [
            'label' => 'Leads',
            'url' => ['/leads/default/index'],
            'icon' => 'phone',
        ];
        if ($this->getCountNotViewed()) {
            $item['badge'] = $this->getCountNotViewed();
            $item['badgeOptions'] = [
                'class' => 'label-info',
            ];
        }
        return [
            $item,
        ];
    }

    /**
     * Получить количество не прочитанных заявок
     * @return int
     */
    public function getCountNotViewed(): int
    {
        if (is_null($this->_countNotViewed)) {
            $this->_countNotViewed = Lead::find()
                ->isNotViewed()
                ->count();
        }
        return $this->_countNotViewed;
    }
}