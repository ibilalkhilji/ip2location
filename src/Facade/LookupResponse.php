<?php

namespace Khaleejinfotech\IP2Location\Facade;

class LookupResponse
{
    public $ip;

    public $isVPN;
    public $isProxy;
    public $isTor;

    public $city;
    public $region;
    public $country;
    public $continent;
    public $region_code;
    public $country_code;
    public $continent_code;
    public $latitude;
    public $longitude;
    public $time_zone;
    public $locale_code;
    public $metro_code;
    public $is_in_european_union;

    public $network;
    public $autonomous_system_number;
    public $autonomous_system_organization;
}
