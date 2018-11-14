<?php
/**
 * Created by PhpStorm.
 * User: tautvydas
 * Date: 18.11.14
 * Time: 09.20
 */

namespace App\GoogleApi;


class Validator
{
    public function DateValidator (string $date) {
        $splitDate = explode('-',$date);


        ////TIKRINAMA AR PARAMETRAS YRA SKAICIAI IR AR GERAS ILGIS/////
        if (count($splitDate) == 3 && is_numeric($splitDate[0]) && is_numeric($splitDate[1] ) && is_numeric($splitDate[2]))
        {
            ////TIKRINAMA AR TINKAMAS METU/MENESIO/DIENOS ILGIS.
            if (strlen($splitDate[0]) === 4)
            {
            } else {
                return 'Blogas Metu Formatas (4 skaiciai: YYYY)';
            }
            if (strlen($splitDate[1]) === 2)
            {
            } else {
                return 'Blogas Menesio Formatas (2 skaiciai: MM)';
            }
            if (strlen($splitDate[2]) === 2)
            {
            } else {
                return 'Blogas Dienos Formatas (2 skaiciai: DD)';
            }

            ////TIKRINAMA AR NE PER DIDELI AR MAZI METAI
            if ($splitDate[0]  == 2018 ||  $splitDate[0]  == 2019)
            {
            } else {
                return 'Galima tikrinti tik 2018 ir 2019 metu orus';
            }
            //////////// TIKRINAMA AR IVESTAS NE PER DIDELIS MENESIO PARAMETRAS ////
            if ($splitDate[1] < 12 )
            {
            } else {
                return 'Metai turi 12 menesiu';
            }
            ///TIKRINAMA AR ivesta diena nevirsija menesio virsijamu dienu
            if ($splitDate[1] == '01' || $splitDate[1] == '03'  || $splitDate[1] == '05'  ||
                $splitDate[1] == '07'  || $splitDate[1] == '08'  || $splitDate[1] == '10'  || $splitDate[1] == '12')
            {
                if ($splitDate[2] > 31)
                {
                    return 'Sausis, Kovas, Geguze, Liepa, Rugpjutis, Spalis, Gruodis turi tik 31 diena!';
                }
            } else if ( $splitDate[1] == '04' || $splitDate[1] == '06'  || $splitDate[1] == '09'  || $splitDate[1] == '11')
            {
                if ($splitDate[2] > 30)
                {
                    return 'Balandis, Birzelis, Rugsejis, Lapkritis turi tik 30 dienu!';
                }
            }
            ////TIKRINAMA VASARIO MENESIS
             if ( $splitDate[1] == '02'  )
            {
                if ($splitDate[2] > 28)
                {
                    return 'Vasaris turi 28 dienas!';
                }
            }


        } else {
            return 'Datoje naudojami neleistini simboliai arba ji ivesta neteisingai';
        }
    }

}