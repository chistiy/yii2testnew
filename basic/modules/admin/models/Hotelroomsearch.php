<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Hotelroom;

/**
 * Hotelroomsearch represents the model behind the search form of `app\modules\admin\models\Hotelroom`.
 */
class Hotelroomsearch extends Hotelroom
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'hotelBuilding', 'floor', 'paymentForDay', 'expensesForDay', 'isNotFree'], 'integer'],
            [['numberOfBeds'], 'safe'],
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
        $query = Hotelroom::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'hotelBuilding' => $this->hotelBuilding,
            'floor' => $this->floor,
            'paymentForDay' => $this->paymentForDay,
            'expensesForDay' => $this->expensesForDay,
            'isNotFree' => $this->isNotFree,
        ]);

        $query->andFilterWhere(['like', 'numberOfBeds', $this->numberOfBeds]);

        return $dataProvider;
    }
}
