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
        $name = $request->input('name');

        $fasilitas = Fasilitas::find($id);
        if ($id) {
            return ResponseFormatter::success(
                $fasilitas,
                'Data Kos Berhasil Ditampilkan'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Data Error',
                404
            );
        }
    }
}
