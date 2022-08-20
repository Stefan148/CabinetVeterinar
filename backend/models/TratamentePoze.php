<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tratamente_poze".
 *
 * @property int $id
 * @property int $tratament
 * @property string $denumire_poza
 * @property string $data_ora_incarcare
 *
 * @property Tratament $tratament0
 */
class TratamentePoze extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tratamente_poze';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tratament', 'denumire_poza', 'data_ora_incarcare'], 'required'],
            [['tratament'], 'integer'],
            [['data_ora_incarcare'], 'safe'],
            [['denumire_poza'], 'string', 'max' => 100],
            [['tratament'], 'exist', 'skipOnError' => true, 'targetClass' => Tratament::className(), 'targetAttribute' => ['tratament' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tratament' => 'Tratament',
            'denumire_poza' => 'Denumire Poza',
            'data_ora_incarcare' => 'Data Ora Incarcare',
        ];
    }

    /**
     * Gets query for [[Tratament0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTratament0()
    {
        return $this->hasOne(Tratament::className(), ['id' => 'tratament']);
    }

    public function salvare() {
        $image = \backend\components\ProjectUtils::uploadImage($this, $fileName, $uniqueFileName, $filePath, $fileUrl, "images");
        if ($image !== false) {
            $image->saveAs($filePath);
        }
        //  var_dump($filePath);
        //exit();
        $this->poza = $uniqueFileName;
        return $this->save();
    }


}


