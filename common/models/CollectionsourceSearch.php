<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Collectionsources;

/**
 * CollectionsourceSearch represents the model behind the search form about `common\models\Collectionsources`.
 */
class CollectionsourceSearch extends Collectionsources
{
    
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['Copies','Code', 'Name', 'CreateBy', 'CreateDate', 'CreateTerminal', 'UpdateBy', 'UpdateDate', 'UpdateTerminal'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Collectionsources::find();
        $queryCollections = Collections::find()
                ->select('Source_id,count(ID) AS Copies')
                ->groupby('Source_id');
        $query->leftJoin(['collectionCount' => $queryCollections],' collectionCount.Source_id = collectionsources.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'ID',
                'Code',
                'Name',
                'Copies' => [
                    'asc' => ['collectionCount.Copies' => SORT_ASC],
                    'desc' => ['collectionCount.Copies' => SORT_DESC],
                    'label' => 'Jumlah Koleksi',
                    'default' => SORT_ASC
                ],
            ]
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }


        $query->andFilterWhere([
            'ID' => $this->ID,
            //'IsDelete' => $this->IsDelete,
            'CreateDate' => $this->CreateDate,
            'UpdateDate' => $this->UpdateDate,
        ]);

        $query->andFilterWhere(['like', 'collectionsources.Code', $this->Code])
            ->andFilterWhere(['like', 'collectionsources.Name', $this->Name])
            ->andFilterWhere(['like', 'CreateBy', $this->CreateBy])
            ->andFilterWhere(['like', 'CreateTerminal', $this->CreateTerminal])
            ->andFilterWhere(['like', 'UpdateBy', $this->UpdateBy])
            ->andFilterWhere(['like', 'UpdateTerminal', $this->UpdateTerminal])
            ->andFilterWhere(['like', 'collectionCount.Copies', $this->Copies]);

        return $dataProvider;
    }
}
