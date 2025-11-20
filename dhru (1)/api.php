<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function (Request $request) {
    return $request->user();
});

// Mirror endpoint similar to the external curl: POST /api/index.php
Route::post('/index.php', function (Request $request) {
    // Mirror procedural behavior from the provided script
    @session_name('DHRUFUSION');
    @session_set_cookie_params(0, '/', null, false, true);
    @session_start();
    @error_reporting(0);

    $apiversion = '6.1';

    // Collect and sanitize POST inputs, but keep 'parameters' raw
    $rawPost = $request->post();
    $username = null;
    $apiaccesskey = null;
    $action = null;
    $requestformat = $request->input('requestformat', 'JSON');
    $parameters = null;

    foreach ($rawPost as $k => $v) {
        if ($k === 'parameters') {
            $parameters = $v; // assign raw
            continue;
        }

        // sanitize like FILTER_SANITIZE_STRING
        $clean = is_array($v) ? $v : filter_var($v, FILTER_SANITIZE_STRING);
        switch ($k) {
            case 'username':
                $username = $clean;
                break;
            case 'apiaccesskey':
                $apiaccesskey = $clean;
                break;
            case 'action':
                $action = $clean;
                break;
            case 'requestformat':
                $requestformat = $clean;
                break;
            default:
                break;
        }
    }

    $format = strtoupper($requestformat ?: 'JSON');

    // If parameters provided as XML, convert to array similar to original code
    if ($parameters) {
        try {
            $xml = @simplexml_load_string($parameters);
            if ($xml !== false) {
                $parameters = json_decode(json_encode($xml), true);
            }
        } catch (\Exception $e) {
            $parameters = null;
        }
    }

    // Helper: validate auth against DB
    $validateAuth = function ($u, $k) {
        if (empty($u) || empty($k)) {
            return false;
        }
        try {
            $user = DB::table('users')
                ->where('username', $u)
                ->where('apiaccesskey', $k)
                ->first();
        } catch (\Exception $e) {
            return false;
        }

        if (!$user) {
            return false;
        }

        return [
            'credit' => property_exists($user, 'credit') ? $user->credit : 0,
            'email' => property_exists($user, 'email') ? $user->email : '',
        ];
    };

    // Response container
    $apiresults = [];

    if ($User = $validateAuth($username, $apiaccesskey)) {
        try {
            $enabledServices = DB::table('apiservices')->where('status', '1')->get();
        } catch (\Exception $e) {
            $enabledServices = collect();
        }

        switch (strtolower($action)) {
            case 'accountinfo':
                $AccountInfo = [];
                $AccountInfo['credit'] = $User['credit'];
                $AccountInfo['mail'] = $User['email'];
                $AccountInfo['currency'] = 'USD';
                $apiresults['SUCCESS'][] = ['message' => 'Your Account Info', 'AccountInfo' => $AccountInfo];
                break;

            default:
                $apiresults['ERROR'][] = ['message' => 'Unknown action: ' . ($action ?: '')];
                break;
        }
    } else {
        $apiresults['ERROR'][] = ['message' => 'Authentication failed'];
    }

    // ----------------- HEADERS QUE VOCÊ PEDIU -----------------
    if (count($apiresults)) {
        $responseHeaders = [
            'X-Powered-By' => 'DHRU-FUSION',
            'dhru-fusion-api-version' => $apiversion,
        ];
    } else {
        $responseHeaders = [];
    }

    // ----------------- XML -----------------
    if ($format === 'XML') {
        $xmlRoot = new \SimpleXMLElement('<?xml version="1.0"?><response></response>');

        $array_to_xml = function ($data, \SimpleXMLElement &$xml_data) use (&$array_to_xml) {
            foreach ($data as $key => $value) {
                if (is_numeric($key)) {
                    $key = 'item' . $key;
                }

                if (is_array($value)) {
                    $subnode = $xml_data->addChild($key);
                    $array_to_xml($value, $subnode);
                } else {
                    $xml_data->addChild($key, htmlspecialchars((string)$value));
                }
            }
        };

        $array_to_xml($apiresults, $xmlRoot);

        $response = response($xmlRoot->asXML(), 200, $responseHeaders)
            ->header('Content-Type', 'application/xml');
    }
    // ----------------- JSON -----------------
    else {
        $response = response()->json(
            ['apiresults' => $apiresults],
            200,
            $responseHeaders
        )->header('Content-Type', 'application/json; charset=utf-8');
    }

    // ----------------- REMOVER HEADERS -----------------
    $response->headers->remove('pragma');
    $response->headers->remove('server');
    $response->headers->remove('transfer-encoding');
    $response->headers->remove('cache-control');
    $response->headers->remove('expires');

    return $response;
});
