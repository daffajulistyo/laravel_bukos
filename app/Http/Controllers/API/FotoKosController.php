<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\FotoKos;

class FotoKosController extends Controller
{
    public function addFotoKos(Request $request)
    {
        try {
            $request->validate([
                'foto_kos' => ['required', 'string', 'max:255'],
                'boardinghouses_id' => ['required', 'integer'],
            ]);

            FotoKos::create([
                'foto_kos' => $request->foto_kos,
                'boardinghouses_id' => $request->boardinghouses_id,
            ]);

            $fotokos = FotoKos::where('foto_kos', $request->foto_kos)->first();

            return ResponseFormatter::success(
                $fotokos,
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
            $perId = FotoKos::find($id);
            if ($id) {
                return ResponseFormatter::success(
                    $perId,
                    'Data Foto Kos Berhasil Ditampilkan'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data Foto Kos Gagal Ditampilkan',
                    404
                );
            }
        }

        $fotokos = FotoKos::all();
        return ResponseFormatter::success(
            $fotokos,
            'Mantap'
        );
    }
}
