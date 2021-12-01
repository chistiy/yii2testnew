<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property int $id
 * @property string $startOfBooking
 * @property string $endOfBooking
 * @property int|null $client
 * @property int|null $organization
 * @property int|null $countOfPeople
 * @property int $totalSum
 *
 * @property Clients $client0
 * @property Organizations $organization0
 * @property Clientbookingroom[] $clientbookingrooms
 */
class booking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['startOfBooking', 'endOfBooking'], 'required'],
            [['startOfBooking', 'endOfBooking'], 'safe'],
            [['client', 'organization', 'countOfPeople', 'totalSum'], 'integer'],
            [['client'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client' => 'id']],
            [['organization'], 'exist', 'skipOnError' => true, 'targetClass' => Organizations::className(), 'targetAttribute' => ['organization' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'startOfBooking' => 'Начало бронирования',
            'endOfBooking' => 'Конец бронирования',
            'client' => 'Клиент',
            'organization' => 'Организация',
            'countOfPeople' => 'Количество человек',
            'totalSum' => 'Общая сумма',
        ];
    }

    /**
     * Gets query for [[Client0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClientinfo()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client']);
    }

    /**
     * Gets query for [[Organization0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationinfo()
    {
        return $this->hasOne(Organizations::className(), ['id' => 'organization']);
    }

    /**
     * Gets query for [[Clientbookingrooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClientbookingrooms()
    {
        return $this->hasMany(Clientbookingroom::className(), ['booking' => 'id']);
    }
}
