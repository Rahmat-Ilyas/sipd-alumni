<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\Universitas;
use App\Models\UniversitasFav;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sekolah');
    }
    
    public function home()
    {
        return view('sekolah/home');
    }

    public function page($page)
    {
        return view('sekolah/' . $page);
    }

    public function pagedir($dir = NULL, $page)
    {
        return view('sekolah/' . $dir . '/' . $page);
    }

    public function store(Request $request, $target)
    {
        if ($target == 'dataalumni') {
            $this->validate($request, [
                'nisn' => 'unique:siswa',
            ]);
            $data = $request->all();
            Siswa::create($data);
            return back()->with('success', 'Data alumni berhasil ditambahkan');
        }
    }

    public function update(Request $request, $target)
    {
        if ($target == 'profilsekolah') {
            $cek_npsn = Sekolah::where('npsn', $request->npsn)->where('id', '!=', $request->id)->first();
            if ($cek_npsn) {
                return redirect()->back()->withInput($request->all())->withErrors(['error' => ['NPSN sudah terdaftar']]);
            }
            
            $sekolah = Sekolah::where('id', $request->id)->first();
            if ($request->password == '') $except = ['_token', 'id', 'password'];
            else {
                $except = ['_token', 'id'];
                $request['password'] = bcrypt($request->password);
            }
            foreach ($request->except($except) as $key => $data) {
                $sekolah->$key = $data;
            }
            $sekolah->save();

            return back()->with('success', 'Profil sekolah berhasil diupdate');
        } else if ($target == 'akun') {
            $akun = Sekolah::where('id', $request->id)->first();
            if ($request->password == '') $except = ['_token', 'id', 'password'];
            else {
                $except = ['_token', 'id'];
                $request['password'] = bcrypt($request->password);
            }
            foreach ($request->except($except) as $key => $data) {
                $akun->$key = $data;
            }
            $akun->save();

            return back()->with('success', 'Data akun berhasil diupdate');
        }
    }

    public function delete($target, $id)
    {
        if ($target == 'dataalumni') {
            $alumni = Universitas::where('id', $id)->first();
            $alumni->delete();

            return back()->with('success', 'Data alumni berhasil dihapus');
        }
    }

    public function config(Request $request)
    {
        if ($request->req == 'getKota') {
            $kota = Kota::where('provinsi_id', $request->provinsi_id)->get();
            $option = '<option value="">.::Pilih Kota::.</option>';
            foreach ($kota as $dta) {
                $option .= '<option value="'.$dta->id.'">'.$dta->nama_kota.'</option>';
            }
            return response()->json($option, 200);
        }
    }
}