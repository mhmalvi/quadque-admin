<?php 
namespace App\Country;

use PragmaRX\Countries\Package\Countries;

class Country 
{
    public static function country()
    {
        $countries      = Countries::all();
        $countriesArray = [];
        foreach ($countries as $key => $val) {
            $countriesArray[] = [
                'name'       => $val['name']['common'],
                'currencies' => $val['currencies'] ?? [],
                'iso_a2'     => $val['iso_a2'],
                'iso_a3'     => $val['iso_a3'],
            ];
        }

        return $countriesArray;
    }
}