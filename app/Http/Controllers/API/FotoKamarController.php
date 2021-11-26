<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FotoKamar;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class FotoKamarController extends Controller
{
    public function addFotoKamar(Request $request)
    {
        try {
            $request->validate([
                'foto_kamar' => ['required', 'string', 'max:255'],
                'boardinghouses_id' => ['required', 'integer'],
            ]);

            FotoKamar::create([
                'foto_kamar' => $request->foto_kamar,
                'boardinghouses_id' => $request->boardinghouses_id,
            ]);

            $fasilitas = FotoKamar::where('foto_kamar', $request->foto_kamar)->first();

            return ResponseFormatter::success(
                $fasilitas,
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
            $perId = FotoKamar::find($id);
            if ($id) {
                return ResponseFormatter::success(
                    $perId,
                    'Data Foto Kamar Berhasil Ditampilkan'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data Foto Kamar Gagal Ditampilkan',
                    404
                );
            }
        }

        $fotokamar = FotoKamar::all();
        return ResponseFormatter::success(
            $fotokamar,
            'Mantap'
        );
    }
}
