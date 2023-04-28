<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PengirimanBarangResource;
use App\Models\PengirimanBarang;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;


class PengirimanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengiriman = PengirimanBarang::all();

        return new PengirimanBarangResource(true, 'Data pengiriman', $pengiriman);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id_pengiriman' => 'required|unique:pengiriman_barangs,id_pengiriman',
            'tanggal_kirim' => 'required',
            'layanan' => 'required',
            'nama_pengirim' => 'required',
            'alamat_pengirim' => 'required',
            'nama_penerima' => 'required',
            'alamat_penerima' => 'required',
            'id_kodepos' => 'required',
            'nohp_penerima' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }else{
            $pengiriman = PengirimanBarang::create([
                'id_pengiriman' => $request->id_pengiriman,
                'tanggal_kirim' => $request->tanggal_kirim,
                'layanan' => $request->layanan,
                'nama_pengirim' => $request->nama_pengirim,
                'alamat_pengirim' => $request->alamat_pengirim,
                'nama_penerima' => $request->nama_penerima,
                'alamat_penerima' => $request->alamat_penerima,
                'id_kodepos' => $request->id_kodepos,
                'nohp_penerima' => $request->nohp_penerima
            ]);

            return new PengirimanBarangResource(true, 'Data berhasil tersimpan', $pengiriman);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengiriman = PengirimanBarang::find($id);

        if($pengiriman){
            return new PengirimanBarangResource(true, 'Data ditemukan', $pengiriman);
        }else{
            return response()->json([
                'message' => 'Data Not Found !'
            ], 422);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'tanggal_kirim' => 'required',
            'layanan' => 'required',
            'nama_pengirim' => 'required',
            'alamat_pengirim' => 'required',
            'nama_penerima' => 'required',
            'alamat_penerima' => 'required',
            'id_kodepos' => 'required',
            'nohp_penerima' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }else{
            $pengiriman = PengirimanBarang::find($id);

            if($pengiriman){
                $pengiriman->tanggal_kirim = $request->tanggal_kirim;
                $pengiriman->layanan = $request->layanan;
                $pengiriman->nama_pengirim = $request->nama_pengirim;
                $pengiriman->alamat_pengirim = $request->alamat_pengirim;
                $pengiriman->nama_penerima = $request->nama_penerima;
                $pengiriman->alamat_penerima = $request->alamat_penerima;
                $pengiriman->id_kodepos = $request->id_kodepos;
                $pengiriman->nohp_penerima = $request->nohp_penerima;
                $pengiriman->save();

                return new PengirimanBarangResource(true, 'Data berhasil di update', $pengiriman);
            }else{
                return response()->json([
                    'message' => 'Data not found'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengiriman = PengirimanBarang::find($id);

            if($pengiriman){
                $pengiriman->delete();

                return new PengirimanBarangResource(true, 'Data berhasil dihapus', '');
            }else{
                return response()->json([
                    'message' => 'Data not found'
                ]);
            }
    }
}
