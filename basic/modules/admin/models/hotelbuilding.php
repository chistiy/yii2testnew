<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "hotelbuilding".
 *
 * @property int $id
 * @property string $hotelClass
 * @property int $numberOfFloors
 * @property int $numberOfRooms
 *
 * @property Floors[] $floors
 * @property Hotelroom[] $hotelrooms
 */
class hotelbuilding extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotelbuilding';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hotelClass', 'numberOfFloors', 'numberOfRooms'], 'required'],
            [['numberOfFloors', 'numberOfRooms'], 'integer'],
            [['hotelClass'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hotelClass' => 'Рейтинг',
            'numberOfFloors' => 'Этаж',
            'numberOfRooms' => 'Количество комнат',
        ];
    }

    /**
     * Gets query for [[Floors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFloors()
    {
        return $this->hasMany(Floors::className(), ['hotelBuilding' => 'id']);
    }

    /**
     * Gets query for [[Hotelrooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHotelrooms()
    {
        return $this->hasMany(Hotelroom::className(), ['hotelBuilding' => 'id']);
    }
}
