<?php


namespace app\models\hotel;


use yii\base\Model;

class Query1 extends Model
{
    public $countOfPeople;
    public $dateStart;
    public $dateEnd;

    public function rules(){
        return [
            [['countOfPeople', 'dateStart', 'dateEnd'], 'trim'],
        ];
    }

}