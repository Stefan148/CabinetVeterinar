<?php

namespace backend\models;

use common\components\ProjectUtils;
use Yii;

/**
 * This is the model class for table "tratament".
 *
 * @property int $id
 * @property int $serviciu
 * @property string $data_ora
 * @property int $animal
 * @property int $persoana
 * @property string $observatii
 *
 * @property Animal $animal0
 * @property PersonalMedical $persoana0
 * @property Serviciu $serviciu0
 * @property TratamentePoze[] $tratamentePozes
 */
class Tratament extends \yii\db\ActiveRecord
{
    public $images;

    public $tipAnimal;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tratament';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['serviciu', 'data_ora', 'animal', 'persoana', 'tipAnimal'], 'required'],
            [['serviciu', 'animal', 'tipAnimal', 'persoana'], 'integer'],
            [['data_ora'], 'safe'],
            [['observatii'], 'string', 'max' => 500],
            [['animal'], 'exist', 'skipOnError' => true, 'targetClass' => Animal::className(), 'targetAttribute' => ['animal' => 'id']],
            [['serviciu'], 'exist', 'skipOnError' => true, 'targetClass' => Serviciu::className(), 'targetAttribute' => ['serviciu' => 'id']],
            [['persoana'], 'exist', 'skipOnError' => true, 'targetClass' => PersonalMedical::className(), 'targetAttribute' => ['persoana' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'serviciu' => 'Serviciu',
            'data_ora' => 'Data si ora',
            'animal' => 'Animal',
            'persoana' => 'Persoana',
            'observatii' => 'Observatii',
            'tipAnimal' => 'Tip animal',
            'images'=>'Imagini'
        ];
    }

    /**
     * Gets query for [[Animal0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnimal0()
    {
        return $this->hasOne(Animal::className(), ['id' => 'animal']);
    }

    /**
     * Gets query for [[Persoana0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersoana0()
    {
        return $this->hasOne(PersonalMedical::className(), ['id' => 'persoana']);
    }

    /**
     * Gets query for [[Serviciu0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiciu0()
    {
        return $this->hasOne(Serviciu::className(), ['id' => 'serviciu']);
    }

    /**
     * Gets query for [[TratamentePozes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTratamentePozes()
    {
        return $this->hasMany(TratamentePoze::className(), ['tratament' => 'id']);
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->data_ora = ProjectUtils::getBDDateTimeFormat($this->data_ora);
            return true;
        }
        return false;
    }
    public function afterFind()
    {
        parent::afterFind();
        $this->data_ora = ProjectUtils::formatedDateTime($this->data_ora);
    }
}
