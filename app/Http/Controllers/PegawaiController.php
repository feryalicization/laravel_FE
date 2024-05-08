<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Models\Presensi;



class PegawaiController extends Controller
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
    
    public function index()
     {
         $token = $this->getToken();
 
         $response = $this->dataTransaksi($token);
 
        //  dd($response);
 
         return view('dashboard.kelola-pegawai', compact('response'));
     }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create-pegawai');
    }

    /**
     * Store a newly created resource in storage.
     */
   
     public function store(Request $request)
     {

         $request->validate([
             'nip' => 'required|string|max:255', 
             'nama_pegawai' => 'required|string|max:255',
             'jabatan' => 'required|string|max:255',
             'tgl_lahir' => 'required|date',
             'divisi' => 'required|string|max:255',

         ]);
 
         try {
 
             $pegawai = new Pegawai();
             $pegawai->nip = $request->input('nip');
             $pegawai->nama_pegawai = $request->input('nama_pegawai');
             $pegawai->jabatan = $request->input('jabatan');
             $pegawai->tgl_lahir = $request->input('tgl_lahir');
             $pegawai->divisi = $request->input('divisi');
 
             $pegawai->save();
 
             Log::info('New Pegawai created: ' . $pegawai->id);
 
             return redirect()->route('dashboard.kelola-pegawai')
                 ->with('success', 'Pegawai created successfully.');
         } catch (\Exception $e) {
             Log::error('Error creating Pegawai: ' . $e->getMessage());
 
             return redirect()->back()
                 ->with('error', 'Error creating Pegawai. Please try again.');
         }
     }
     

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {   

        $jumlahPegawai = Pegawai::count();
        $jumlahAbsen = Presensi::whereDate('tgl', now()->toDateString())->count();

        return view('dashboard.charts', compact('pegawai', 'jumlahPegawai', 'jumlahAbsen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        return view('dashboard.edit-pegawai', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        // Validate the incoming request data
        $request->validate([
            'nip' => 'required|string|max:255',
            'nama_pegawai' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'divisi' => 'required|string|max:255',
            // Add validation rules for other attributes
        ]);

        try {
            // Update the Pegawai instance with the request data
            $pegawai->update([
                'nip' => $request->input('nip'),
                'nama_pegawai' => $request->input('nama_pegawai'),
                'jabatan' => $request->input('jabatan'),
                'tgl_lahir' => $request->input('tgl_lahir'),
                'divisi' => $request->input('divisi'),
                // Update other attributes accordingly
            ]);

            // Log success message
            Log::info('Pegawai updated: ' . $pegawai->id);

            return redirect()->route('dashboard.kelola-pegawai')
                ->with('success', 'Pegawai updated successfully.');
        } catch (\Exception $e) {
            // Log error message
            Log::error('Error updating Pegawai: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Error updating Pegawai. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        try {
            $pegawai->delete();

            // Log success message
            Log::info('Pegawai deleted: ' . $pegawai->id);

            return redirect()->route('dashboard.kelola-pegawai')
                ->with('success', 'Pegawai deleted successfully.');
        } catch (\Exception $e) {
            // Log error message
            Log::error('Error deleting Pegawai: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Error deleting Pegawai. Please try again.');
        }
    }


    public function create_qrcode()
    {
        return view('dashboard.qrcode-pegawai');
    }

    /**
     * Store a newly created resource in storage.
     */
   
    public function store_qrcode(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:255',
        ]);
    
        try {
            $pegawai = Pegawai::where('nip', $request->input('nip'))->first();

            if (!$pegawai) {
                return response()->json(['error' => 'Pegawai not found.'], Response::HTTP_NOT_FOUND);
            }
    
            $qrCode = QrCode::size(300)->generate($request->input('nip'));
    
            $path = 'public/qrcodes/' . $request->input('nip') . '.png';
    
            Storage::put($path, response($qrCode)->getContent());
    
            $pegawai->update(['public/qrcodes' => $path]);

            Log::info('QR Code generated and stored for Pegawai: ' . $pegawai->id);
    
            return redirect()->route('dashboard.kelola-pegawai')
                ->with('success', 'QR Code generated and stored successfully.');
        } catch (\Exception $e) {
            // Log error message
            Log::error('Error generating QR Code: ' . $e->getMessage());
    
            return redirect()->back()
                ->with('error', 'Error generating QR Code. Please try again.');
        }
    }




}
