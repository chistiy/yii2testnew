<?php

namespace app\models\hotel;
use yii\db\ActiveRecord;

class Floors extends ActiveRecord
{
    public function getHotelbuilding()
    {
        return $this->hasOne(Hotelbuilding::className(), ['id' => 'hotelBuilding']);
    }

    public function getHotelrooms()
    {
        return $this->hasMany(Hotelroom::className(), ['floor' => 'id']);
    }
}