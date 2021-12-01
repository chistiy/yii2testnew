<?php

namespace app\models\hotel;
use yii\db\ActiveRecord;

class Organizations extends ActiveRecord
{

    public function getBooking()
    {
        return $this->hasMany(Booking::className(), ['organization' => 'id']);
    }

    public function getFeedback()
    {
        return $this->hasMany(Feedback::className(), ['organization' => 'id']);
    }

    public function getHotelrooms()
    {
        return $this->hasMany(Hotelroom::className(), ['id'=>'room'])
            ->viaTable('clientbookingroom', ['organization' => 'id']);
    }

    public function getClientbookingroom()
    {
        return $this->hasMany(Clientbookingroom::className(), ['organization'=>'id']);
    }

}