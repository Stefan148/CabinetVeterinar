<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "locatia".
 *
 * @property int $id
 * @property string $denumire
 * @property string $localitate
 * @property string $oras
 * @property string $strada
 * @property string $numar
 * @property string $telefon_contact
 * @property string $email_contact
 */
class Locatia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locatia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['denumire', 'localitate', 'oras', 'strada', 'numar', 'telefon_contact', 'email_contact'], 'required'],
            [['denumire', 'localitate'], 'string', 'max' => 50],
            [['oras', 'strada'], 'string', 'max' => 30],
            [['numar'], 'string', 'max' => 15],
            [['telefon_contact'], 'string', 'max' => 10],
            [['email_contact'], 'string', 'max' => 150],
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
            'localitate' => 'Localitate',
            'oras' => 'Oras',
            'strada' => 'Strada',
            'numar' => 'Numar',
            'telefon_contact' => 'Telefon Contact',
            'email_contact' => 'Email Contact',
        ];
    }
}
