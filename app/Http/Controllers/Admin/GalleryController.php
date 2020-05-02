<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// koneksi dengan form request
use App\Http\Requests\Admin\GalleryRequest;
// koneksi model
use App\Gallery;
use App\TravelPackage;
use Illuminate\Http\Request;
// librrary string, fungsi stringnya laravel
use Illuminate\Support\Str;
// hapus file
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //panggil model, dengan mengambil darimethod travel_package di model ini
        $items = Gallery::with(['travel_package'])->get();

        // return hasil
        return view('pages.admin.gallery.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // pas ngupload gambar, filenya mau ditaruh ditravel apa
        // jadi dipanggil seluruh data travle
        $travel_packages = TravelPackage::all();
        //tampilkan view
        return view('pages.admin.gallery.create', [
            'travel_packages' => $travel_packages
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  pakai request yang sudah kit abuat
    public function store(GalleryRequest $request)
    {
        //nyimpan
        // buat variabel untuk nyimpan semua form
        // ngambil data dr hasil request

        $data = $request->all();
        // upload gambar (file)
        $data['image'] = $request->file('image')->store(
            'assets/gallery', //tempatnya
            'public' //agar public
        );

        // panggil model, dan fungsi create
        Gallery::create($data);
        // blikin user kehalaman sebelumnya
        return redirect()->route('gallery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // pas ngupload gambar, filenya mau ditaruh ditravel apa
        // jadi dipanggil seluruh data travle
        $travel_packages = TravelPackage::all();

        // panggil model,jika datanya adamunculin, jika tidak masuk halaman 404
        $item = Gallery::findOrFail($id);

        return view('pages.admin.gallery.edit', [
            'item' => $item,
            'travel_packages' => $travel_packages
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, $id)
    {
        //nyimpan
        // buat variabel untuk nyimpan semua form
        // ngambil data dr hasil request

        $data = $request->all();
        $data['image'] = $request->file('image')->store(
            'assets/gallery', //tempatnya
            'public' //agar public
        );
        // hapus file lama
        // panggil model,jika datanya adamunculin, jika tidak masuk halaman 404
        $item = Gallery::findOrFail($id);

        // Dalam ujicoba
        // Storage::delete(public_path('storage/' . $item->image));
        unlink('storage/' . $item->image);

        // jalankan fungsi update
        $item->update($data);
        // blikin user kehalaman sebelumnya
        return redirect()->route('gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // panggil model,jika datanya adamunculin, jika tidak masuk halaman 404
        $item = Gallery::findOrFail($id);
        $item->delete();
        // blikin user kehalaman sebelumnya
        return redirect()->route('gallery.index');
    }
}
