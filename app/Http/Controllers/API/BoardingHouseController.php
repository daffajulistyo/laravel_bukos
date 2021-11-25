<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\BoardingHouse;
use Illuminate\Http\Request;

class BoardingHouseController extends Controller
{
    public function addHouse(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'location' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'price' => ['required', 'string'],
                'discount' => ['required', 'string'],
                'years' => ['required', 'integer'],
            ]);

            BoardingHouse::create([
                'name' => $request->name,
                'location' => $request->location,
                'description' => $request->description,
                'price' => $request->price,
                'discount' => $request->discount,
                'years' => $request->years,
            ]);

            $kost = BoardingHouse::where('name', $request->name)->first();

            return ResponseFormatter::success(
                $kost,
                'Data Kos Berhasil Ditambahkan'
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
        $limit = $request->input('limit');
        $name = $request->input('name');
        $location = $request->input('location');
        $description = $request->input('description');
        $price = $request->input('price');
        $discount = $request->input('discount');
        $years = $request->input('years');

        if ($id) {
            $kost = BoardingHouse::with([
                // 'transactions',
                'jenis',
                'type',
                'kelas',
                'chats',
                'ratings',
                'pengelola',
                'fotoKos',
                'fotoKamars',
                'peraturans'
            ])->find($id);

            if ($kost) {
                return ResponseFormatter::success(
                    $kost,
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

        $kost = BoardingHouse::with([
            'transactions',
            'jenis',
            'type',
            'kelas',
            'chats',
            'ratings',
            'pengelola',
            'fotoKos',
            'fotoKamars',
            'peraturans'
        ]);

        if ($name) {
            $kost->where('name', 'like', '%' . $name . '$');
        }

        if ($description) {
            $kost->where('description', 'like', '%' . $description . '$');
        }

        if ($location) {
            $kost->where('location', 'like', '%' . $location . '$');
        }

        if ($price) {
            $kost->where('price', 'like', '%' . $price . '$');
        }

        if ($discount) {
            $kost->where('discount', 'like', '%' . $discount . '$');
        }

        if ($years) {
            $kost->where('years', 'like', '%' . $years . '$');
        }

        return ResponseFormatter::success(
            $kost->paginate($limit),
            'Data Kos Berhasil Ditampilkan'
        );
    }
}