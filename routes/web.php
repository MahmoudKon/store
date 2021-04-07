<?php
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Psr7\Request;



Auth::routes();

// Route To Go To Dashboard Pages
Route::get('/dashboard', function () {
    return redirect()->route('dashboard.welcome');
});
// End

// Route To Go To Dashboard Pages
Route::get('/', 'HomeController@index')->name('home');


Route::post('/category','HomeController@category')->name('category');
// End













// Route To Send Meassage In Contact Us Page
Route::post('/contact/send', function () {
    $data = request()->validate([
        'name'      => 'required',
        'email'     => 'required|email',
        'phone'     => 'required',
        'message'   => 'required',
    ]);
    Mail::to('mahmoud_mohammed050@yahoo.com')->send(new ContactFormMail($data));
    return redirect()->route('contact')->with('message', ' Thanks for your message. We\'ll be in touch.');
})->name('contact.send');
// End
