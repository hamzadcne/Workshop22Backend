<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ImageController extends Controller
{
    public function fetch($type,$id){
        return Storage::download('public/images/'.$type.'/'.$id);
    }
}
