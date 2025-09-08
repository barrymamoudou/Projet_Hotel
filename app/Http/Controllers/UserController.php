<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function Index()
    {
        return view('frontend.index');
    }

    public function UserProfil()
    {
        $id = Auth::user()->id;
        $profilData = User::find($id);
        return view('frontend.dashboard.user_profil_edit', $profilData);
    }

    public function UserProfilStore() {}

    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
