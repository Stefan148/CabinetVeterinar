<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tip_personal_medical".
 *
 * @property int $id
 * @property string $denumire
 * @property int $activ
 *
 * @property PersonalMedical[] $personalMedicals
 */
class TipPersonalMedical extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tip_personal_medical';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['denumire'], 'required'],
            [['activ'], 'integer'],
            [['denumire'], 'string', 'max' => 50],
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
     * Gets query for [[PersonalMedicals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalMedicals()
    {
        return $this->hasMany(PersonalMedical::className(), ['tip' => 'id']);
    }
}
