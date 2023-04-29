<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\JadwalUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class JadwalUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal_umum = JadwalUmum::all();
        if (count($jadwal_umum) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $jadwal_umum
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
    public function create()
    {
        //
    }

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
                'id_jadwal_umum' => 'required',
                'id_instruktur' => 'required',
                'id_kelas' => 'required',
                'hari_jadwal_umum' => 'required',
                'sesi_jadwal_umum' => 'required',
                'status_jadwal_umum' => 'required',
                'tgl_jadwal_umum' => 'required',
            ]);

            if ($validate->fails())
                return response(['message' => $validate->errors()], 400); // return error invalid input

            $jadwalError = JadwalUmum::where('id_instruktur', $storeData['id_instruktur'])
                ->where('sesi_jadwal_umum', $storeData['sesi_jadwal_umum'])
                ->where('hari_jadwal_umum', $storeData['hari_jadwal_umum'])
                ->first();

            if ($jadwalError) {
                return response()->json([
                    'succes' => false,
                    'message' => 'Jadwal Instruktur Bertabrakan'
                ], 409);
            }

            $jadwal_umum = JadwalUmum::create($request->all());
            return response([
                'message' => 'Berhasil Menambahkan Jadwal Umum',
                'data' => $jadwal_umum,
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_jadwal_umum) {
        $jadwal_umum = JadwalUmum::find($id_jadwal_umum); // mencari data instruktur berdasarkan id

        if(!is_null($jadwal_umum)) {
            return response([
                'message' => 'Retrieve Jadwal Umum Berhasil',
                'data' => $jadwal_umum
            ], 200);
        } // return data instruktur yang ditemukan dalam bentuk json

        return response([
            'message' => 'Jadwal Umum Tidak Ditemukan',
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
    public function update(Request $request, $id_jadwal_umum) {
        $jadwal_umum = JadwalUmum::where('id_jadwal_umum', '=', $id_jadwal_umum)->first(); //  Mengambil data paket berdasarkan id

        if(is_null($jadwal_umum)){
            return response([
                'message' => 'Instruktur Tidak Ditemukan',
                'data' => null
            ], 404);
        }

        $updateData = $request->all(); // Mengambil seluruh data input dan menyimpan dalam variabel updateData
        $validate = Validator::make($updateData, [
           'id_jadwal_umum' => 'required',
           'id_instruktur' => 'required',
           'id_kelas' => 'required',
           'hari_jadwal_umum' => 'required',
           'status_jadwal_umum' => 'required',
           'tgl_jadwal-umum' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $jadwalError = JadwalUmum::where('id_instruktur', $updateData['id_instruktur'])
            ->where('sesi_jadwal_umum', $updateData['sesi_jadwal_umum'])
            ->where('hari_jadwal_umum', $updateData['hari_jadwal_umum'])
            ->first();

        if(!$jadwalError){
            if(DB::update('update jadwal_umum set id_jadwal_umum = ?, id_instruktur = ?, id_kelas = ?, hari_jadwal_umum = ?, sesi_jadwal_umum = ?, status_jadwal_umum =?, tgl_jadwal_umum =?, where id_jadwal_umum = ?',
            [$request->id_jadwal_umum, $request->nama_instruktur, $request->alamat_instruktur, $request->tgl_lahir_instruktur, $request->email_instruktur, $request->no_telp_instruktur, $request->status_instruktur, $request->jumlah_hadir_instruktur, $request->jumlah_libur_instruktur, $request->jumlah_terlambat_instruktur, $request->id_instruktur])){
            $jadwal_umum = JadwalUmum::where('id_jadwal_umum', '=', $id_jadwal_umum)->first(); 

            return response([
                'message' => 'Update Instruktur Berhasil',
                'data' => $jadwal_umum,
            ], 200);
        }
        }

        return response([
            'message' => 'Update Instruktur Gagal Sebab Jadwal Instrukur Bertabrakan',
            'data' => null,
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_jadwal_umum) {
        $jadwal_umum = JadwalUmum::find($id_jadwal_umum);

        if(is_null($jadwal_umum)) {
            return response([
                'message' => 'Jadwal Umum tidak ditemukan',
                'data' => null
            ], 404 );
        }

        if($jadwal_umum->delete()) {
            return response([
                'message' => 'Hapus Jadwal Umum Berhasil',
                'data' => $jadwal_umum
            ], 200);
        }

        return response([
            'message' => 'Hapus Jadwal Gagal',
            'data' => null
        ], 400);
    }
}
