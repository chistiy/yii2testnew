<?php

namespace app\models\hotel;
use yii\db\ActiveRecord;

class Clients extends ActiveRecord
{
    public function getBooking()
    {
        return $this->hasMany(Booking::className(), ['client' => 'id']);
    }

    public function getFeedback()
    {
        return $this->hasMany(Feedback::className(), ['client' => 'id']);
    }

    public function getPaymentforservices()
    {
        return $this->hasMany(Paymentforservices::className(), ['client' => 'id']);
    }

    public function getHotelrooms()
    {
        return $this->hasMany(Hotelroom::className(), ['id'=>'room'])
            ->viaTable('clientbookingroom', ['client' => 'id']);
    }

    public function getClientbookingroom()
    {
        return $this->hasMany(Clientbookingroomn::className(), ['client'=>'id']);
    }

    public function getServices()
    {
        return $this->hasMany(Services::className(), ['id' => 'service'])
            ->viaTable('paymentforservices', ['client' => 'id']);

    }

}