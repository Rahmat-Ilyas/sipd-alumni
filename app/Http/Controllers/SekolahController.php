<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables as DataTables;

use App\Models\Kota;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\Universitas;
use App\Models\UniversitasFav;
use Illuminate\Support\Facades\Auth;

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
        if ($target == 'dataalumni') {
            $cek_nisn = Siswa::where('nisn', $request->nisn)->where('id', '!=', $request->id)->first();
            if ($cek_nisn) {
                return redirect()->back()->withInput($request->all())->withErrors(['error' => ['NISN sudah ada di database']]);
            }

            $siswa = Siswa::where('id', $request->id)->first();
            $except = ['_token', 'id'];
            foreach ($request->except($except) as $key => $data) {
                $siswa->$key = $data;
            }
            $siswa->save();

            return back()->with('success', 'Data siswa berhasil diupdate');
        } else if ($target == 'profilsekolah') {
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
                $option .= '<option value="' . $dta->id . '">' . $dta->nama_kota . '</option>';
            }
            return response()->json($option, 200);
        } else if ($request->req == 'getSiswaDetail') {
            $res = Siswa::where('id', $request->id)->first();
            $res['sekolah_'] = $res->sekolah->nama_sekolah;
            $res['universitas_'] = $res->universitas->nama_pt;
            return response()->json($res, 200);
        }
    }

    public  function datatable(Request $request)
    {
        if ($request->req == 'getSiswa') {
            $result = DB::table('siswa')
                ->join('universitas', 'siswa.universitas_id', '=', 'universitas.id')
                ->join('sekolah', 'siswa.sekolah_id', '=', 'sekolah.id')
                ->select('siswa.*', 'universitas.nama_pt', 'sekolah.nama_sekolah')
                ->where('sekolah_id', Auth::user()->id)
                ->orderBy('tahun_lulus', 'desc');

            if ($request->get == 'universitas') {
                $result = $result->where('universitas_id', $request->value)->get();
            } else if ($request->get == 'tahun_lulus') {
                $result = $result->where('tahun_lulus', $request->value)->get();
            } else if ($request->get == 'tahun_masuk') {
                $result = $result->where('tahun_masuk_pt', $request->value)->get();
            } else if ($request->get == 'sekolah_alt') {
                $result = $result->where('sekolah_id', $request->value2)->where('tahun_lulus', $request->value)->get();
            } else if ($request->get == 'universitas_alt') {
                $result = $result->where('universitas_id', $request->value2)->where('tahun_masuk_pt', $request->value)->get();
            }

            return DataTables::of($result)->addColumn('no', function ($dta) {
                return null;
            })->addColumn('universitas', function ($dta) {
                return $dta->nama_pt;
            })->addColumn('action', function ($dta) {
                return '<div class="text-center">
				<button type="button" class="btn btn-primary btn-sm waves-effect waves-light btn-edit" data-toggle1="tooltip" title="Edit Data Siswa" data-toggle="modal" data-target=".modal-edit" data-id="' . $dta->id . '"><i class="fa fa-edit"></i></button>
				<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light btn-detail" data-toggle1="tooltip" title="Lihat Detail Siswa" data-toggle="modal" data-target=".modal-detail" data-id="' . $dta->id . '"><i class="fa fa-list"></i></button>
				</div>';
            })->rawColumns(['action'])->toJson();
        }
    }
}