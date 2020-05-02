<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// koneksi dengan form request
use App\Http\Requests\Admin\TravelPackageRequest;
// koneksi model
use App\TravelPackage;
use App\Gallery;
use Illuminate\Http\Request;
// librrary string, fungsi stringnya laravel
use Illuminate\Support\Str;

class TravelPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //panggil model, dengan mengambil semua data
        $items = TravelPackage::all();

        // return hasil
        return view('pages.admin.travel-package.index', [
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
        //tampilkan view
        return view('pages.admin.travel-package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  pakai request yang sudah kit abuat
    public function store(TravelPackageRequest $request)
    {
        //nyimpan
        // buat variabel untuk nyimpan semua form
        // ngambil data dr hasil request

        $data = $request->all();
        // bikin url slug dari title
        $data['slug'] = Str::slug($request->title);

        // panggil model, dan fungsi create
        TravelPackage::create($data);
        // blikin user kehalaman sebelumnya
        return redirect()->route('travel-package.index');
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

        // panggil model,jika datanya adamunculin, jika tidak masuk halaman 404
        $item = TravelPackage::findOrFail($id);

        return view('pages.admin.travel-package.edit', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TravelPackageRequest $request, $id)
    {
        //nyimpan
        // buat variabel untuk nyimpan semua form
        // ngambil data dr hasil request

        $data = $request->all();
        // bikin url slug dari title
        $data['slug'] = Str::slug($request->title);
        // panggil model,jika datanya adamunculin, jika tidak masuk halaman 404
        $item = TravelPackage::findOrFail($id);

        // jalankan fungsi update
        $item->update($data);
        // blikin user kehalaman sebelumnya
        return redirect()->route('travel-package.index');
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
        $item = TravelPackage::findOrFail($id);
        $item->delete();

        // panggil model,jika datanya adamunculin, jika tidak masuk halaman 404
        $item = Gallery::findOrFail($id);
        $item->delete();
        // blikin user kehalaman sebelumnya
        return redirect()->route('travel-package.index');
    }
}
