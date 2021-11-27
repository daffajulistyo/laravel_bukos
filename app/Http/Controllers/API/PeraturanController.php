<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Peraturan;

class PeraturanController extends Controller
{
    public function addPeraturan(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'boardinghouses_id' => ['required', 'integer'],
            ]);

            Peraturan::create([
                'name' => $request->name,
                'boardinghouses_id' => $request->boardinghouses_id,
            ]);

            $peraturan = Peraturan::where('name', $request->name)->first();

            return ResponseFormatter::success(
                $peraturan,
                'Data Berhasil Ditambahkan'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something Went Wrong',
                'error'   => $error,
            ],  'Imput Data Failed', 500);
        }
    }

    public function all(Request $request)
    {
        $id = $request->input('id');

        if ($id) {
            $perId = Peraturan::find($id);
            if ($perId) {
                return ResponseFormatter::success(
                    $perId,
                    'Data Peraturan Berhasil Ditampilkan'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data Peraturan Gagal Ditampilkan',
                    404
                );
            }
        }

        $peraturan = Peraturan::all();
        return ResponseFormatter::success(
            $peraturan,
            'Mantap'
        );
    }
}
