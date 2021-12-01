<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "paymentforservices".
 *
 * @property int $id
 * @property int $client
 * @property int $service
 * @property int $cost
 *
 * @property Clients $client0
 * @property Services $service0
 */
class paymentforservices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paymentforservices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client', 'service', 'cost'], 'required'],
            [['client', 'service', 'cost'], 'integer'],
            [['client'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client' => 'id']],
            [['service'], 'exist', 'skipOnError' => true, 'targetClass' => Services::className(), 'targetAttribute' => ['service' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client' => 'Клиент',
            'service' => 'Услуга',
            'cost' => 'Стоимость',
        ];
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
     * Gets query for [[Service0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService0()
    {
        return $this->hasOne(Services::className(), ['id' => 'service']);
    }
}
