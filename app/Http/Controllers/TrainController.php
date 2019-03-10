<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainController extends Controller
{
    public function index() {
        return view('trainIndex');
    }
    public function searchByNumber(){
        return view('trainInfo.TrainsByNumber');
    }
    public function searchByName(){
        return view('trainInfo.TrainsByName', compact('apiKey'));
    }
    public function searchTrainByName(Request $request){
        $request->validate([
            'key-search' => 'required|string'
        ]);
    }
    public function direction() {
        return view('trainInfo.MapDirection');
    }
}
