<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
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
        ]);
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
        ]);
    }

    public function getMahasiswaByToken(Request $request)
    {
        return response()->json([
            'status' => 'success',
            "mahasiswa" => $request->user
        ]);
    }

    public function AddMataKuliahToMahasiswa($nim, $mkId)
    {
        $nimMhsw = $nim;
        $matakuliah = $mkId;

        $mahasiswa = Mahasiswa::find($nimMhsw);
        $mahasiswa->MataKuliah()->attach($matakuliah);

        return response()->json([
            "mahasiswa" => $mahasiswa
        ]);
    }

    public function DeleteMataKuliahOnMahasiswa($nim, $mkId)
    {
        $mahasiswa = Mahasiswa::find($nim);
        $mahasiswa->MataKuliah()->detach($mkId);

        return response()->json([
            "success" => "Berhasil dihapus"
        ]);
    }
}
