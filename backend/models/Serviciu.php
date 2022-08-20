<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "serviciu".
 *
 * @property int $id
 * @property string $denumire
 * @property int $pret
 * @property string $periodicitate
 *
 * @property Tratament[] $trataments
 */
class Serviciu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'serviciu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['denumire', 'pret', 'periodicitate'], 'required'],
            [['pret'], 'integer'],
            [['denumire','periodicitate'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'denumire' => 'Denumire',
            'pret' => 'Pret',
            'periodicitate' => 'Periodicitate',
        ];
    }

    /**
     * Gets query for [[Trataments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrataments()

    {
        return $this->hasMany(Tratament::className(), ['serviciu' => 'id']);
    }



}
