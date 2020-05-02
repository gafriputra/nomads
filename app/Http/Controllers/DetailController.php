<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// panggil model
use App\TravelPackage;

class DetailController extends Controller
{
    // panggil pakai slug
    public function index(Request $request, $slug)
    {
        // saya ngambil travel dan gambarnya jika slugnya ini
        // ambil datanya yang pertama, dan gagalkan jika gaketemu
        $item = TravelPackage::with(['galleries'])->where('slug', $slug)->firstOrFail();
        return view('pages.detail', [
            'item' => $item
        ]);
    }
}
