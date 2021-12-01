<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "hotelroom".
 *
 * @property int $id
 * @property string $numberOfBeds
 * @property int $hotelBuilding
 * @property int $floor
 * @property int $paymentForDay
 * @property int $expensesForDay
 * @property int $isNotFree
 *
 * @property Clientbookingroom[] $clientbookingrooms
 * @property Hotelbuilding $hotelBuilding0
 * @property Floors $floor0
 */
class hotelroom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotelroom';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numberOfBeds', 'hotelBuilding', 'floor', 'paymentForDay', 'expensesForDay'], 'required'],
            [['hotelBuilding', 'floor', 'paymentForDay', 'expensesForDay', 'isNotFree'], 'integer'],
            [['numberOfBeds'], 'string', 'max' => 30],
            [['hotelBuilding'], 'exist', 'skipOnError' => true, 'targetClass' => Hotelbuilding::className(), 'targetAttribute' => ['hotelBuilding' => 'id']],
            [['floor'], 'exist', 'skipOnError' => true, 'targetClass' => Floors::className(), 'targetAttribute' => ['floor' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'numberOfBeds' => 'Мест',
            'hotelBuilding' => 'Корпус',
            'floor' => 'этаж',
            'paymentForDay' => 'Цена за день',
            'expensesForDay' => 'Затраты',
            'isNotFree' => 'Не свободна',
        ];
    }

    /**
     * Gets query for [[Clientbookingrooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClientbookingrooms()
    {
        return $this->hasMany(Clientbookingroom::className(), ['room' => 'id']);
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
     * Gets query for [[Floor0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFloor0()
    {
        return $this->hasOne(Floors::className(), ['id' => 'floor']);
    }
}
