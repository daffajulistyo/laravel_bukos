<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function addKelas(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'banner' => ['required', 'string', 'max:255'],
                'boardinghouses_id' => ['required', 'integer'],
            ]);

            Kelas::create([
                'name' => $request->name,
                'banner' => $request->banner,
                'boardinghouses_id' => $request->boardinghouses_id,
            ]);

            $kelas = Kelas::where('name', $request->name)->first();

            return ResponseFormatter::success(
                $kelas,
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
            $perId = Kelas::find($id);
            if ($perId) {
                return ResponseFormatter::success(
                    $perId,
                    'Data Kelas Berhasil Ditampilkan'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data Kelas Gagal Ditampilkan',
                    404
                );
            }
        }

        $kelas = Kelas::all();
        return ResponseFormatter::success(
            $kelas,
            'Mantap'
        );
    }
}
