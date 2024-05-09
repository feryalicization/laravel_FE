<?php

namespace App\Http\Controllers;


class  BarangController extends Controller
{
    
    private function getToken()
     {
         $url = 'http://127.0.0.1:8001/api/token/';
 
         $data = [
             'email' => 'fery@gmail.com',
             'password' => '1234'
         ];
 
         $headers = [
             'accept: application/json',
             'Content-Type: application/json',
             'X-CSRFToken: 5KBmbMfCpOK4lycIYb2zsswWtQE8WNTiZBOOJ8I5QI1lQS7buSkJTP3i9s31ooVM'
         ];
 
         $ch = curl_init();
 
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_POST, true);
         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 
         $response = curl_exec($ch);
 
         curl_close($ch);
 
         $responseData = json_decode($response, true);

         if (isset($responseData['token'])) {
             return $responseData['token'];
         }
 
         return null;
     }
 

    private function dataBarang($token)
     {
         $url = 'http://127.0.0.1:8001/barang';
 
         $headers = [
             'accept: application/json',
             'Authorization: ' . $token,
             'X-CSRFToken: 5KBmbMfCpOK4lycIYb2zsswWtQE8WNTiZBOOJ8I5QI1lQS7buSkJTP3i9s31ooVM'
         ];
 
         $ch = curl_init();

         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 
         $response = curl_exec($ch);
 
         curl_close($ch);
 
         $responseData = json_decode($response, true);
 
         return $responseData;
     }


    public function index()
    {
        $token = $this->getToken();
 
        $response = $this->dataBarang($token);

        // dd($response);

        return view('dashboard.barang', compact('response'));
    }



    public function create()
    {

        return view('dashboard.create-barang');
    }



    public function edit()
    {
        $token = $this->getToken();
 
        $response = $this->dataBarang($token);

        return view('dashboard.edit-barang', compact('response'));
    }





}
