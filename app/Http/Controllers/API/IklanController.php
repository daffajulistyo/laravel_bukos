<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Iklan;

class IklanController extends Controller
{
    public function addIklan(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'url_iklan' => ['required', 'string'],
            ]);

            Iklan::create([
                'name' => $request->name,
                'url_iklan' => $request->url_iklan,
            ]);

            $iklan = Iklan::where('name', $request->name)->first();

            return ResponseFormatter::success(
                $iklan,
                'Data Iklan Berhasil Ditambahkan'
            );
            
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something Went Wrong',
                'error' => $error,
            ], 'Imput Iklan Failed', 500);
        }
    }

    public function all(Request $request)
    {
        $id = $request->input('id');

        if ($id) {
            $perId = Iklan::find($id);
            if ($perId) {
                return ResponseFormatter::success(
                    $perId,
                    'Data Iklan Berhasil Ditampilkan'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data Iklan Gagal Ditampilkan',
                    404
                );
            }
        }

        $iklan = Iklan::all();
        return ResponseFormatter::success(
            $iklan,
            'Mantap'
        );
    }
}
