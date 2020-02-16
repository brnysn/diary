<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;

class StateController extends Controller
{

    public function getCities(Request $request){
        $state= State::where('id', $request->id)->with('cities')->get()->first();
        return $state->cities;
    }
}
