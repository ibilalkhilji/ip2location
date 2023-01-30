<?php

namespace Khaleejinfotech\IP2Location;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Khaleejinfotech\IP2Location\Facade\LookupResponse;

class IP2Location
{
    private $response = null;
    private $ip = '';

    /**
     * @param string $ip
     * @return IP2Location
     */
    public function setIP(string $ip): IP2Location
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * Method use to lookup information for the given ip address.
     * @throws Exception
     */
    public function lookup()
    {
        $client = new Client(['base_uri' => 'https://vpnapi.io']);

        if (config('ip2location.api_key') == null || config('ip2location.api_key') == '')
            throw new Exception('API Key not defined');

        try {
            $res = $client->request('GET', "/api/$this->ip?key=" . config('ip2location.api_key'), ['verify' => false]);
            $this->response = $this->parseResponse($res->getBody()->getContents());
            return $this;
        } catch (GuzzleException $exception) {
            return response()->json([
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * @return LookupResponse
     * @throws Exception
     */
    public function getResponse(): LookupResponse
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        $response = new LookupResponse();
        $response->ip = $this->response->ip;
        $response->isVPN = $this->response->security->vpn;
        $response->isProxy = $this->response->security->proxy;
        $response->isTor = $this->response->security->tor;
        $response->city = $this->response->location->city;
        $response->region = $this->response->location->region;
        $response->country = $this->response->location->country;
        $response->continent = $this->response->location->continent;
        $response->region_code = $this->response->location->region_code;
        $response->country_code = $this->response->location->country_code;
        $response->continent_code = $this->response->location->continent_code;
        $response->latitude = $this->response->location->latitude;
        $response->longitude = $this->response->location->longitude;
        $response->time_zone = $this->response->location->time_zone;
        $response->locale_code = $this->response->location->locale_code;
        $response->metro_code = $this->response->location->metro_code;
        $response->is_in_european_union = $this->response->location->is_in_european_union;
        $response->network = $this->response->network->network;
        $response->autonomous_system_number = $this->response->network->autonomous_system_number;
        $response->autonomous_system_organization = $this->response->network->autonomous_system_organization;
        return $response;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getIp(): string
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        return $this->response->ip;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function isVPN(): bool
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        return $this->response->security->isVPN;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function isProxy(): bool
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        return $this->response->security->isProxy;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function isTor(): bool
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        return $this->response->security->isTor;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getCity(): string
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        return $this->response->location->city;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getRegion(): string
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        return $this->response->location->region;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getCountry(): string
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        return $this->response->location->country;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getContinent(): string
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        return $this->response->location->continent;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getRegionCode(): string
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        return $this->response->location->region_code;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getCountryCode(): string
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        return $this->response->location->country_code;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getContinentCode(): string
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        return $this->response->location->continent_code;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getLatitude()
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        return $this->response->location->latitude;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getLongitude()
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        return $this->response->location->longitude;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getTimeZone()
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        return $this->response->location->time_zone;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getLocaleCode()
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        return $this->response->location->locale_code;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getMetroCode()
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        return $this->response->location->metro_code;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getIsInEuropeanUnion()
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        return $this->response->location->is_in_european_union;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getNetwork()
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        return $this->response->network->network;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getAutonomousSystemNumber()
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        return $this->response->network->autonomous_system_number;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getAutonomousSystemOrganization()
    {
        if ($this->response == null) throw new Exception("Method Lookup not fired..");
        return $this->response->network->autonomous_system_organization;
    }

    protected function parseResponse($content)
    {
        return json_decode($content);
    }
}
