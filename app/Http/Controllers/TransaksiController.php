<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;




class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */


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
 

    private function dataTransaksi($token)
     {
         $url = 'http://127.0.0.1:8001/transaksi';
 
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


    private function sendPostRequest($url, $data, $headers)
    {
        // Initiate cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Execute cURL session
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);

        // Decode the response
        return json_decode($response, true);
    }



    private function createTransaction($barang, $jenisTransaksi, $jumlah)
    {
        $token = $this->getToken();

        $transactionData = [
            'barang' => $barang,
            'jenis_transaksi' => $jenisTransaksi,
            'jumlah' => $jumlah
        ];

        $headers = [
            'accept: application/json',
            'Authorization: Token ' . $token,
            'Content-Type: application/json',
            'X-CSRFToken: 5KBmbMfCpOK4lycIYb2zsswWtQE8WNTiZBOOJ8I5QI1lQS7buSkJTP3i9s31ooVM'
        ];

        $url = 'http://127.0.0.1:8001/transaksi';
        $response = $this->sendPostRequest($url, $transactionData, $headers);

        // Handle response as needed
        if (!empty($response)) {
            Log::info('Transaction created: ' . json_encode($response));
        } else {
            Log::error('Error creating transaction.');
        }
    }



    public function updateTransaction(Request $request, $transactionId)
    {
        try {
            $request->validate([
                'barang' => 'required|integer',
                'jenis_transaksi' => 'required|string|max:255',
                'jumlah' => 'required|integer',
            ]);

            $barang = $request->input('barang');
            $jenisTransaksi = $request->input('jenis_transaksi');
            $jumlah = $request->input('jumlah');

            $token = $this->getToken();

            $payload = [
                'barang' => $barang,
                'jenis_transaksi' => $jenisTransaksi,
                'jumlah' => $jumlah,
            ];

            $headers = [
                'accept: application/json',
                'Authorization: Token ' . $token,
                'Content-Type: application/json',
                'X-CSRFToken: cth2mZwvUzQwOWaQcqT6rYLC0I9B50yW6kuuUlZYlt7Njg5jI7bgSliYGkyuxBAq',
            ];

            $url = 'http://127.0.0.1:8001/transaksi/' . $transactionId;
            $response = $this->sendPatchRequest($url, $payload, $headers);

            if (!empty($response)) {
                Log::info('Transaction updated successfully: ' . json_encode($response));
                return response()->json(['success' => true, 'message' => 'Transaction updated successfully']);
            } else {
                Log::error('Error updating transaction.');
                return response()->json(['success' => false, 'message' => 'Error updating transaction'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Error updating transaction: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error updating transaction'], 500);
        }
    }



    
    public function index()
     {
         $token = $this->getToken();
 
         $response = $this->dataTransaksi($token);
 
        //  dd($response);
 
         return view('dashboard.transaksi', compact('response'));
     }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $token = $this->getToken();
 
        $response = $this->dataBarang($token);

        return view('dashboard.create-pegawai', compact('response'));
    }

    /**
     * Store a newly created resource in storage.
     */
   
     public function store(Request $request)
     {

        $request->validate([
            'barang' => 'required|integer', 
            'jenis_transaksi' => 'required|string|max:255', 
            'jumlah' => 'required|integer|min:1',
        ]);
 
         try { 
 
            $barang = $request->input('barang');
            $jenisTransaksi = $request->input('jenis_transaksi');
            $jumlah = $request->input('jumlah');

            $this->createTransaction($barang, $jenisTransaksi, $jumlah);
 
             return redirect()->route('dashboard.transaksi')
                 ->with('success', 'Pegawai created successfully.');
         } catch (\Exception $e) {
             Log::error('Error creating Pegawai: ' . $e->getMessage());
 
             return redirect()->back()
                 ->with('error', 'Error creating Pegawai. Please try again.');
         }
     }
     

    public function edit()
    {
        $token = $this->getToken();
 
        $response = $this->dataBarang($token);

        return view('dashboard.edit-pegawai', compact('response'));
    }




}
