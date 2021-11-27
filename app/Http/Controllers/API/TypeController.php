<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class TypeController extends Controller
{
    public function addType(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'boardinghouses_id' => ['required', 'integer'],
            ]);

            Type::create([
                'name' => $request->name,
                'boardinghouses_id' => $request->boardinghouses_id,
            ]);

            $Type = Type::where('name', $request->name)->first();

            return ResponseFormatter::success(
                $Type,
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
            $perId = Type::find($id);
            if ($perId) {
                return ResponseFormatter::success(
                    $perId,
                    'Data Type Berhasil Ditampilkan Y'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data Type Gagal Ditampilkan',
                    404
                );
            }
        }

        $Type = Type::all();
        return ResponseFormatter::success(
            $Type,
            'Mantap'
        );

           
    }
}
