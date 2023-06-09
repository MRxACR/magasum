<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Lang;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // if ($request->password) {
        //     auth()->user()->update(['password' => Hash::make($request->password)]);
        // }

        // auth()->user()->update([
        //     'name' => $request->name,
        //     'email' => $request->email,
        // ]);

        // return redirect()->back()->with('success', Lang::get('messages.profile.mise'));
        return redirect()->back()->with('success', "La mise à jour des identifiants est désactivée par l'administrateur de l'application");
    }
}
