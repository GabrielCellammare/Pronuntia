<?php

namespace app\models\attori;

use Yii;
use yii\base\Model;
use app\models\attori\Utente;
use app\models\User;
use yii\data\ActiveDataProvider;

/**
 * GestioneUtente represents the model behind the search form of `app\models\attori\Utente`.
 */
class GestioneUtente extends Utente
{

    public function rules()
    {
        return [
            [['id', 'idLogopedista'], 'integer'],
            [['codiceFiscale', 'nome', 'cognome', 'dataDiNascita', 'residenza', 'numeroDiTelefono', 'idLogopedista'], 'safe'],
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

    public static function tableName()
    {
        return "{{utente}}";
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
        $cond = ["idLogopedista" => User::getShortId()];
        $query = Utente::find()->where($cond);

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
            'dataDiNascita' => $this->dataDiNascita,
            'idLogopedista' => $this->idLogopedista,
        ]);

        $query->andFilterWhere(['like', 'codiceFiscale', $this->codiceFiscale])
            ->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'cognome', $this->cognome])
            ->andFilterWhere(['like', 'residenza', $this->residenza])
            ->andFilterWhere(['like', 'numeroDiTelefono', $this->numeroDiTelefono]);

        return $dataProvider;
    }
}
