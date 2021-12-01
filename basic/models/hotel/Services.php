<?php

namespace app\models\hotel;
use yii\db\ActiveRecord;

class Services extends ActiveRecord
{
    public function getPaymentforservices()
    {
        return $this->hasMany(Paymentforservices::className(), ['service' => 'id']);
    }
}