<?php

namespace app\models\hotel;
use http\Client;
use yii\db\ActiveRecord;

class Clientbookingroom extends ActiveRecord
{
    public function getOrganizations()
    {
        return $this->hasMany(Organizations::className(), ['id' => 'organization']);
    }

    public function getHotelrooms()
    {
        return $this->hasMany(Hotelroom::className(), ['id' => 'room']);
    }

    public function getClients()
    {
        return $this->hasMany(Client::className(), ['id' => 'client']);
    }

    public function getBooking()
    {
        return $this->hasMany(Booking::className(), ['id' => 'booking']);
    }

}