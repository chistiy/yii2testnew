<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "floors".
 *
 * @property int $id
 * @property string $numberOfFloor
 * @property int $numberOfRooms
 * @property int $hotelBuilding
 *
 * @property Hotelbuilding $hotelBuilding0
 * @property Hotelroom[] $hotelrooms
 */
class floors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'floors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numberOfFloor', 'numberOfRooms', 'hotelBuilding'], 'required'],
            [['numberOfRooms', 'hotelBuilding'], 'integer'],
            [['numberOfFloor'], 'string', 'max' => 5],
            [['hotelBuilding'], 'exist', 'skipOnError' => true, 'targetClass' => Hotelbuilding::className(), 'targetAttribute' => ['hotelBuilding' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'numberOfFloor' => 'Номер этажа',
            'numberOfRooms' => 'Номер комнаты',
            'hotelBuilding' => 'Корпус',
        ];
    }

    /**
     * Gets query for [[HotelBuilding0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHotelBuilding0()
    {
        return $this->hasOne(Hotelbuilding::className(), ['id' => 'hotelBuilding']);
    }

    /**
     * Gets query for [[Hotelrooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHotelrooms()
    {
        return $this->hasMany(Hotelroom::className(), ['floor' => 'id']);
    }
}
