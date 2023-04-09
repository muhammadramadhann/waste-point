<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('pages.users.main.edit_profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:40'],
            'no_hp' => ['required'],
            'address' => ['required', 'min:5'],
            'avatar' => ['mimes:png,jpg,jpeg,gif,svg', 'max:4000']
        ]);

        $user = User::find(Auth::user()->id);

        if ($user->avatar == null) {
            if ($request->avatar != null) {
                $random_name = strtolower($request->name);
                $avatar = str_replace(' ', '', $random_name) . '-avatar-' . rand() . '.' . $request->avatar->extension();
                $request->avatar->move(public_path('avatars'), $avatar);

                $user->update([
                    'name' => $request->name,
                    'no_hp' => $request->no_hp,
                    'address' => $request->address,
                    'avatar' => $avatar
                ]);

                return redirect(route('user.edit-profile'))->with('update_success', 'Profil berhasil diupdate!');
            } else {
                $user->update([
                    'name' => $request->name,
                    'no_hp' => $request->no_hp,
                    'address' => $request->address,
                ]);

                return redirect(route('user.edit-profile'))->with('update_success', 'Profil berhasil diupdate!');
            }
        } else {
            if ($request->avatar != null) {
                // delete old file
                File::delete(public_path('avatars/' . $user->avatar));

                $random_name = strtolower($request->name);
                $avatar = str_replace(' ', '', $random_name) . '-avatar-' . rand() . '.' . $request->avatar->extension();
                $request->avatar->move(public_path('avatars'), $avatar);

                $user->update([
                    'name' => $request->name,
                    'no_hp' => $request->no_hp,
                    'address' => $request->address,
                    'avatar' => $avatar
                ]);

                return redirect(route('user.edit-profile'))->with('update_success', 'Profil berhasil diupdate!');
            } else {
                $user->update([
                    'name' => $request->name,
                    'no_hp' => $request->no_hp,
                    'address' => $request->address,
                ]);

                return redirect(route('user.edit-profile'))->with('update_success', 'Profil berhasil diupdate!');
            }
        }
    }
}
