<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $hariini = date("Y-m-d");
        $nidn = Auth::guard('dosen')->user()->nidn;
        $presensihariini = DB::table('absensi')->where('nidn', $nidn)->where('tgl_presensi', $hariini)->first();
        return view('dosen.dashboard', compact('presensihariini'));
    }

    public function dashboardmahasiswa(){
        $nim = Auth::guard('mahasiswa')->user()->nim;
        $hariini = date("Y-m-d");
        $totaldosen = DB::table('dosen')->count();
        $dosendatang = DB::table('absensi')
            ->where('tgl_presensi', $hariini)
            ->distinct('nidn')
            ->count('nidn');
        return view('mahasiswa.dashboard' , compact('totaldosen', 'dosendatang'));
    }

    public function dashboardadmin()
    {
        $hariini = date("Y-m-d");
        $totaldosen = DB::table('dosen')->count();
        $dosendatang = DB::table('absensi')
            ->where('tgl_presensi', $hariini)
            ->distinct('nidn')
            ->count('nidn');
        return view('admin.dashboard', compact('totaldosen', 'dosendatang'));
    }
}
