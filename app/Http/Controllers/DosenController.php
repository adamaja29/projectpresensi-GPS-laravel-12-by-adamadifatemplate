<?php

namespace App\Http\Controllers;

use App\Models\dosen;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $query = dosen::query();
        $query->select('dosen.*');
        $query->orderBy('nama');
        if (!empty($request->nama)) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }
        $dosen = $query->paginate(10);
        $dosen->appends($request->all());
        return view('admin.dosen', compact('dosen'));
    }
    
    public function store(Request $request) {
        $nidn = $request->nidn;
        $nama = $request->nama;
        $nohp = $request->nohp;
        $password = Hash::make('1234');
        //$dosen = DB::table('dosen')->where('nidn', $nidn)->first();

        // Pengecekan panjang nidn
        if (strlen($nidn) > 18) {
            return Redirect::back()->with(['warning' => 'nidn terlalu panjang, maksimal 18 karakter']);
        }

        if ($request->hasFile('foto')) {
            $foto = $nidn . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }

        try {
            $data = [
                'nidn' => $nidn,
                'nama' => $nama,
                'nohp' => $nohp,
                'foto' => $foto,
                'password' => $password
            ];
            $simpan = DB::table('dosen')->insert($data);
            if ($simpan) {
                if ($request->hasFile('foto')) {
                    $request->file('foto')->move(public_path('uploads/profile/dosen'), $foto);
                }
    
                return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }
        } catch (\Exception $e) {
            //dd($e);
            $message = '';
            if ($e->getCode() == 23000) {
                $message = " Data dengan NIDN " . $nidn . " Sudah Ada";
            }
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan' . $message]);
        }
    }

    public function edit(Request $request) {
        $nidn = $request->nidn;
        $dosen = DB::table('dosen')->where('nidn', $nidn)->first();
        return view('admin.editdosen', compact('dosen'));
    }

    public function update ($nidn, Request $request) {
        $nama = $request->nama;
        $nohp = $request->nohp;
        $old_foto = $request->old_foto;
        $password = Hash::make('1234');
        //$dosen = DB::table('dosen')->where('nidn', $nidn)->first();

        // Pengecekan panjang nidn
        if (strlen($nidn) > 18) {
            return Redirect::back()->with(['warning' => 'nidn terlalu panjang, maksimal 18 karakter']);
        }

        if ($request->hasFile('foto')) {
            $foto = $nidn . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $old_foto; // gunakan foto lama jika tidak ada file baru
        }

        try {
            $data = [
                'nama' => $nama,
                'nohp' => $nohp,
                'foto' => $foto,
                'password' => $password
            ];
            $update = DB::table('dosen')->where('nidn', $nidn)->update($data);
            if ($update) {
                if ($request->hasFile('foto')) {
                    $request->file('foto')->move(public_path('uploads/profile/dosen'), $foto);
                }
    
                return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
            }
        } catch (\Exception $e) {
            //dd($e);
            $message = '';
            if ($e->getCode() == 23000) {
                $message = " Data dengan NIDN " . $nidn . " Sudah Ada";
            }
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate' . $message]);
        }
    }

    public function delete($nidn) {
        $dosen = DB::table('dosen')->where('nidn', $nidn)->first();
        if ($dosen) {
            // Hapus foto jika ada
            if ($dosen->foto && File::exists(public_path('uploads/profile/dosen/' . $dosen->foto))) {
                File::delete(public_path('uploads/profile/dosen/' . $dosen->foto));
            }
            DB::table('dosen')->where('nidn', $nidn)->delete();
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Tidak Ditemukan']);
        }
    }
}
