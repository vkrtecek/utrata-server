<?php
/**
 * Created by PhpStorm.
 * User: Krtek
 * Date: 11.9.2018
 * Time: 19:47
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class CourseControllerMVC extends AbstractControllerMVC
{
    /** @deprecated */
    const URL = 'http://apilayer.net/api/live?access_key=___KEY___&source=___FROM___&currencies=___TO___';
    /** @deprecated  */
    const API_KEY = '6758edfc07467b94db61a11c269d8b12';

    public function get(Request $request) {
        $from = $request->get('from');
        $to = $request->get('to');

        if ($from === $to)
            return 1;

        $url = "https://currency-api.appspot.com/api/$to/$from.jsonp?amount=1.00&callback=jQuery111009987857173908277_1536691543237&_=1536691543241";

        $response = $this->callAPI('GET', $url);
        $response = str_replace(['jQuery111009987857173908277_1536691543237(', ')'], '', $response);
        $response = json_decode($response);
        return number_format($response->rate, 3);
    }


    protected function callAPI(string $method, string $url, $data = false) {
        $curl = curl_init();

        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "username:password");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }
}
