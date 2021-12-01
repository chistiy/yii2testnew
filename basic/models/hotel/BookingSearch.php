<?php

namespace app\models\hotel;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\hotel\Booking;

/**
 * BookingSearch represents the model behind the search form of `app\modules\admin\models\Booking`.
 */
class BookingSearch extends Booking
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'client', 'organization', 'countOfPeople', 'totalSum'], 'integer'],
            [['startOfBooking', 'endOfBooking'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Booking::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'startOfBooking' => $this->startOfBooking,
            'endOfBooking' => $this->endOfBooking,
            'client' => $this->client,
            'organization' => $this->organization,
            'countOfPeople' => $this->countOfPeople,
            'totalSum' => $this->totalSum,
        ]);

        return $dataProvider;
    }
}
