<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GostController extends BaseController
{
 
    function __construct() {
        $this->middleware('guest');
    }

    public function login()
    {
        return view('login');
    }

    public function login_submit(Request $request)
    {
        $this->validate($request, [
            'korime' => 'required|min:3',
            'lozinka' => 'required|min:4'
        ], [
            'required' => 'Polje :attribute je obazeno',
            'min' => 'Polje :attribute mora da bude minimalno :min karaktera',
        ]);
        
        if(!auth()->attempt($request->only('korime', 'lozinka'))) {
            return back()->with('status', 'Losi kredencijali');
        }

        return redirect()->route('index');
    }
}
