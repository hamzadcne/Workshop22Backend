<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class OffersController extends Controller
{
    public function index(Request $request)
    {
        return Offer::all();
    }
    public function show($id)
    {
        return Offer::with(['category','images'])->find($id);
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
            //$resizedImage = resizeImage($originalImage);
            $originalImage->store('public/images/offers');
            Storage::disk('public')->put('images/offers/' . $offer->id . '.jpg', $originalImage);

        } else if($request->hasFile('images')){
            
            foreach ($request->file('images') as $imagefile) {
                $image = new Image;
                $path = $imagefile->store('public/images/offers/'. $offer->id);
                $image->url = $path;
                $image->offer_id = $offer->id;
                $image->save();
              }
        }
        return response('Offer created ' . $offer->id, 201);
    }

    private function resizeImage($image)
    {
        $resizedImage = Image::make($image);
        $resizedImage->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
        });
        //$resizedImage->stream();
        return $resizedImage;
    }
    // public function list(){
    //     return 'List of offers';
    // }
    // public function show($id){
    //     return 'Offer: '.$id;
    // }
}
