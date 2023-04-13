<?php

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

function mysql_password($password)
{
    return '*' . strtoupper(hash('sha1', pack('H*', hash('sha1', $password))));
}

function setting($key)
{
    return Cache::remember("config-$key", 60, function () use ($key) {
        if(Setting::where('key', $key)->first())
            return Setting::where('key', $key)->first()->value;

        return null;
    });
}

function get_class_name($job){
    switch($job){
        case 0:
            return __('Warrior M');
        case 1:
            return __('Ninja W');
        case 2:
            return __('Sura M');
        case 3:
            return __('Shaman W');
        case 4:
            return __('Warrior W');
        case 5:
            return __('Ninja M');
        case 6:
            return __('Sura W');
        case 7:
            return __('Shaman M');
        default:
            return __('Unknown');
    }
}

function get_languages(){
    return [
        'en' => 'English',
        'ro' => 'Română',
        'de' => 'Deutsch',
        'fr' => 'Français',
        'pl' => 'Polski',
        'it' => 'Italiano',
        'tr' => 'Türkçe',
        'cz' => 'Čeština',
    ];
}

function get_bonus_name($id, $value){
    $bonuses = json_decode(file_get_contents(storage_path('bonuses.json')), true);

    $locale = app()->getLocale();
    $string = $bonuses[$id][$locale];
    //replace [n] from $string with 0
    $string = preg_replace('/\[n\]/', $value, $string);
    return $string;
}

?>
