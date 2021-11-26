<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Jenis;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class JenisController extends Controller
{
    public function addJenis(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'boardinghouses_id' => ['required', 'integer'],
            ]);

            Jenis::create([
                'name' => $request->name,
                'boardinghouses_id' => $request->boardinghouses_id,
            ]);

            $jenis = Jenis::where('name', $request->name)->first();

            return ResponseFormatter::success(
                $jenis,
                'Data Berhasil Ditambahkan'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something Went Wrong',
                'error' => $error,
            ], 'Imput Data Failed', 500);
        }
    }

    public function all(Request $request)
    {
        $id = $request->input('id');

        if ($id) {
            $perId = Jenis::find($id);
            if ($id) {
                return ResponseFormatter::success(
                    $perId,
                    'Data Jenis Berhasil Ditampilkan'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data Jenis Gagal Ditampilkan',
                    404
                );
            }
        }

        $jenis = Jenis::all();
        return ResponseFormatter::success(
            $jenis,
            'Mantap'
        );
    }
}


