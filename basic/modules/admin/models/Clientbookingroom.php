<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "clientbookingroom".
 *
 * @property int $id
 * @property int|null $booking
 * @property int|null $room
 * @property int|null $client
 * @property int|null $organization
 * @property int|null $isBookedNow
 *
 * @property Booking $booking0
 * @property Clients $client0
 * @property Organizations $organization0
 * @property Hotelroom $room0
 */
class Clientbookingroom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clientbookingroom';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['booking', 'room', 'client', 'organization', 'isBookedNow'], 'integer'],
            [['booking'], 'exist', 'skipOnError' => true, 'targetClass' => Booking::className(), 'targetAttribute' => ['booking' => 'id']],
            [['client'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client' => 'id']],
            [['organization'], 'exist', 'skipOnError' => true, 'targetClass' => Organizations::className(), 'targetAttribute' => ['organization' => 'id']],
            [['room'], 'exist', 'skipOnError' => true, 'targetClass' => Hotelroom::className(), 'targetAttribute' => ['room' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'booking' => 'Бронирование',
            'room' => 'Комната',
            'client' => 'Клиент',
            'organization' => 'Организация',
            'isBookedNow' => 'сейчас занято',
        ];
    }

    /**
     * Gets query for [[Booking0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooking0()
    {
        return $this->hasOne(Booking::className(), ['id' => 'booking']);
    }

    /**
     * Gets query for [[Client0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient0()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client']);
    }

    /**
     * Gets query for [[Organization0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization0()
    {
        return $this->hasOne(Organizations::className(), ['id' => 'organization']);
    }

    /**
     * Gets query for [[Room0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoom0()
    {
        return $this->hasOne(Hotelroom::className(), ['id' => 'room']);
    }
}
