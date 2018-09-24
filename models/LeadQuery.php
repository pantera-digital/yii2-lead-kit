<?php
/**
 * Created by PhpStorm.
 * User: singletonn
 * Date: 9/24/18
 * Time: 4:33 PM
 */

namespace pantera\leads\models;


use yii\db\ActiveQuery;

/**
 * Class LeadQuery
 * @package pantera\leads\models
 *
 * @see Lead
 */
class LeadQuery extends ActiveQuery
{
    /**
     * Только не прочитанные
     * @return LeadQuery
     */
    public function isNotViewed(): self
    {
        return $this->andWhere(['=', Lead::tableName() . '.is_viewed', 0]);
    }
}