<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "animal".
 *
 * @property int $id
 * @property int $tip
 * @property string $nume
 * @property int $gen
 * @property string|null $data_nastere
 * @property int $varsta
 * @property int $greutate
 * @property string $nr_cip
 * @property string $poza
 *
 * @property TipAnimal $tip0
 * @property Tratament[] $trataments
 */
class Animal extends \yii\db\ActiveRecord {

    public $image;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'animal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['tip', 'nume', 'varsta', 'greutate', 'nr_cip', 'poza'], 'required'],
            [['tip', 'gen', 'varsta', 'greutate'], 'integer'],
            [['data_nastere'], 'safe'],
            [['nume'], 'string', 'max' => 50],
            [['nr_cip'], 'string', 'max' => 25],
            [['poza'], 'string', 'max' => 100],
            [['image'], 'file', 'extensions' => 'jpg, gif, png'],
            [['tip'], 'exist', 'skipOnError' => true, 'targetClass' => TipAnimal::className(), 'targetAttribute' => ['tip' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'tip' => 'Tip',
            'nume' => 'Nume',
            'gen' => 'Sex',
            'data_nastere' => 'Data nastere',
            'varsta' => 'Varsta',
            'greutate' => 'Greutate',
            'nr_cip' => 'Numar cip',
            'poza' => 'Poza',
        ];
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {

            $this->data_nastere = \backend\components\ProjectUtils::getBDDateFormat($this->data_nastere);
            return true;
        }
        return false;
    }

    /**
     * Gets query for [[Tip0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTip0() {
        return $this->hasOne(TipAnimal::className(), ['id' => 'tip']);
    }

    /**
     * Gets query for [[Trataments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrataments() {
        return $this->hasMany(Tratament::className(), ['animal' => 'id']);
    }

    public function salvare() {
        $image = \backend\components\ProjectUtils::uploadImage($this, $fileName, $uniqueFileName, $filePath, $fileUrl, "image");
        if ($image !== false) {
            $image->saveAs($filePath);
        }
        //  var_dump($filePath);
        //exit();
        $this->poza = $uniqueFileName;
        return $this->save();
    }

}
