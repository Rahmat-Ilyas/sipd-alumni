<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

use App\Models\Universitas;
use App\Models\UniversitasFav;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\Kota;

// use DataTables;
use Yajra\DataTables\Facades\DataTables as DataTables;

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

            return back()->with('success', 'Data universitas berhasil dihapus');
        } else if ($target == 'universitasfav') {
            $data = UniversitasFav::where('id', $id)->first();
            $data->delete();

            return back()->with('success', 'Data universitas favorit berhasil dihapus');
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
        } else if ($request->req == 'getUnivDetail') {
            $res = Universitas::where('id', $request->universitas_id)->first();
            $res['provinsi_'] = $res->provinsi->nama_provinsi;
            $res['kota'] = $res->get_kota($res->kota_id);
            return response()->json($res, 200);
        }
    }

    public  function datatable(Request $request)
    {
        if ($request->req == 'getSiswa') {
			$result = Siswa::all();
			$data = [];
			$no = 1;
			foreach ($result as $dta) {
				$dta->no = $no;
				$data[] = $dta;
				$no = $no + 1;
			}

			return DataTables::of($data)
			->addColumn('action', function($dta) {
				return '<div class="text-center">
				<button type="button" class="btn btn-primary btn-sm waves-effect waves-light btn-detail" data-toggle1="tooltip" title="Lihat Detail Siswa" data-toggle="modal" data-target=".modal-detail" data-id="'.$dta->id.'"><i class="fa fa-list"></i> Detail</button>
				</div>';
			})->rawColumns(['action'])->toJson();
		}
    }
}