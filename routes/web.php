<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/sso-login', function (Request $request) {
    try {
        $decrypted = Crypt::decryptString($request->token);
        $data = json_decode($decrypted, true);

        if ($data['expires_at'] < now()->timestamp) {
            return 'Token expired';
        }

        $user = \App\Models\User::where('email', $data['email'])->first();
        if (!$user) {
            return 'User not found in Foodpanda DB';
        }

        Auth::login($user);

        return redirect('/dashboard');
    } catch (\Exception $e) {
        return 'Invalid or tampered token!';
    }
});