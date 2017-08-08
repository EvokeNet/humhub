<?php

namespace app\modules\missions\models;

use Yii;
use yii\behaviors\TimestampBehavior;

class DateTimeFunctions
{
    const YEAR = 0;
    const MONTH = 1;
    const DAY = 2;
    const HOUR = 3;

    public $years;
    public $months;
    public $days;
    public $hours;
    public $higher;

    public function __construct($latest, $second) {
        
        $result = $this->diff($latest, $second);
        $result = explode('.', $result);

        $this->years = $result[0];
        $this->months = $result[1];
        $this->days = $result[2];
        $this->hours = $result[3];
        $this->higher = $result[4];
    }

    public static function diff($latest, $second, $param = -1){

        $latest = strtotime($latest);
        $second = strtotime($second);

        $diff = abs($latest - $second); 

        $higher = $latest > $second? 1 : 0;

        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days * 60*60*24 ) / (60*60));

        switch($param){
            case DateTimeFunctions::YEAR:
                return $years;
                break;
            case DateTimeFunctions::MONTH:
                return $months;
                break;
            case DateTimeFunctions::DAY:
                return $days;
                break;
            case DateTimeFunctions::HOUR:
                return $hours;
                break;    
            default:
                return $years.".".$months.".".$days.".".$hours.".".$higher;
        }
    }

}

