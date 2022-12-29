<?php

use Illuminate\Support\Facades\Route;

use GuzzleHttp\Client;
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

    // bisa langsung disini atau bisa juga melalui controller
    $client = new Client();
    $response = $client->get('http://127.0.0.3:3000/api');
    $responseBody = $response->getBody()->getContents();
    $data = json_decode($responseBody);
    return view('welcome')->with('product',$data);
});

// contoh penggunaan dynamic link untuk pencarian berdasarkan id nama harga atau apapun
Route::get('/product/{id}', function ($id) {
    
    $client = new Client();
    $response = $client->get('http://127.0.0.3:3000/product/'.$id);
    $responseBody = $response->getBody()->getContents();
    $data = json_decode($responseBody);
    return view('product')->with('product',$data);

});

//routing ke laman insert data
Route::get('/insert/product', 'App\Http\Controllers\InsertController@index');

//routing yang mengirim data dari client ke endpoint API
Route::post('/store', 'App\Http\Controllers\InsertController@store');

