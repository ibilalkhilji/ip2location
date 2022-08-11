# IP2Location Laravel Package

IP2Location Laravel extension enables the user to find the country, region, city, coordinates, time zone, ISP from IP address using
VPNAPI.io.

*Note: This extension works in Laravel 8 and Laravel 9.*

## INSTALLATION

Run the command: `composer require khaleejinfotech/ip2location` to download the package into the Laravel platform.


After you have installed the package, open your Laravel config file config/app.php and add the following lines.

In the $providers array add the service providers for this package.

```
Khaleejinfotech\IP2Location\IP2LocationServiceProvider::class,
```

Publish the config file with

```
php artisan vendor:publish --tag="ip2location"
```

Open the **config/ip2location.php** in any text editor and add your api key obtained from vpnapi.io

```php
<?php

return [
    'api_key' => env('IP2LOCATION_API','')
];

```

## USAGE

Create a **TestController** in Laravel using the below command line

```
php artisan make:controller TestController
```

Open the **app/Http/Controllers/TestController.php** in any text editor. To use IP2Location, add the below lines into the controller file.

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khaleejinfotech\IP2Location\IP2Location;

class TestController extends Controller
{
	//Create a lookup function for display
	public function lookup(){

            //Try query the geolocation information of 8.8.8.8 IP address
            $ip2Location = new IP2Location();
            $ip2Location->setIP('8.8.8.8');
            $ip2Location->lookup();
            $response = $ip2Location->getResponse();
		
            echo 'IP Address            : ' . $response->getIp() . "<br>";
		
            echo 'Detect VPN            : ' . $response->isVPN() . "<br>";
            echo 'Detect Proxy          : ' . $response->isProxy() . "<br>";
            echo 'Detect Tor            : ' . $response->isTor() . "<br>";
		
            echo 'Country Code          : ' . $response->getCountryCode() . "<br>";
            echo 'Country Name          : ' . $response->getCountryName() . "<br>";
		
            echo 'Region Name           : ' . $response->getRegionName() . "<br>";
            echo 'Region Code           : ' . $response->getRegionCode() . "<br>";
		
            echo 'City Name             : ' . $response->getCity() . "<br>";
		
            echo 'Latitude              : ' . $response->getLatitude() . "<br>";
            echo 'Longitude             : ' . $response->getLongitude() . "<br>";
		
            echo 'Time Zone             : ' . $response->getTimeZone() . "<br>";
	}
}
```

Add the following line into the *routes/web.php* file.

```
Route::get('test', [TestController::class,'lookup');
```

Enter the URL localhost:8000/test and run. You should see the information of **8.8.8.8** IP address.
