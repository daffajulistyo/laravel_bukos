<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    //
    public function all(Request $request)
    {
        $id = $request->input('id');

        if ($id) {
            $perId = Fasilitas::find($id);
            if ($id) {
                return ResponseFormatter::success(
                    $perId,
                    'Data Kos Berhasil Ditampilkan'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data Kos Gagal Ditampilkan',
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
