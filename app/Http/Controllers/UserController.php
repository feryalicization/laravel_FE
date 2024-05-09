<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Pegawai;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'username' => 'required|string|max:255', 
            'password' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        try {
            $user = new User();
            $user->username = $request->input('username');
            $user->password = Hash::make($request->input('password'));
            $user->email = $request->input('email');
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->save();

            // Log success message
            Log::info('New User created: ' . $user->id);

            return redirect()->route('dashboard.index')
                ->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            // Log error message
            Log::error('Error creating User: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Error creating User. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
      
        // Retrieve the authenticated user's ID
        $userId = Auth::id();
        
        // Retrieve the user data based on the authenticated user's ID
        $user = User::find($userId);
        return view('dashboard.index', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('edit_password', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate the incoming request data
        $request->validate([
            'password_baru' => 'required|string|min:8|confirmed',
        ]);

        // Check if the old password matches the user's current password
        if (!Hash::check($request->password_baru, $user->password)) {
            return redirect()->back()->with('error', 'Password lama tidak sesuai.');
        }

        // Update the user's password
        $user->password = Hash::make($request->password_baru);
        $user->save();

        return redirect()->route('dashboard.index')->with('success', 'Password berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function login_page()
    {
        return view('dashboard.login');
    }

    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        // Attempt to authenticate the user
        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            // Update last login user
            Auth::user()->update(['last_login' => now()]);
            
            // Store user's first name in the session
            $request->session()->put('first_name', Auth::user()->first_name);
            
            // Authentication successful
            Log::info('User logged in: ' . Auth::user()->id); 
    
            return redirect()->route('dashboard.kelola-pegawai')
                ->with('success', 'Login successful.');
        } else {
            // Authentication failed
            Log::warning('Login attempt failed for user: ' . $request->input('username'));
    
            return redirect()->back()
                ->with('error', 'Invalid username or password. Please try again.');
        }
    }

    public function update_profile(Request $request, User $user)
    {
        $userId = Auth::id();

        $request->validate([
            'username' => 'required|string|max:255', 
            'email' => 'required|string|email|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'file' => 'file|image|max:1024',
        ]);

        try {

            $user = User::find($userId);

            if (!$user) {
                return redirect()->route('login')->with('error', 'User not found.');
            }

            $user->update([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
            ]);

            Log::info('User profile updated: ' . $user->id);

            if($request->hasFile('file'))
        {
            // Get the current photo file path
            $oldImagePath = public_path('uploads/' . $user->username . '.' . $user->photo_extension);
            
            // Check if the old image exists and delete it
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Upload new image
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = $user->username . '.' . $extension;
            $file->move(public_path('uploads'), $filename);
        }

            return redirect()->route('dashboard.index')->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating user profile: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Error updating user profile. Please try again.');
        }

    }


    public function logout()
    {
        Auth::logout();

        return redirect('/')->with('success', 'You have been logged out successfully.');
    }


    public function qrcodeGenerator(Request $request)
    {
        $validatedData = $request->validate([
            'nip' => 'required|exists:pegawai,nip'
        ]);
    
        $nip = $validatedData['nip'];
    
        $qrCodePath = public_path('qrcodes/'.$nip.'.png');
 
        if (File::exists($qrCodePath)) {
            return "QR code already exists";
        }
    
        $url = url('qrcode-absen?nip='.$nip);

        QrCode::format('png')->size(300)->generate($url, $qrCodePath);
    
        $pegawai = Pegawai::where('nip', $nip)->firstOrFail();
    
        $pegawai->qrcode = 'qrcodes/'.$nip.'.png';
        $pegawai->save();
    
        return view('dashboard.qrcode-pegawai-2', compact('pegawai'));
    }






}
