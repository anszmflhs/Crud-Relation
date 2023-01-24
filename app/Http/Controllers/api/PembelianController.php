<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pembeli;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PembelianController extends Controller
{
    public function CreateBarang(Request $request)
    {
        $input = $request->all();
        $rules = [
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $validator->errors()
                ],
                404
            );
        }
        $barang = Barang::create($input);
        return response()->json(
            [
                'status' => true,
                'data' => $barang,
            ]
        );
    }
    public function CreatePembeli(Request $request)
    {
        $input = $request->all();
        $rules = [
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required',
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $validator->errors()
                ],
                404
            );
        }
        $pembeli = Pembeli::create($input);
        return response()->json(
            [
                'status' => true,
                'data' => $pembeli,
            ]
        );
    }
    public function CreatePembelian(Request $request)
    {
        $data = $request->all();
        $rules = [
            'barang_id' => 'required',
            'pembeli_id' => 'required',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $validator->errors()
                ],
                404
            );
        }
        $barang = Barang::find($data['barang_id']);
        if (!$barang) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Ga ketemu barangnya woe'
                ],
                404
            );
        }
        $pembeli = Pembeli::find($data['pembeli_id']);
        if (!$pembeli) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Pembelinya mana woe'
                ],
                404
            );
        }
        $date = date('Y-m-md h:i:s');

        $pembelian = Pembelian::create(
            [
                'tanggal' => $date,
                'barang_id' => $data['barang_id'],
                'pembeli_id' => $data['pembeli_id'],
            ]
        );

        return response()->json([
            'status' => true,
            'data' => $pembelian,
        ]);
    }
    public function ShowPembeli($id)
    {
        $pembeli = Pembeli::with('Pembelians')->find($id);
        if (!$pembeli) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Pembelinya mana',
                ],
                404
            );
        }
        return response()->json(
            [
                'status' => true,
                'data' => $pembeli
            ]
        );
    }
}
