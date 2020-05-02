<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// koneksi dengan form request
use App\Http\Requests\Admin\TransactionRequest;
// koneksi model
use App\Transaction;
use Illuminate\Http\Request;
// librrary string, fungsi stringnya laravel
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //panggil model, dengan mengambil semua data yang berelasi
        $items = Transaction::with([
            'details', 'travel_package', 'user'
        ])->get();

        // return hasil
        return view('pages.admin.transaction.index', [
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
        // return view('pages.admin.transaction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  pakai request yang sudah kit abuat
    public function store(TransactionRequest $request)
    {
        //nyimpan
        // buat variabel untuk nyimpan semua form
        // ngambil data dr hasil request

        $data = $request->all();
        // bikin url slug dari title
        $data['slug'] = Str::slug($request->title);

        // panggil model, dan fungsi create
        Transaction::create($data);
        // blikin user kehalaman sebelumnya
        return redirect()->route('transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // panggil model,jika datanya adamunculin, jika tidak masuk halaman 404
        $item = Transaction::with([
            'details', 'travel_package', 'user'
        ])->findOrFail($id);

        return view('pages.admin.transaction.detail', [
            'item' => $item,
        ]);
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
        $item = Transaction::findOrFail($id);

        return view('pages.admin.transaction.edit', [
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
    public function update(TransactionRequest $request, $id)
    {
        //nyimpan
        // buat variabel untuk nyimpan semua form
        // ngambil data dr hasil request

        $data = $request->all();
        // bikin url slug dari title
        $data['slug'] = Str::slug($request->title);
        // panggil model,jika datanya adamunculin, jika tidak masuk halaman 404
        $item = Transaction::findOrFail($id);

        // jalankan fungsi update
        $item->update($data);
        // blikin user kehalaman sebelumnya
        return redirect()->route('transaction.index');
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
        $item = Transaction::findOrFail($id);
        $item->delete();
        // blikin user kehalaman sebelumnya
        return redirect()->route('transaction.index');
    }
}
