<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pengelola;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class PengelolaController extends Controller
{
    public function addPengelola(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'phone_num' => ['required', 'string', 'min:10'],
                'boardinghouses_id' => ['required', 'integer'],
            ]);

            Pengelola::create([
                'name' => $request->name,
                'phone_num' => $request->phone_num,
                'boardinghouses_id' => $request->boardinghouses_id,
            ]);

            $pengelola = Pengelola::where('name', $request->name)->first();

            return ResponseFormatter::success(
                $pengelola,
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
            $perId = Pengelola::find($id);
            if ($id) {
                return ResponseFormatter::success(
                    $perId,
                    'Data Pengelola Berhasil Ditampilkan'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data Pengelola Gagal Ditampilkan',
                    404
                );
            }
        }

        $pengelola = Pengelola::all();
        return ResponseFormatter::success(
            $pengelola,
            'Mantap'
        );
    }
}
