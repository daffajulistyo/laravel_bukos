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
                'name' => ['required', 'string', 'max:255', 'unique:boarding_houses'],
                'location' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:255'],
                'price' => ['required', 'string'],
                'discount' => ['required', 'string'],
                'years' => ['required', 'string'],
                'latitude' => ['required', 'string'],
                'longitude' => ['required', 'string'],
            ]);

            BoardingHouse::create([
                'name' => $request->name,
                'location' => $request->location,
                'description' => $request->description,
                'price' => $request->price,
                'discount' => $request->discount,
                'years' => $request->years,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            $kost = BoardingHouse::where('name', $request->name)->first();

            return ResponseFormatter::success(
                $kost,
                'Data Kos Berhasil Ditambahkan Y'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something Went Wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
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
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        if ($id) {
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
                'fasilitas',
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
            'fasilitas',
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

        if ($latitude) {
            $kost->where('latitude', 'like', '%' . $latitude . '$');
        }

        if ($longitude) {
            $kost->where('longitude', 'like', '%' . $longitude . '$');
        }

        return ResponseFormatter::success(
            $kost->paginate($limit),
            'Data Kos Berhasil Ditampilkan'
        );
    }
}
