<?php

namespace backend\components;

use Yii;
use yii\web\UploadedFile;
use DateTime;
use DateTimeZone;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectUtils
 *
 * @author Marian
 */
class ProjectUtils {

    const DATE_TIME_DEFAULT_PATTERN = "dd.MM.yyyy HH:mm";
    const DATE_DEFAULT_PATTERN = "dd.MM.yyyy";
    const BD_DATE_DEFAULT_PATTERN = "php:Y-m-d";
    const BD_DATE_TIME_DEFAULT_PATTERN = "php:Y-m-d H:i:s";
    const BROWSER_GOOGLE_CHROME = 'Google Chrome';
    const BROWSER_APPLE_SAFARI = 'Apple Safari';

    private static $timezone = 'UTC';
    const TIME_ZONE_EUROPE_BUCHAREST='Europe/Bucharest';

    public static function formatedDate($date, $pattern = self::DATE_DEFAULT_PATTERN) {
        return Yii::$app->formatter->asDate($date,$pattern);
    }

    public static function formatedDateTime($dateTime, $pattern = self::DATE_TIME_DEFAULT_PATTERN) {
        return Yii::$app->formatter->asDatetime($dateTime,$pattern);
    }

    public static function getCurrentTimeInBDFormat($timeZone = NULL) {
        if (is_null($timeZone)) {
            $timeZone = self::$timezone;
        }
        $date = new DateTime('now', new DateTimeZone($timeZone));
        return $date->format('Y-m-d HH:ii:ss');
    }

    public static function getBDDateFormat($dateToFormat) {
        return Yii::$app->formatter->asDatetime($dateToFormat, self::BD_DATE_DEFAULT_PATTERN);
    }

    public static function getBDDateTimeFormat($dateTimeToFormat) {
        return Yii::$app->formatter->asDatetime($dateTimeToFormat, self::BD_DATE_TIME_DEFAULT_PATTERN);
    }

    static public function uploadImage($model, &$fileName, &$uniqueFileName, &$filePath, &$fileUrl, $imageName = 'image') {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($model, $imageName);
        
        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }
        // store the source file name
        $fileName = $image->name;
        $tmp = explode('.', $image->name);
        $ext = end($tmp);

        // generate a unique file name
        $uniqueFileName = Yii::$app->security->generateRandomString() . ".{$ext}";
        $filePath = sprintf(Yii::$app->basePath . '/web/uploads/%s', $uniqueFileName);
        $fileUrl = sprintf(Yii::$app->urlManager->baseUrl . '/uploads/%s', $uniqueFileName);
        // the uploaded image instance
        return $image;
    }

    static function can($permissions) {
        $founded=false;
        foreach ($permissions as $permission) {
            if (Yii::$app->user->can($permission)) {
                $founded=true;
                break;
            }
        }
        return $founded;
    }

   static function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }


}
