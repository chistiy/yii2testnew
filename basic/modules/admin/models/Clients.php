<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property int $id
 * @property string|null $name
 * @property string $numberOfPhone
 * @property int $isNewClient
 *
 * @property Booking[] $bookings
 * @property Clientbookingroom[] $clientbookingrooms
 * @property Feedback[] $feedbacks
 * @property Paymentforservices[] $paymentforservices
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numberOfPhone'], 'required'],
            [['isNewClient'], 'integer'],
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
            'name' => 'Имя',
            'numberOfPhone' => 'Номер телефона',
            'isNewClient' => 'Новый клиент',
        ];
    }

    /**
     * Gets query for [[Bookings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['client' => 'id']);
    }

    /**
     * Gets query for [[Clientbookingrooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClientbookingrooms()
    {
        return $this->hasMany(Clientbookingroom::className(), ['client' => 'id']);
    }

    /**
     * Gets query for [[Feedbacks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['client' => 'id']);
    }

    /**
     * Gets query for [[Paymentforservices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentforservices()
    {
        return $this->hasMany(Paymentforservices::className(), ['client' => 'id']);
    }
}
