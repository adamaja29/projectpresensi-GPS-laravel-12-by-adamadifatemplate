<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class PresesniController extends Controller
{
    public function presensi(){
        $hariini = date('Y-m-d');            //query ini berfungsi untuk mengecek apakah dosen sudah melakukan absen hari ini
        
        $nidn = Auth::guard('dosen')->user()->nidn;
        $cek = DB::table('absensi')->where('tgl_presensi', $hariini)->where('nidn', $nidn)->count();
        
        //dd($jamkerja);
        return view('dosen.presensi', compact('cek'));
    }

    public function presensiStore(Request $request){
        $nidn = Auth::guard('dosen')->user()->nidn;
        $tgl_presensi = date('Y-m-d');
        $jam = date('H:i:s');


        $cek = DB::table('absensi')->where('tgl_presensi', $tgl_presensi)->where('nidn', $nidn)->count();
        $lokasi = $request->lokasi;
        if ($cek > 0) {
            $ket = "out";
        } else {
            $ket = "in";
        }
        $image = $request->image;

        $folderPath = "uploads/presensi/";
        $formatName = $nidn . "_" . $tgl_presensi . "_" . $ket;
        $image_parts = explode(";base64,", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;

        
        if($cek > 0){
            $dataPulang = [
                'jam_out' => $jam,
                'lokasi_out' => $lokasi,
                'foto_out' => $fileName
            ];
            $update = DB::table('absensi')->where('tgl_presensi', $tgl_presensi)->where('nidn', $nidn)->update($dataPulang);
            if($update){
                
                echo "success|Terima kasih, Selamat Beristirahat|out";
                file_put_contents($file, $image_base64);
                
            }else{
                echo "error|Maaf Gagal Absen|out";
            }
        }else {

        $data = [
            'nidn' => $nidn,
            'tgl_presensi' => $tgl_presensi,
            'jam_in' => $jam,
            'lokasi_in' => $lokasi,
            'foto_in' => $fileName
        ];
        $simpan = DB::table('absensi')->insert($data);
        if($simpan){
            echo "success|Absens masuk berhasil|in";
            file_put_contents($file, $image_base64);
        }else{
            echo "error|Maaf Gagal Absen|in";
        }
    }
    }

    //Menghitung Jarak(radius)
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    public function editProfile(){
        $nidn = Auth::guard('dosen')->user()->nidn;
        $dosen = DB::table('dosen')->where('nidn', $nidn)->first();
        return view('dosen.editprofile', compact('dosen'));
    }

    public function updateProfile(Request $request)
    {
        $nidn = Auth::guard('dosen')->user()->nidn;
        $nama = $request->nama;
        $nohp = $request->nohp;
        $dosen = DB::table('dosen')->where('nidn', $nidn)->first();

        // Handle password
        $password = !empty($request->password) ? Hash::make($request->password) : null;

        // Handle foto (base64 dari input hidden)
        $foto = $dosen->foto; // default: tidak diubah
        if ($request->cropped_image) {
            $imageData = $request->cropped_image;
            $imageParts = explode(';base64,', $imageData);
            $imageBase64 = base64_decode($imageParts[1]);
            $extension = explode('/', $imageParts[0])[1]; // Extract extension from MIME type
            $imageName = $nidn . '.' . $extension;
            $folderPath = public_path('uploads/profile/dosen/');

            // Simpan file hasil crop
            file_put_contents($folderPath . $imageName, $imageBase64);

            $foto = $imageName;
        }

        // Data untuk update
        $data = [
            'nama' => $nama,
            'nohp' => $nohp,
            'foto' => $foto,
        ];

        if ($password) {
            $data['password'] = $password;
        }

        $update = DB::table('dosen')->where('nidn', $nidn)->update($data);

        if ($update !== false) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        } else {
            return Redirect::back()->with(['error' => 'Data Gagal Diupdate']);
        }
    }
}
