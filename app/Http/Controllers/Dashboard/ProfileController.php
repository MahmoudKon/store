<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
class ProfileController extends Controller
{
    public function index ()
    {
        return view('dashboard.users.profile.index');
    }// end of index

    public function edit ()
    {
        return view('dashboard.users.profile.edit');
    }// end of edit

    public function update (Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($user->id)],
            'image' => 'image',
        ]);
        $request_data = $request->except(['password', 'image']);
        $request_data['password'] = bcrypt($request->password);
        if ($request->image) {

            if ($user->image != 'default.png') {

                Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
            } //end of inner if

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {$constraint->aspectRatio();})
                ->save(public_path('uploads/user_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        } //end of external if

        $user->update($request_data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.profile');

    }// end of update
}
