<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OffersController extends Controller
{
    public function index(Request $request)
    {
        return Offer::all();
    }
    public function store(Request $request)
    {
        // $title = $request->input('title');
        // $price = $request->input('price');
        // $category_id = $request->input('category_id');
        // DB::table('offers')->insert([
        //     'title' => $title,
        //     'price' => $price,
        //     'category_id' => $category_id

        // ]);
        $offer = Offer::create($request->all());
        // Check if there is an image in the request
        if ($request->hasFile('image')) {

            $originalImage = $request->file('image');
            
            // Resize the image
            // $resizedImage = Image::make($originalImage);
            // $resizedImage->resize(null, 200, function ($constraint) {
            //     $constraint->aspectRatio();
            // });
            //$path = public_path('images/meal/' . $meal->id);
            //$resizedImage->save($path);
            //$resizedImage->stream();

            Storage::disk('local')->put('public/images/offers/' . $offer->id, $originalImage, 'public');
            //$path = $originalImage->storeAs(public_path().'/images/meal/', $meal->id);
        }

        
        
        return response('Offer created '.$offer->id, 201);
    }
    // public function list(){
    //     return 'List of offers';
    // }
    // public function show($id){
    //     return 'Offer: '.$id;
    // }
}
