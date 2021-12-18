<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class TransactionController extends Controller
{
    

    public function all(Request $request)
    {

        $id = $request->input('id');
        $limit = $request->input('limit');
        $status = $request->input('status');

        if($id)
        {
            $transaction = Transaction::with(['user'])->find($id);

            if($transaction)
            {
                return ResponseFormatter::success(
                    $transaction,
                    'Data Berhasil'
                );
            }
            else
            {
                return ResponseFormatter::error(
                    null,
                    'Data Error Lagi Yaa',
                    404
                );
            }
        }

        $transaction = Transaction::with('user')->where('users_id',Auth::user()->id);
        
        if($status)
        {
            $transaction->where('status',$status);
        }

        return ResponseFormatter::success(
            $transaction->paginate($limit),'Data BErhasil diambil'
        );



    }
}
