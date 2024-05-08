<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Pegawai;



class  PresensiController extends Controller
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

        return view('dashboard.data-presensi', compact('response'));
    }

    public function laporan_presensi()
    {
        $presensi = Presensi::all();
        return view('dashboard.data-laporan-presensi', compact('presensi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        return response()->json(['message' => 'test'], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Presensi $presensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presensi $presensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presensi $presensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presensi $presensi)
    {
        //
    }


    public function qrcode_absen(Request $request, Presensi $presensi)
    {
        $nip = $request->input('nip');
    
        try {
            // Find the Pegawai based on the NIP
            $pegawai = Pegawai::where('nip', $nip)->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Pegawai not found'], 404);
        }
    
        // Check if Presensi record 
        $existingPresensi = Presensi::where('id_pegawai', $pegawai->id)
                                    ->whereDate('created_at', today())
                                    ->first();
    
        if (!$existingPresensi) {
            // Create jam masuk
            $presensi = new Presensi();
            $presensi->id_pegawai = $pegawai->id;
            $presensi->jam_masuk = now();
            $presensi->tgl = now();
            $presensi->save();
    
            return response()->json(['message' => 'Presensi absen masuk berhasil'], 201);
        } else {

            if ($existingPresensi->jam_masuk !== null) {
                // Update jam_keluar
                $existingPresensi->jam_keluar = now();
                $existingPresensi->save();
    
                return response()->json(['message' => 'Presensi absen keluar berhasil'], 201);
            } else {
                return response()->json(['message' => 'Pegawai telah absen keluar'], 400);
            }
        }
    }


    public function qrcodeGenerator(Request $request)
    {
        $validatedData = $request->validate([
            'nip' => 'required|exists:pegawai,nip'
        ]);
    
        $nip = $validatedData['nip'];
    
        $pegawai = Pegawai::where('nip', $nip)->firstOrFail();
    
        $pegawai->qrcode = 'qrcodes/'.$nip.'.png';
        $pegawai->save();
    
        return view('presensi-masuk-barcode', compact('pegawai'));
    }

    public function qrcodeGenerator_keluar(Request $request)
    {
        $validatedData = $request->validate([
            'nip' => 'required|exists:pegawai,nip'
        ]);
    
        $nip = $validatedData['nip'];
    
        $pegawai = Pegawai::where('nip', $nip)->firstOrFail();
    
        $pegawai->qrcode = 'qrcodes/'.$nip.'.png';
        $pegawai->save();
    
        return view('presensi-keluar-barcode', compact('pegawai'));
    }





}
