<?php

namespace app\models\hotel;
use yii\db\ActiveRecord;

class Hotelroom extends ActiveRecord
{
    public function getHotelBuildings()
    {
        return $this->hasOne(Hotelbuilding::className(), ['id' => 'hotelBuilding']);
    }

    public function getFloors()
    {
        return $this->hasOne(Floors::className(), ['id' => 'floor']);
    }

    public function getBooking()
    {
        return $this->hasMany(Booking::className(), ['id'=>'booking'])
            ->viaTable('clientbookingroom', ['room' => 'id']);
    }

    public function getClientbookingroom()
    {
        return $this->hasMany(Clientbookingroom::className(), ['room'=>'id']);
    }

    public function getOrganizations()
    {
        return $this->hasMany(Organizations::className(), ['id'=>'organization'])
            ->viaTable('clientbookingroom', ['room' => 'id']);
    }

    public function getClients()
    {
        return $this->hasMany(Clients::className(), ['id'=>'client'])
            ->viaTable('clientbookingroom', ['room' => 'id']);
    }

}