<?php

namespace app\models\hotel;
use yii\db\ActiveRecord;

class Paymentforservices extends ActiveRecord
{
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client']);
    }

    public function getService()
    {
        return $this->hasOne(Services::className(), ['id' => 'service']);
    }

}