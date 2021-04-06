<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('posts')->get();

        return view('users.index', compact('users'));
    }

    public function makeAdmin(User $user)
    {
        $user->role = 'admin';
        $user->save();

        Session::flash('success', 'User role has been changed successfully! ');
        return redirect(route('users.index'));
    }

    public function destroy(User $user)
    {
        if ($user->role === 'admin' || $user->posts->count() > 0)
        {
            Session::flash('alert', 'User is an admin or has some posts created.');
            return redirect(route('users.index'));
        }else{
            $user->delete();
            Session::flash('success', 'User deleted successfully!');
        }
        return redirect(route('users.index'));
    }

    public function profile()
    {
        return view('users.profile', array('user' => Auth::user()));
    }

    public function uploadAvatar(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        $user->update($request->validated());

        if ($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $this->deleteOldImage();
            $request->image->storeAs('images/users', $filename, 'public');
            auth()->user()->update(['avatar' => $filename]);
        }

        Session::flash('success', 'Profile updated successfully!');
        return redirect(route('user.profile'));
    }

    public function deleteOldImage()
    {
        if (auth()->user()->avatar != 'defaultAvatar.jpg'){
            Storage::delete('/public/images/users/' .auth()->user()->avatar);
        }
    }
}
