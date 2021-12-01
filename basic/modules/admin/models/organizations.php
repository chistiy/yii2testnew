<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "organizations".
 *
 * @property int $id
 * @property string|null $name
 * @property string $numberOfPhone
 * @property int $sale
 *
 * @property Booking[] $bookings
 * @property Clientbookingroom[] $clientbookingrooms
 */
class organizations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'organizations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numberOfPhone', 'sale'], 'required'],
            [['sale'], 'integer'],
            [['name', 'numberOfPhone'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'numberOfPhone' => 'Номер телефона',
            'sale' => 'Скидка',
        ];
    }

    /**
     * Gets query for [[Bookings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['organization' => 'id']);
    }

    /**
     * Gets query for [[Clientbookingrooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClientbookingrooms()
    {
        return $this->hasMany(Clientbookingroom::className(), ['organization' => 'id']);
    }
}
