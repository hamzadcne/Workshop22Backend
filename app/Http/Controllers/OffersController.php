<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OffersController extends Controller
{
    public function list(){
        return 'List of offers';
    }
    public function show($id){
        return 'Offer: '.$id;
    }
}
