<?php

namespace app\models\hotel;
use app\models\hotel\Booking;
use app\models\hotel\Floors;
use app\models\hotel\Hotelroom;
use yii\db\ActiveRecord;

class Hotelbuilding extends ActiveRecord
{
    public function getFloors()
    {
        return $this->hasMany(Floors::className(), ['hotelBuilding' => 'id']);
    }

    public function getHotelrooms()
    {
        return $this->hasMany(Hotelroom::className(), ['hotelBuilding' => 'id']);
    }

    public function getBooking()
    {
        return $this->hasMany(Booking::className(), ['hotelBuilding' => 'id']);
    }
}