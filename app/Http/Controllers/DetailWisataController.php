<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Http\Request;

class DetailWisataController extends Controller
{

    public function show($id)
    {
        $wisata = Wisata::where('id', $id)->first();
        return view('detail', [
            'wisata' => $wisata
        ]);
    }
}