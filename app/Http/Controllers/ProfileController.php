<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use File;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('admin.pages.user.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function shopProfile(){
        return view('/admin/pages/shop_settings/shop_profile');
    }

    public function shopProfileUpdate(Request $request){
        $path = public_path('admin/images');
        if($request->shop_name){
            DB::table('options')->updateOrInsert(
                ['option_key' => 'shop_name'],
                ['option_key' => 'shop_name', 'option_value' => $request->shop_name,'option_group'=>'shop-profile']
            );
        }

        if ($request->hasFile('logo')) {
            $logoName = time() . '.' . $request->logo->extension();
            if (!File::exists($path)) {
                File::makeDirectory($path);
            }
            $request->file('logo')->move($path, $logoName);
            DB::table('options')->updateOrInsert(
                ['option_key' => 'shop_logo'],
                ['option_key' => 'shop_logo', 'option_value' => $logoName,'option_group'=>'shop-profile']
            );
        }

        if ($request->hasFile('favicon')) {
            $faviconName = time() . '.' . $request->favicon->extension();
            if (!File::exists($path)) {
                File::makeDirectory($path);
            }
            $request->file('favicon')->move($path, $faviconName);
            DB::table('options')->updateOrInsert(
                ['option_key' => 'shop_favicon'],
                ['option_key' => 'shop_favicon', 'option_value' => $faviconName,'option_group'=>'shop-profile']
            );
        }

        return redirect()->back()->with('message', 'Image uploaded successfully');
    }

    public function userProfile(){
        return view('/frontend/users/dashboard');
    }
}
