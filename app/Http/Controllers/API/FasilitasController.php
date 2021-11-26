<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function addFasilitas(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'boardinghouses_id' => ['required', 'integer'],
            ]);

            Fasilitas::create([
                'name' => $request->name,
                'boardinghouses_id' => $request->boardinghouses_id,
            ]);

            $fasilitas = Fasilitas::where('name', $request->name)->first();

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
