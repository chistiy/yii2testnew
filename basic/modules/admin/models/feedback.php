<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property int $id
 * @property int $client
 * @property string $feedback
 * @property string|null $textOfComplaint
 *
 * @property Clients $client0
 */
class feedback extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client', 'feedback'], 'required'],
            [['client'], 'integer'],
            [['feedback', 'textOfComplaint'], 'string'],
            [['client'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client' => 'id']],
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
            'feedback' => 'Отзыв',
            'textOfComplaint' => 'Текст жалобы',
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
}
