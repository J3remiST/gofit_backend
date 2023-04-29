<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instruktur;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class InstrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instruktur = Instruktur::all();
        if (count($instruktur) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $instruktur
            ], 200);
        } // return data semua promo dalam bentuk json

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400); // return message data promo kosong
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        {
            $storeData = $request->all();
            $validate = Validator::make($storeData, [
                'id_instruktur' => 'required',
                'nama_instruktur' => 'required',
                'alamat_instruktur' => 'required',
                'tgl_lahir_instruktur' => 'required',
                'email_instruktur' => 'required',
                'no_telp_instruktur' => 'required',
                'status_instruktur' => 'required',
                'jumlah_hadir_instruktur' => 'required',
                'jumlah_libur_instruktur' => 'required',
                'jumlah_terlambat_instruktur' => 'required',

            ]); // membuat rule validasi input

            if ($validate->fails())
                return response(['message' => $validate->errors()], 400); // return error invalid input

            $instruktur = Instruktur::create($request->all());
            return response([
                'message' => 'Berhasil menambahkan instruktur baru',
                'data' => $instruktur,
            ], 200); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_instruktur) {
        $instruktur = Instruktur::find($id_instruktur); // mencari data instruktur berdasarkan id

        if(!is_null($instruktur)) {
            return response([
                'message' => 'Retrieve Instruktur Berhasil',
                'data' => $instruktur
            ], 200);
        } // return data instruktur yang ditemukan dalam bentuk json

        return response([
            'message' => 'Instruktur Tidak Ditemukan',
            'data' => null
        ], 404); // return message saat data instruktur tidak ditemukan
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_instruktur) {
        $instruktur = Instruktur::where('id_instruktur', '=', $id_instruktur)->first(); //  Mengambil data paket berdasarkan id

        if(is_null($instruktur)){
            return response([
                'message' => 'Instruktur Tidak Ditemukan',
                'data' => null
            ], 404);
        }

        $updateData = $request->all(); // Mengambil seluruh data input dan menyimpan dalam variabel updateData
        $validate = Validator::make($updateData, [
           'id_instruktur' => 'required',
           'nama_instruktur' => 'required',
           'alamat_instruktur' => 'required',
           'tgl_lahir_instruktur' => 'required',
           'email_instruktur' => 'required',
           'no_telp_instruktur' => 'required',
           'status_instruktur' => 'required',
           'jumlah_hadir_instruktur' => 'required',
           'jumlah_libur_instruktur' => 'required',
           'jumlah_terlambat_instruktur' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        if(DB::update('update instruktur set id_instruktur = ?, nama_instruktur = ?, alamat_instruktur = ?, tgl_lahir_instruktur = ?, email_instruktur = ?, no_telp_instruktur =?, status_instruktur =?, jumlah_hadir_instruktur =?, jumlah_libur_instruktur =?, jumlah_terlambat_instruktur =? where id_instruktur = ?',
            [$request->id_instruktur, $request->nama_instruktur, $request->alamat_instruktur, $request->tgl_lahir_instruktur, $request->email_instruktur, $request->no_telp_instruktur, $request->status_instruktur, $request->jumlah_hadir_instruktur, $request->jumlah_libur_instruktur, $request->jumlah_terlambat_instruktur, $id_instruktur])){
            $instruktur = Instruktur::where('id_instruktur', '=', $id_instruktur)->first(); 

            return response([
                'message' => 'Update Instruktur Berhasil',
                'data' => $instruktur,
            ], 200);
        }

        return response([
            'message' => 'Update Instruktur Gagal',
            'data' => null,
        ], 400);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id_instruktur) {
        $instruktur = Instruktur::find($id_instruktur); // mencari data promo berdasarkan id

        if (is_null($instruktur)) {
            return response([
                'message' => 'Insrtuktur tidak ditemukan',
                'data' => null
            ], 404);
        } // return message saat data promo tidak ditemukan
        if (DB::table('instruktur')->where('id_instruktur', $id_instruktur)->delete()) {
            return response([
                'message' => 'Hapus Instruktur Berhasil',
                'data' => $instruktur
            ], 200);
        } // return message saat berhasil menghapus data promo


        return response([
            'message' => 'Hapus Instruktur Gagal',
            'data' => null,
        ], 400); // return message saat gagal menghapus data promo
    }
    
}
