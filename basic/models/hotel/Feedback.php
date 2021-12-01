<?php

namespace app\models\hotel;
use yii\db\ActiveRecord;

class Feedback extends ActiveRecord
{
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client']);
    }

    public function getOrganization()
    {
        return $this->hasOne(Organizations::className(), ['id' => 'organization']);
    }

}