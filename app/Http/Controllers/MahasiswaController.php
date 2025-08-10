<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $hariini = date("Y-m-d");

        $dosendatang = DB::table('absensi')
            ->join('dosen', 'absensi.nidn', '=', 'dosen.nidn')
            ->where('absensi.tgl_presensi', $hariini)
            ->select('dosen.nama', 'dosen.foto', 'dosen.nidn', 'absensi.tgl_presensi', 'absensi.jam_in', 'absensi.jam_out')
            ->distinct()
            ->get();

        return view('mahasiswa.lihatdosen', compact('dosendatang'));
    }
}
