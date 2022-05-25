<?php

namespace App\Http\Controllers;

use App\Models\VestModel;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function vesti()
    {
        $vesti = VestModel::all();
        return view('vesti', ['vesti' => $vesti]);
    }

    public function pretraga(Request $request)
    {
        $vesti = VestModel::pretraga($request->pretraga);
        return view('vesti', ['vesti' => $vesti, 'trazeno' => $request->pretraga]);
    }

    public function vest($id)
    {
        $vest = VestModel::find($id);
        return view('vest', ['vest' => $vest]);
    }
}
