<?php

namespace App\Http\Controllers\API;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class RatingController extends Controller
{
    public function addRating(Request $request)
    {
        try {
            $request->validate([
                'clean_r' => ['required', 'string', 'max:255'],
                'boardinghouses_id' => ['required', 'integer'],
            ]);

            Rating::create([
                'clean_r' => $request->clean_r,
                'boardinghouses_id' => $request->boardinghouses_id,
            ]);

            $Rating = Rating::where('clean_r', $request->clean_r)->first();

            return ResponseFormatter::success(
                $Rating,
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
            $perId = Rating::find($id);
            if ($id) {
                return ResponseFormatter::success(
                    $perId,
                    'Data Rating Berhasil Ditampilkan'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data Rating Gagal Ditampilkan',
                    404
                );
            }
        }

        $Rating = Rating::all();
        return ResponseFormatter::success(
            $Rating,
            'Mantap'
        );
    }
}
