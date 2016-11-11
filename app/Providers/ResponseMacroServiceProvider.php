<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use SimpleXMLElement;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register the application's response macros.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('xml', function(array $vars, $status = 200, array $header = [], $rootElement = 'root', $xml = null)
        {
            if (is_null($xml)) {
                $xml = new SimpleXMLElement('<'.$rootElement.'/>');
            }

            foreach ($vars as $key => $value) {
                if (is_array($value)) {
                    Response::xml($value, $status, $header, $rootElement, $xml->addChild($key));
                } else {
                    if( preg_match('/^@.+/', $key) ) {
                        $attributeName = preg_replace('/^@/', '', $key);
                        $xml->addAttribute($attributeName, $value);
                    } else {
                        $xml->addChild($key, $value);
                    }
                }
            }

            if (empty($header)) {
                $header['Content-Type'] = 'application/xml';
            }

            return Response::make($xml->asXML(), $status, $header);
        });
    }
}