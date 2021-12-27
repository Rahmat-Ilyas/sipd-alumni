@extends('admin.layout')
@section('content')
    @php
    $data = new App\Models\Sekolah();
    $provinsi = new App\Models\Provinsi();
    @endphp
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Sekolah</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Sekolah</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add"><i
                                        class="fas fa-plus"></i> Tambah Data</button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NPSN</th>
                                            <th>Nama Sekolah</th>
                                            <th>Telepon</th>
                                            <th>Email</th>
                                            <th>Provinsi</th>
                                            <th>Kab/Kota</th>
                                            <th>Alamat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->all() as $i => $dta)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $dta->npsn }}</td>
                                                <td>{{ $dta->nama_sekolah }}</td>
                                                <td>{{ $dta->telepon ? $dta->telepon : '-' }}</td>
                                                <td>{{ $dta->email ? $dta->email : '-' }}</td>
                                                <td>{{ $dta->provinsi->nama_provinsi }}</td>
                                                <td>{{ $dta->get_kota($dta->kota_id) }}</td>
                                                <td>{{ $dta->alamat }}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-primary mb-2" data-toggle="modal"
                                                        data-target="#modal-edit{{ $dta->id }}" data-toggle1="tooltip"
                                                        title="Edit Data"><i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-danger mb-2" data-toggle="modal"
                                                        data-target="#modal-del{{ $dta->id }}" data-toggle1="tooltip"
                                                        title="Hapus Data"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <div class="modal fade" id="modal-add" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Sekolah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ url('admin/store/datasekolah') }}">
                    @csrf
                    <div class="modal-body px-5">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">NPSN</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="npsn" placeholder="NPSN.." required=""
                                    autocomplete="off" value="{{ old('npsn') ? old('npsn') : '' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Nama Sekolah</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama_sekolah" placeholder="Nama Sekolah.."
                                    required="" autocomplete="off"
                                    value="{{ old('nama_sekolah') ? old('nama_sekolah') : '' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Email & Telepon</label>
                            <div class="col-sm-5">
                                <input type="email" class="form-control" name="email" placeholder="Email.."
                                    autocomplete="off" value="{{ old('email') ? old('email') : '' }}">
                            </div>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="telepon" placeholder="Telepon.."
                                    autocomplete="off" value="{{ old('telepon') ? old('telepon') : '' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Provinsi</label>
                            <div class="col-sm-9">
                                <select name="provinsi_id" class="form-control select2" id="provinsi_id"
                                    data-live-search="true" required="" autocomplete="off">
                                    <option value="">.::Pilih Provinsi::.</option>
                                    @foreach ($provinsi->all() as $prv)
                                        <option value="{{ $prv->id }}">{{ $prv->nama_provinsi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Kabupaten/Kota</label>
                            <div class="col-sm-9">
                                <select name="kota_id" class="form-control select2" data-live-search="true" required=""
                                    autocomplete="off" id="kota_view">
                                    <option value="">.::Pilih Provinsi Terlebih Dahulu::.</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control mb-1" name="alamat" placeholder="Alamat.." required=""
                                    autocomplete="off">{{ old('alamat') ? old('alamat') : '' }}</textarea>
                                <span class="text-info">Note: username dan password login
                                    sama dengan npsn</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($data->all() as $dta)
        <div class="modal fade" id="modal-edit{{ $dta->id }}" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Sekolah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{ url('admin/update/datasekolah') }}">
                        @csrf
                        <div class="modal-body px-5">
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">NPSN</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="npsn" placeholder="NPSN.." required=""
                                        autocomplete="off" value="{{ $dta->npsn }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Nama Sekolah</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama_sekolah"
                                        placeholder="Nama Sekolah.." required="" autocomplete="off"
                                        value="{{ $dta->nama_sekolah }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Email & Telepon</label>
                                <div class="col-sm-5">
                                    <input type="email" class="form-control" name="email" placeholder="Email.."
                                        autocomplete="off" value="{{ $dta->email }}">
                                </div>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="telepon" placeholder="Telepon.."
                                        autocomplete="off" value="{{ $dta->telepon }}">
                                </div>
                            </div>
                            <div class="distrik-edt">
                                <div class="form-group row">
                                    <label class="col-form-label col-sm-3">Provinsi</label>
                                    <div class="col-sm-9">
                                        <select name="provinsi_id" class="form-control select2 prov-edt"
                                            id="provinsi_id{{ $dta->id }}" data-live-search="true" required=""
                                            autocomplete="off">
                                            <option value="">.::Pilih Provinsi::.</option>
                                            @foreach ($provinsi->all() as $prv)
                                                <option value="{{ $prv->id }}">{{ $prv->nama_provinsi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-sm-3">Kabupaten/Kota</label>
                                    <div class="col-sm-9">
                                        <select name="kota_id" class="form-control select2 kota-edt" data-live-search="true"
                                            required="" autocomplete="off" id="kota_view{{ $dta->id }}">
                                            <option value="">.::Pilih Kota::.</option>
                                            @foreach ($dta->provinsi->get_kota($dta->provinsi_id) as $kta)
                                                <option value="{{ $kta->id }}">
                                                    {{ $kta->nama_kota }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control mb-1" name="alamat" placeholder="Alamat.." required=""
                                        autocomplete="off">{{ $dta->alamat }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" name="username" class="form-control" placeholder="Username.."
                                        autocomplete="off" required value="{{ $dta->username }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="text" name="password" class="form-control" placeholder="Password.."
                                        autocomplete="off">
                                    <span class="text-info">Note: Silahkan masukkan password baru untuk
                                        mengganti password lama</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" value="{{ $dta->id }}">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-del{{ $dta->id }}" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ url('admin/delete/datasekolah/' . $dta->id) }}" role="button"
                            class="btn btn-danger">Hapus</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('javascript')
    <script>
        $(function() {
            $('#nav-sekolah').addClass('active');

            var url = "{{ url('admin/config') }}";
            var headers = {
                "Accept": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }

            $('#provinsi_id').change(function(e) {
                e.preventDefault();
                var provinsi_id = $(this).val();
                getKota(provinsi_id);
            });

            $('.prov-edt').change(function(e) {
                e.preventDefault();
                var provinsi_id = $(this).val();
                var kota = $(this).parents('.distrik-edt').find('.kota-edt');
                getKota(provinsi_id, kota);
            });

            function getKota(provinsi_id, target = null) {
                $.ajax({
                    url: url,
                    method: "POST",
                    headers: headers,
                    data: {
                        req: 'getKota',
                        provinsi_id: provinsi_id
                    },
                    success: function(data) {
                        $('#kota_view').html(data);
                        if (target) {
                            $(target).html(data);
                        }
                    }
                });
            }

            @foreach ($data->all() as $dta)
                $('#provinsi_id{{ $dta->id }}').val("{{ $dta->provinsi_id }}").select2();
                $('#kota_view{{ $dta->id }}').val("{{ $dta->kota_id }}").select2();
            @endforeach
        });
    </script>
@endsection
