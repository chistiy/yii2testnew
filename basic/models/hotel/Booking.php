<?php

namespace app\models\hotel;
use yii\db\ActiveRecord;

class Booking extends ActiveRecord
{

    public static function tableName()
    {
        return '{{booking}}';
    }

    public function getClients()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client']);
    }


    public function getOrganization()
    {
        return $this->hasOne(Organizations::className(), ['id' => 'organization']);
    }

    public function getHotelbuilding()
    {
        return $this->hasOne(Hotelbuilding::className(), ['id' => 'HotelBuilding']);
    }

    public function getHotelrooms()
    {
        return $this->hasMany(Hotelroom::className(), ['id'=>'room'])
            ->viaTable('clientbookingroom', ['booking' => 'id']);
    }
    public function getClientbookingroom()
    {
        return $this->hasMany(Clientbookingroom::className(), ['booking'=>'id']);
    }
}