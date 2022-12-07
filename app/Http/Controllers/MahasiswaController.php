<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;


class MahasiswaController extends Controller
{


    public function __construct(Request $request) //
    {
        $this->request = $request;
    }

    public function getAllMahasiswa()
    {
        $mahasiswa = Mahasiswa::with('MataKuliah')->get();

        return response()->json([
            'status' => 'success',
            'mahasiswa' => $mahasiswa
        ], 200);
    }

    public function getMahasiswaByNim($nim)
    {
        $nimMhsw = $nim;
        $mahasiswa = Mahasiswa::find($nimMhsw);

        return response()->json([
            'status' => 'success',
            'mahasiswa' => [
                "nim" => $mahasiswa->nim,
                "nama" => $mahasiswa->nama,
                "angkatan" => $mahasiswa->angkatan,
                "matakuliah" => $mahasiswa->matakuliah
            ]
        ], 200);
    }

    public function getMahasiswaByToken(Request $request)
    {
        return response()->json([
            'status' => 'success',
            "mahasiswa" => $request->user
        ], 200);
    }

    public function AddMataKuliahToMahasiswa(Request $request, $nim, $mkId)
    {
        $nimMhsw = $nim;
        $matakuliah = $mkId;

        if($matakuliah > 5) {
            return response()->json([
                "status" => "error",
                "message" => "Mata kuliah tidak ada"
            ], 400);
        }

        $dataMahasiswa = Mahasiswa::with('MataKuliah')->where("nim", $request->nim)->first();
        $matkulMahasiswa = $dataMahasiswa->matakuliah;
        $isMatkulExist = false;
        

        for ($i=0; $i < count($matkulMahasiswa) ; $i++) { 
            if ($matkulMahasiswa[$i]->id == $matakuliah ) {
                $isMatkulExist = true;
            }
        }


        if($isMatkulExist) {
            return response()->json([
                "status" => "error",
                "message" => "Mata kuliah sudah terdaftar, silahkan pilih yang lain"
            ], 200);
        }

        if($request->nim != $nimMhsw) {
            return response()->json([
                "status" => "error",
                "message" => "Kredensial login berbeda"
            ], 200);
        }

        $mahasiswa = Mahasiswa::find($request->nim);
        $mahasiswa->MataKuliah()->attach($matakuliah);

        return response()->json([
            "status" => "success",
            "message" => "Mata kuliah berhasil ditambah"
        ], 200);
    }

    public function DeleteMataKuliahOnMahasiswa(Request $request, $nim, $mkId)
    {   
        if($request->nim != $nim) {
            return response()->json([
                "status" => "error",
                "message" => "Kredensial login berbeda"
            ], 400);
        }

        $mahasiswa = Mahasiswa::find($nim);
        $mahasiswa->MataKuliah()->detach($mkId);

        return response()->json([
            "status" => "success",
            "message" => "Mata kuliah berhasil dihapus"
        ], 200);
    }
}
