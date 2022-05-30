<?php

namespace App\Helpers;

class Helper{

    public static function num_generator($nom_t,$date,$num_l,$l){
        $lettre = substr($nom_t,0,3);
        $maj = strtoupper($lettre);
        $date_a = substr($date,2,2);
        $date_m = substr($date,5,2);
        $date_c = $date_m.$date_a;
        if($num_l == null || $date_c != substr($num_l[$l],3,4)){
            $nb = '001';
        }
        else{
            $n = substr($num_l[$l],7,3);
            $n = $n+1;
            switch(strlen($n)){
                case 1:
                    $nb = '00'.$n;
                    break;
                case 2:
                    $nb = '0'.$n;
                    break;
                case 3:
                    $nb = $n;
                    break;
            }
        }

        return $maj.$date_c.$nb;

    }
}

?>