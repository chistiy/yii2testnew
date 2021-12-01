<?php


namespace app\models\hotel;


use yii\base\Model;

class Query2 extends Model
{
    public $id;
    public $name;
    public $numberOfBeds;
    public $hotelClass;
    public $hotelBuilding;
    public $dateStart;
    public $dateEnd;
    public $paymentForDay;
    public $cnt;

    public function rules(){
        return [
            [['id','name','cnt', 'numberOfBeds', 'hotelClass', 'hotelBuilding', 'dateStart', 'dateEnd', 'paymentForDay'], 'trim'],
        ];
    }

}