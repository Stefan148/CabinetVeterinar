<?php



namespace common\components;
use Yii;


class ProjectUtils{
 
    const DATE_TIME_DEFAULT_PATTERN = "dd.MM.yyyy HH:mm";
    const DATE_DEFAULT_PATTERN = "dd.MM.yyyy";
    const BD_DATE_DEFAULT_PATTERN = "php:Y-m-d";
    const BD_DATE_TIME_DEFAULT_PATTERN = "php:Y-m-d H:i:s";

    public static function formatedDate($date, $pattern = self::DATE_DEFAULT_PATTERN) {
        return \Yii::$app->formatter->asDate($date, $pattern);
    }

    public static function formatedDateTime($dateTime, $pattern = self::DATE_TIME_DEFAULT_PATTERN) {
        return \Yii::$app->formatter->asDatetime($dateTime, $pattern);
    }


    public static function getBDDateFormat($dateToFormat) {
        return Yii::$app->formatter->asDatetime($dateToFormat, self::BD_DATE_DEFAULT_PATTERN);
    }

   
    public static function getBDDateTimeFormat($dateTimeToFormat) {
        return Yii::$app->formatter->asDatetime($dateTimeToFormat, self::BD_DATE_TIME_DEFAULT_PATTERN);
    }


}