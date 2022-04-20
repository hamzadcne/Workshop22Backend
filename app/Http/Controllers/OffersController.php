<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Support\Facades\DB;

class OffersController extends Controller
{
    public function index(Request $request)
    {
        return Offer::all();
    }
    public function store(Request $request)
    {
        $title = $request->input('title');
        $price = $request->input('price');
        $category_id = $request->input('category_id');

        DB::table('offers')->insert([
            'title' => $title,
            'price' => $price,
            'category_id' => $category_id

        ]);
        return response('Category created '.$title, 201);
    }
    // public function list(){
    //     return 'List of offers';
    // }
    // public function show($id){
    //     return 'Offer: '.$id;
    // }
}
