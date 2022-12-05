<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{


    public function __construct(Request $request) //
    {
        //

        $this->request = $request;
    }

    public function getAllMataKuliah()
    {
        $matakuliah = MataKuliah::all();

        return response()->json([
            'status' => 'success',
            'matakuliah' => $matakuliah
        ], 200);
    }
}
