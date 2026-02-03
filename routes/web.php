<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Muestra el formulario de login
Route::get('login', function () {
    return view('auth.login');
})->name('login');

use App\Models\User;
// Procesa el login y crea usuario si no existe
Route::post('login', function (Request $request) {
    $credentials = $request->only('username', 'password');
    $user = User::where('username', $credentials['username'])->first();
    if (!$user) {
        $user = User::create([
            'username' => $credentials['username'],
            'password' => bcrypt($credentials['password']),
            'role' => 'usuario',
        ]);
    }
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }
    return back()->withErrors([
        'username' => 'Credenciales incorrectas',
    ]);
});

// Cierra la sesion actual
Route::post('logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// Redirige al login o al listado segun sesion
Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    return redirect()->route('tasks.index');
});

// Agrupa rutas protegidas por autenticacion
Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class)->only([
        'index',
        'store',
        'show',
        'update',
        'destroy',
    ]);
});
