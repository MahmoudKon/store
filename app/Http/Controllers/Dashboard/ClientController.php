<?php

namespace App\Http\Controllers\Dashboard;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Auth;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = Client::when($request->search, function($q) use ($request){

            return $q->where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('address', 'like', '%' . $request->search . '%')
                ->orWhere('id', '=', $request->search);

        })->latest()->paginate(5);

        return view('dashboard.clients.index', compact('clients'));

    }//end of index

    public function create()
    {
        return view('dashboard.clients.create');

    }//end of create

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'image' => 'image',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required',
            'password' => 'required|confirmed',
        ]);

        $request_data = $request->except(['password', 'password_confirmation', 'image']);

        $request_data = $request->all();
        $request_data['password'] = bcrypt($request->password);
        $request_data['phone'] = array_filter($request->phone);

        if ($request->image) {

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/client_images/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        } //end of if

        Client::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.clients.index');

    }//end of store

    public function edit(Client $client)
    {
        return view('dashboard.clients.edit', compact('client'));

    }//end of edit

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', Rule::unique('clients')->ignore($client->id),],
            'image' => 'image',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required',
        ]);

        $request_data = $request->except(['image']);

        if ($request->image) {

            if ($client->image != 'default.png') {

                Storage::disk('public_uploads')->delete('/client_images/' . $client->image);
            } //end of inner if

            $request_data = $request->all();
            $request_data['phone'] = array_filter($request->phone);

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/client_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        } //end of external if

        $client->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.clients.index');

    }//end of update

    public function destroy(Client $client)
    {

        $client->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->back();

    }//end of destroy




// Make Block

public function deleted(Request $request)
{
    $clients = Client::onlyTrashed()->where(function ($q) use ($request) {

        return $q->when($request->search, function ($query) use ($request) {

            return $query->where('first_name', 'like', '%' . $request->search . '%')
                        ->orWhere('last_name', 'like', '%' . $request->search . '%')
                        ->orWhere('email', 'like', '%' . $request->search . '%')
                        ->orWhere('phone', 'like', '%' . $request->search . '%')
                        ->orWhere('address', 'like', '%' . $request->search . '%')
                        ->orWhere('id', '=', $request->search);
        });
    })->latest()->paginate(5);

    return view('dashboard.clients.deleted', compact('clients'));
} //end of Show Blocked


public function restore($id)
{
    Client::onlyTrashed()->find($id)->restore();
    session()->flash('success', __('site.restore_successfully'));
    return redirect()->back();
} //end of Un Block

}//end of controller
