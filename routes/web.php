<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test', function (Request $request) {
    $client = new Client([
        'handler' => new CurlHandler([
            'handle_factory' => new CurlFactory(0)
        ]),
        'verify' => false,
        'headers' => [
            'X-Authorization' => config('app.ms_sms_api_token'),
            'Content-Type'  => 'application/json',
            'Accept'  => 'application/json'
        ]
    ]);

    try {
        $request = $client->request('GET','http://ms-sms.softarray.xyz/message');
        $response = json_decode($request->getBody()->getContents());
        dd($response);
    } catch (\GuzzleHttp\Exception\ClientException $e) {
        echo 'Caught response: ' . $e->getResponse()->getStatusCode();
    }
});
