<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/listar/{action}', function ($action) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://grsunlock.com/api/index.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'username' => 'maxhertel2', 
            'apiaccesskey' => 'CUL-UK9-BJM-A81-RLT-P9J-3NM-G5V', 
            'requestformat' => 'JSON', 
            'action' => $action
        ),
        CURLOPT_HTTPHEADER => array(
            'Cookie: DHRUFUSION=9564ae1f5edf3497deaf50f51fdd4a3c'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    dump(json_decode($response));
});
