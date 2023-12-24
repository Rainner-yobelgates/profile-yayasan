<?php

use App\Models\Institution;
use App\Models\Setting;

function get_list_status()
{
    return [
        1 => 'Active',
        0 => 'Inactive'
    ];
}

function getSetting(){
    $setting = Setting::select(['key','value'])->get()->keyBy('key')->toArray();
    return $setting;
}

function getLembaga(){
    return Institution::where('status',1)->orderBy('order','ASC')->get();
}

?>