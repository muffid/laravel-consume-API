<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InsertController extends Controller
{
    // Controller methods go here
    public function index(){
        return view('insertProd');
    }

    public function store(Request $req){

        // Set up the cURL request
     
        $curl = curl_init();
        curl_setopt_array($curl, [

        //sesuaikan alamat endpoint API
        CURLOPT_URL => 'http://127.0.0.3:3000/input/products',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        
        CURLOPT_POSTFIELDS => [
            
            //membuat parameter yang dibutuhkan oleh endpoint (SESUAIKAN DENGAN ENDPOINT API YANG DIBUAT)
            'id' => $req->id,
            'name' => $req->name,
            'price' => $req->price,
            'stock' => $req->stock,
            ],

        CURLOPT_HTTPHEADER => [
            "Authorization:Bearer $token",
        ],    
        ]);

        // Mengirim request ke API
        $response = curl_exec($curl);

        //menerima response dari API disimpan dalam bentuk string
        $message = json_decode($response,true)['message'];
        
        // menutup sesi curl
        curl_close($curl);
        
        //jika response dari API sukses
       if($message=='ok'){
            return redirect('/')->with('message','Data berhasil Disimpan');
       }
               
    }
}
