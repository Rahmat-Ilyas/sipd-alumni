<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables as DataTables;

use App\Models\Admin;
use App\Models\Universitas;
use App\Models\UniversitasFav;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\Kota;
use App\Models\Provinsi;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function home()
    {
        return view('admin/home');
    }

    public function page($page)
    {
        return view('admin/' . $page);
    }

    public function pagedir($dir = NULL, $page)
    {
        return view('admin/' . $dir . '/' . $page);
    }

    public function store(Request $request, $target)
    {
        if ($target == 'datauniversitas') {
            $this->validate($request, [
                'npsn' => 'unique:universitas',
            ]);
            $data = $request->all();
            Universitas::create($data);
            return back()->with('success', 'Data universitas berhasil ditambahkan');
        } else if ($target == 'universitas-fav') {
            $data = $request->all();
            UniversitasFav::create($data);
            return back()->with('success', 'Universitas favorit berhasil ditambahkan');
        } else if ($target == 'datasekolah') {
            $this->validate($request, [
                'npsn' => 'unique:sekolah',
            ]);
            $data = $request->all();
            $data['username'] = $request->npsn;
            $data['password'] = bcrypt($request->npsn);
            Sekolah::create($data);
            return back()->with('success', 'Data sekolah berhasil ditambahkan');
        } else if ($target == 'dataprovinsi') {
            $data = $request->all();
            $data['nama_provinsi'] = strtoupper($request->nama_provinsi);
            Provinsi::create($data);
            return back()->with('success', 'Data provinsi berhasil ditambahkan');
        } else if ($target == 'datakota') {
            $data = $request->all();
            $data['nama_kota'] = strtoupper($request->nama_kota);
            Kota::create($data);
            return back()->with('success', 'Data kabupaten/kota berhasil ditambahkan');
        }
    }

    public function update(Request $request, $target)
    {
        if ($target == 'datauniversitas') {
            $cek_npsn = Universitas::where('npsn', $request->npsn)->where('id', '!=', $request->id)->first();
            if ($cek_npsn) {
                return redirect()->back()->withInput($request->all())->withErrors(['error' => ['NPSN sudah terdaftar']]);
            }

            $update = Universitas::where('id', $request->id)->first();
            $except = ['_token', 'id'];
            foreach ($request->except($except) as $key => $data) {
                $update->$key = $data;
            }
            $update->save();

            return back()->with('success', 'Data universitas berhasil diupdate');
        } else if ($target == 'datasekolah') {
            $cek_npsn = Sekolah::where('npsn', $request->npsn)->where('id', '!=', $request->id)->first();
            if ($cek_npsn) {
                return redirect()->back()->withInput($request->all())->withErrors(['error' => ['NPSN sudah terdaftar']]);
            }

            $update = Sekolah::where('id', $request->id)->first();
            if ($request->password == '') $except = ['_token', 'id', 'password'];
            else {
                $except = ['_token', 'id'];
                $request['password'] = bcrypt($request->password);
            }
            foreach ($request->except($except) as $key => $data) {
                $update->$key = $data;
            }
            $update->save();

            return back()->with('success', 'Data sekolah berhasil diupdate');
        } else if ($target == 'akun') {
            $akun = Admin::where('id', $request->id)->first();
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
        } else if ($target == 'dataprovinsi') {
            $update = Provinsi::where('id', $request->id)->first();
            $update->nama_provinsi = strtoupper($request->nama_provinsi);
            $update->save();

            return back()->with('success', 'Data provinsi berhasil diupdate');
        } else if ($target == 'datakota') {
            $update = Kota::where('id', $request->id)->first();
            $update->provinsi_id = $request->provinsi_id;
            $update->nama_kota = strtoupper($request->nama_kota);
            $update->save();

            return back()->with('success', 'Data kabupaten/kota berhasil diupdate');
        }
    }

    public function delete($target, $id)
    {
        if ($target == 'datasekolah') {
            $data = Sekolah::where('id', $id)->first();
            $data->delete();

            return back()->with('success', 'Data sekolah berhasil dihapus');
        } else if ($target == 'universitas') {
            $data = Universitas::where('id', $id)->first();
            $data->delete();
            $delfav = UniversitasFav::where('universitas_id', $id)->first();
            $delfav->delete();

            return back()->with('success', 'Data universitas berhasil dihapus');
        } else if ($target == 'universitasfav') {
            $data = UniversitasFav::where('id', $id)->first();
            $data->delete();

            return back()->with('success', 'Data universitas favorit berhasil dihapus');
        } else if ($target == 'provinsi') {
            $data = Provinsi::where('id', $id)->first();
            $data->delete();

            return back()->with('success', 'Data provinsi berhasil dihapus');
        } else if ($target == 'kota') {
            $data = Kota::where('id', $id)->first();
            $data->delete();

            return back()->with('success', 'Data kabupaten/kota berhasil dihapus');
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
        } else if ($request->req == 'getUnivDetail') {
            $res = Universitas::where('id', $request->universitas_id)->first();
            $res['provinsi_'] = $res->provinsi->nama_provinsi;
            $res['kota'] = $res->get_kota($res->kota_id);
            return response()->json($res, 200);
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
                ->orderBy('tahun_lulus', 'desc');

            if ($request->get == 'asal_sekolah') {
                $result = $result->where('sekolah_id', $request->value)->get();
            } else if ($request->get == 'universitas') {
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
            })->addColumn('sekolah', function ($dta) {
                return $dta->nama_sekolah;
            })->addColumn('action', function ($dta) {
                return '<div class="text-center">
				<button type="button" class="btn btn-primary btn-sm waves-effect waves-light btn-detail" data-toggle1="tooltip" title="Lihat Detail Siswa" data-toggle="modal" data-target=".modal-detail" data-id="' . $dta->id . '"><i class="fa fa-list"></i> Detail</button>
				</div>';
            })->rawColumns(['action'])->toJson();
        } else if ($request->req == 'getSiswaFav') {
            $result = DB::table('siswa')
                ->join('universitas', 'siswa.universitas_id', '=', 'universitas.id')
                ->join('sekolah', 'siswa.sekolah_id', '=', 'sekolah.id')
                ->select('siswa.*', 'universitas.nama_pt', 'sekolah.nama_sekolah')
                ->orderBy('tahun_lulus', 'desc');

            if ($request->get == 'all') {
                $result = $result->join('universitas_fav', 'siswa.universitas_id', '=', 'universitas_fav.universitas_id')->get();
            } else if ($request->get == 'universitas') {
                $result = $result->where('universitas_id', $request->value)->get();
            } else if ($request->get == 'universitas_alt') {
                $result = $result->where('universitas_id', $request->value2)->where('tahun_masuk_pt', $request->value)->get();
            }

            return DataTables::of($result)->addColumn('no', function ($dta) {
                return null;
            })->addColumn('universitas', function ($dta) {
                return $dta->nama_pt;
            })->addColumn('sekolah', function ($dta) {
                return $dta->nama_sekolah;
            })->addColumn('action', function ($dta) {
                return '<div class="text-center">
				<button type="button" class="btn btn-primary btn-sm waves-effect waves-light btn-detail" data-toggle1="tooltip" title="Lihat Detail Siswa" data-toggle="modal" data-target=".modal-detail" data-id="' . $dta->id . '"><i class="fa fa-list"></i> Detail</button>
				</div>';
            })->rawColumns(['action'])->toJson();
        }
    }
}