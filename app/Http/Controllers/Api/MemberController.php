<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member = Member::all();
        if (count($member) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $member
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
                'id_member' => 'required',
                'nama_member' => 'required',
                'alamat_member' => 'required',
                'tgl_lahir_member' => 'required',
                'email_member' => 'required',
                'no_telp_member' => 'required',
                'status_member' => 'required',
                'sisa_deposit_member' => 'required',

            ]); // membuat rule validasi input

            if ($validate->fails())
                return response(['message' => $validate->errors()], 400); // return error invalid input

            $member = Member::create($request->all());
            return response([
                'message' => 'Berhasil menambahkan member baru',
                'data' => $member,
            ], 200); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_member) {
        $member = Member::find($id_member); // mencari data instruktur berdasarkan id

        if(!is_null($member)) {
            return response([
                'message' => 'Retrieve Member Success',
                'data' => $member
            ], 200);
        } // return data instruktur yang ditemukan dalam bentuk json

        return response([
            'message' => 'Member Not Found',
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
    
    public function update(Request $request, $id_member) {
        $member = Member::where('id_member', '=', $id_member)->first(); //  Mengambil data paket berdasarkan id

        if(is_null($member)){
            return response([
                'message' => 'Member Tidak Ditemukan',
                'data' => null
            ], 404);
        }

        $updateData = $request->all(); // Mengambil seluruh data input dan menyimpan dalam variabel updateData
        $validate = Validator::make($updateData, [
            'id_member' => 'required',
            'nama_member' => 'required',
            'alamat_member' => 'required',
            'tgl_lahir_member' => 'required',
            'email_member' => 'required',
            'no_telp_member' => 'required',
            'status_member' => 'required',
            'sisa_deposit_member' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        if(DB::update('update member set id_member = ?, nama_member = ?, alamat_member = ?, tgl_lahir_member = ?, email_member = ?, no_telp_member =?, status_member =?, sisa_deposit_member =? where id_member = ?',
            [$request->id_member, $request->nama_member, $request->alamat_member, $request->tgl_lahir_member, $request->email_member, $request->no_telp_member, $request->status_member, $request->sisa_deposit_member, $id_member])){
            $member = Member::where('id_member', '=', $id_member)->first(); 

            return response([
                'message' => 'Update Member Berhasil',
                'data' => $member,
            ], 200);
        }

        return response([
            'message' => 'Update Member Gagal',
            'data' => null,
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_member) {
        $member = Member::find($id_member);

        if(is_null($member)) {
            return response([
                'message' => 'Member Tidak Ditemukan',
                'data' => null
            ], 404 );
        }

        if($member->delete()) {
            return response([
                'message' => 'Hapus Member Berhasil',
                'data' => $member
            ], 200);
        }

        return response([
            'message' => 'Hapus Member Gagal',
            'data' => null
        ], 400);
    }
}
