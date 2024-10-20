<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required']
    ]);

    $remember_me = $request->boolean('remember_me');

    if (Auth::attempt($credentials, $remember_me)) {
      $request->session()->regenerate();

      return response()->json(['message' => 'Login successful', 'success' => true], 200);
    }

    return response()->json(['message' => 'The provided credentials do not match our records.', 'success' => false], 401);
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    $request->session()->forget('returnUrl');

    return response()->json(['message' => 'Logged out successfully', 'success' => true], 200);
  }

  public function getIntendedUrl(Request $request)
  {
    $returnUrl = $request->input('returnUrl', url('/'));
    session(['returnUrl' => $returnUrl]);

    return response()->json(['url' => $returnUrl]);
  }
}
