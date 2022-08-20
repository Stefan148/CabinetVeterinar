<?php

namespace backend\models;

use backend\components\ProjectUtils;
use common\models\User;
use Yii;

/**
 * This is the model class for table "personal_medical".
 *
 * @property int $id
 * @property int $tip
 * @property string $nume
 * @property string $prenume
 * @property int $gen
 * @property string $telefon
 * @property string $poza
 * @property string $cod_parafa
 * @property int $user
 * 
 * @property TipPersonalMedical $tip0
 * @property Tratament[] $trataments
 * @property User $user0
 */
class PersonalMedical extends \yii\db\ActiveRecord
{

    public $image;
    public $email;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personal_medical';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nume', 'prenume', 'poza', 'tip', 'cod_parafa', 'telefon', 'email'], 'required'],
            [['gen', 'tip', 'user'], 'integer'],

            [['nume', 'prenume'], 'string', 'max' => 50],
            [['poza'], 'string', 'max' => 80],
            [['cod_parafa'], 'string', 'max' => 10],
            [['cod_parafa'], 'unique'],
            [['telefon'], 'string', 'max' => 16],
            [['telefon'], 'unique'],
            [['email'], 'email']
        ];
    }
    public $displayField = 'full_name';

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nume' => 'Nume',
            'prenume' => 'Prenume',
            'gen' => 'Gen',
            'tip' => 'Tip',
            'telefon' => 'Telefon',
            'poza' => 'Poza',
            'cod_parafa' => 'Cod Parafa',
            'email' => 'Email'
        ];
    }





    /**
     * Gets query for [[Tip0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTip0()
    {
        return $this->hasOne(TipPersonalMedical::className(), ['id' => 'tip']);
    }


 /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }

    /**
     * Gets query for [[Trataments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrataments()
    {
        return $this->hasMany(Tratament::className(), ['persoana' => 'id']);
    }

    public function getNumeComplet()
    {
        return sprintf('%s %s', $this->nume, $this->prenume);
    }

    public function getDetalii()
    {
        return sprintf('%s (%s)', $this->numeComplet, $this->cod_parafa);
    }
    public function salvare()
    {
        $image = \backend\components\ProjectUtils::uploadImage($this, $fileName, $uniqueFileName, $filePath, $fileUrl, "image");
        if ($image !== false) {
            $image->saveAs($filePath);
        }
        //  var_dump($filePath);
        //exit();
        $this->poza = $uniqueFileName;
        
        $transaction = Yii::$app->db->beginTransaction();
        $user = $this->signup();
        $saved = $user->save();
        if ($saved) {
            $this->user = $user->id;
            $saved = $this->save();
        }

        if ($saved) {

            $transaction->commit();
            return true;
        }
        $transaction->rollBack();
        return false;
    }

    public function signup()
    {
        // if (!$this->validate()) {
        //     return null;
        // }

        $user = new User();
        $user->username = ProjectUtils::randomPassword();
        $user->email = $this->email;
        $user->setPassword($user->username);
        $user->generateAuthKey();
        //$user->generateEmailVerificationToken();
        $user->status = 10;

        return $user; //->save() ;//&& $this->sendEmail($user);
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    // protected function sendEmail($user)
    // {
    //     return Yii::$app
    //         ->mailer
    //         ->compose(
    //             ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
    //             ['user' => $user]
    //         )
    //         ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
    //         ->setTo($this->email)
    //         ->setSubject('Account registration at ' . Yii::$app->name)
    //         ->send();
    // }

    public function saveWithUser()
    {

        $transaction = Yii::$app->db->beginTransaction();
        $user = $this->signup();
        $saved = $user->save();
        if ($saved) {
            $this->user = $user->id;
            $saved = $this->save();
        }

        if ($saved) {

            $transaction->commit();
            return true;
        }
        $transaction->rollBack();
        return false;
    }
}
