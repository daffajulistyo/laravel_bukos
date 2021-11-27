<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class TransactionController extends Controller
{
    public function addTransaction(Request $request)
    {
        try {
            $request->validate([
                'users_id' => ['required', 'string', 'max:255'],
                'boardinghouses_id' => ['required', 'integer'],
            ]);

            Transaction::create([
                'users_id' => $request->users_id,
                'boardinghouses_id' => $request->boardinghouses_id,
            ]);

            $jenis = Transaction::where('users_id', $request->users_id)->first();

            return ResponseFormatter::success(
                $jenis,
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
            $perId = Transaction::find($id);
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

        $tr = Transaction::all();
        return ResponseFormatter::success(
            $tr,
            'Mantap'
        );

           
    }
}
