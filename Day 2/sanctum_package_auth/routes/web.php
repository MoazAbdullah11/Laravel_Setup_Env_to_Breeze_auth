<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\MessageController;

// Show Register Form
Route::get('/register', function () {
    return view('register');
})->name('register');

// Perform Registration
Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    $user = \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
    ]);

    auth()->login($user);

    return redirect()->route('home')->with('success', 'Registration successful!');
})->name('register.perform');

// Show Login Form
Route::get('/login', function () {
    return view('login');
})->name('login');

// Perform Login
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (auth()->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('home');
    }

    return back()->with('error', 'Invalid login details');
})->name('login.perform');

// Protected Home Page
Route::middleware('auth')->get('/home', function () {
    return view('home');
})->name('home');

// Logout
Route::post('/logout', function (Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');





Route::middleware(['auth'])->group(function () {
    Route::post('/contact', [MessageController::class, 'store']);
    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
});



use App\Http\Controllers\PostController;

Route::middleware('auth')->group(function () {
    Route::get('/ajax-posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('/ajax-posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/ajax-posts/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::put('/ajax-posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/ajax-posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});



Route::get('/ajax-posts-view', function () {
    return view('ajax-posts');
})->middleware('auth'); // protect for logged-in users


Route::get('/ajax-posts', function () {
    $posts = \App\Models\Post::all();
    return view('ajax-posts', compact('posts'));
});


Route::get('/ajax-posts/search', [App\Http\Controllers\PostController::class, 'search']);
