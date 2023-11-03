<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\UserInfos;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $data = $request->validated();

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->has('first_name') && !empty($request->input('first_name'))) {
            $user->first_name = $request->input('first_name');
        }

        if ($request->has('last_name') && !empty($request->input('last_name'))) {
            $user->last_name = $request->input('last_name');
        }

        if ($request->hasFile('profile_photo_path')) {
            $ext = $request->file('profile_photo_path')->getClientOriginalExtension();
            $profileImage = uniqid() . '.' . $ext;
            $request->file('profile_photo_path')->storeAs('public/profile_pictures', $profileImage);
            $user->profile_photo_path = $profileImage;
        }

        $this->updateUserInfos($user, $request->only(['phone', 'nickname', 'bio']));

        $user->fill($data);
        $user->save();
     
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    protected function updateUserInfos(User $user, array $data)
    {
        $user->userInfo()->update([
            'user_id' => $user->id,
            'phone' => $data['phone'],
            'nickname' => $data['nickname'],
            'bio' =>$data['bio'],
        ]);
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
}
