<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FotoKamar;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class FotoKamarController extends Controller
{
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

        $fasilitas = Fasilitas::all();
        return ResponseFormatter::success(
            $fasilitas,
            'Mantap'
        );
    }
}
