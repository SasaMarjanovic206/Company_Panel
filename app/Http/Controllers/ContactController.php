<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use App\Mail\ContactMe;

class ContactController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('testpage');
    }

    public function store(Request $request)
    {
        // request('email')->validate(['email' => 'required|email']); ne radi!!!

        $request->validate([
            'email' => 'required|email'
        ]);

        // $validator = Validator::make(
        //     [
        //         'Email' => request('email')
        //     ],
        //     [
        //         'Email' => 'required|email'
        //     ]
        // );

        // if($validator->fails()){
        //     $errors = $validator->messages()->toArray();
        //     $error = '';
        //     foreach($errors as $key=>$value){
        //         $error = $error . " " . $value[0];
        //     }
        //     return response()->json(['success' => false, 'error' => $error], 400);
        // }

        // Raw email (zastarelo)

        // Mail::raw('It works!', function($message){
        //     $message->to(request('email'))
        //             ->subject('Hello there!');
        // });

        Mail::to(request('email'))
            ->send(new ContactMe('shirts'));

        return redirect('/testpage')->with('success', 'Email Sent!');

    }
}
