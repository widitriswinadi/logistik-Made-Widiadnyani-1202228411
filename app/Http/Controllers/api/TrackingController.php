<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TrackingResource;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;


class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tracking = Tracking::all();

        return new TrackingResource(true, 'Data tracking', $tracking);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id_tracking' => 'required|unique:trackings,id_tracking',
            'jenis_barang' => 'required',
            'nama_barang' => 'required',
            'status' => 'required',
            'no_resi' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }else{
            $tracking = Tracking::create([
                'id_tracking' => $request->id_tracking,
                'jenis_barang' => $request->jenis_barang,
                'nama_barang' => $request->nama_barang,
                'status' => $request->status,
                'no_resi' => $request->no_resi
            ]);

            return new TrackingResource(true, 'Data berhasil tersimpan', $tracking);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tracking = Tracking::find($id);

        if($tracking){
            return new TrackingResource(true, 'Data ditemukan', $tracking);
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
            'jenis_barang' => 'required',
            'nama_barang' => 'required',
            'status' => 'required',
            'no_resi' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }else{
            $tracking = Tracking::find($id);

            if($tracking){
                $tracking->jenis_barang = $request->jenis_barang;
                $tracking->nama_barang = $request->nama_barang;
                $tracking->status = $request->status;
                $tracking->no_resi = $request->no_resi;
                $tracking->save();

                return new TrackingResource(true, 'Data berhasil di update', $tracking);
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
        $tracking = Tracking::find($id);

            if($tracking){
                $tracking->delete();

                return new TrackingResource(true, 'Data berhasil dihapus', '');
            }else{
                return response()->json([
                    'message' => 'Data not found'
                ]);
            }
    }
}
