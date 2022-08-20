<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tip_animal".
 *
 * @property int $id
 * @property string $denumire
 * @property int $activ
 *
 * @property Animal[] $animals
 */
class TipAnimal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tip_animal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['denumire'], 'required'],
            [['activ'], 'integer'],
            [['denumire'], 'string', 'max' => 150],
            [['denumire'], 'unique'],
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
            'activ' => 'Activ',
        ];
    }

    /**
     * Gets query for [[Animals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnimals()
    {
        return $this->hasMany(Animal::className(), ['tip' => 'id']);
    }
}
