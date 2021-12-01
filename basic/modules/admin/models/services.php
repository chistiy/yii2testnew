<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 *
 * @property Paymentforservices[] $paymentforservices
 */
class services extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 122],
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
            'description' => 'Описание',
        ];
    }

    /**
     * Gets query for [[Paymentforservices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentforservices()
    {
        return $this->hasMany(Paymentforservices::className(), ['service' => 'id']);
    }
}
