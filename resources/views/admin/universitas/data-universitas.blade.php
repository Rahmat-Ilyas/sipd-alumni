@extends('admin.layout')
@section('content')
    @php
    $data = new App\Models\Universitas();
    $provinsi = new App\Models\Provinsi();
    @endphp
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Universitas</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Universitas</a></li>
                            <li class="breadcrumb-item active">Data Universitas</li>
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
                                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i
                                        class="fas fa-plus"></i> Tambah Data</button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NPSN</th>
                                            <th>Nama Universitas</th>
                                            <th>Kelompok</th>
                                            <th>Akreditasi</th>
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
                                                <td>{{ $dta->nama_pt }}</td>
                                                <td>{{ $dta->kelompok_pt }}</td>
                                                <td>{{ $dta->akreditasi }}</td>
                                                <td>{{ $dta->provinsi->nama_provinsi }}</td>
                                                <td>{{ $dta->get_kota($dta->kota_id) }}</td>
                                                <td>{{ $dta->alamat }}</td>
                                                <td width="10" class="text-center">
                                                    <button class="btn btn-sm btn-secondary mb-2" data-toggle="modal"
                                                        data-target="#modal-detail{{ $dta->id }}"
                                                        data-toggle1="tooltip" title="Lihat Detail">
                                                        <i class="fas fa-list"></i>
                                                    </button>
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

    <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Universitas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ url('admin/store/datauniversitas') }}">
                    @csrf
                    <div class="modal-body px-5">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">NPSN</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="npsn" placeholder="NPSN.." required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Nama Universitas</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama_pt" placeholder="Nama Universitas.."
                                    required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Kelompok & Akreditasi</label>
                            <div class="col-sm-5">
                                <select name="kelompok_pt" class="form-control" required="">
                                    <option value="">.::Pilih Kelompok::.</option>
                                    <option value="PTA">PTA</option>
                                    <option value="PTK">PTK</option>
                                    <option value="PTN">PTN</option>
                                    <option value="PTS">PTS</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="akreditasi" placeholder="Akreditasi.."
                                    required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Email & Telepon</label>
                            <div class="col-sm-5">
                                <input type="email" class="form-control" name="email" placeholder="Email..">
                            </div>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="telepon" placeholder="Telepon..">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Website</label>
                            <div class="col-sm-9">
                                <input type="url" class="form-control" name="website" placeholder="Website..">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Provinsi</label>
                            <div class="col-sm-9">
                                <select name="provinsi_id" class="form-control select2" id="provinsi_id"
                                    data-live-search="true" required="">
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
                                    id="kota_view">
                                    <option value="">.::Pilih Provinsi Terlebih Dahulu::.</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="alamat" placeholder="Alamat.."
                                    required=""></textarea>
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
        <div class="modal fade" id="modal-detail{{ $dta->id }}" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Universitas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>NPSN</td>
                                    <td>:</td>
                                    <td>{{ $dta->npsn }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Universitas</td>
                                    <td>:</td>
                                    <td>{{ $dta->nama_pt }}</td>
                                </tr>
                                <tr>
                                    <td>Kelompok</td>
                                    <td>:</td>
                                    <td>{{ $dta->kelompok_pt }}</td>
                                </tr>
                                <tr>
                                    <td>Akreditasi</td>
                                    <td>:</td>
                                    <td>{{ $dta->akreditasi }}</td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>:</td>
                                    <td>{{ $dta->telepon }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>{{ $dta->email }}</td>
                                </tr>
                                <tr>
                                    <td>Website</td>
                                    <td>:</td>
                                    <td><a href="{{ $dta->website }}" target="_blank">{{ $dta->website }}</a></td>
                                </tr>
                                <tr>
                                    <td>Provinsi</td>
                                    <td>:</td>
                                    <td>{{ $dta->provinsi->nama_provinsi }}</td>
                                </tr>
                                <tr>
                                    <td>Kabupaten/Kota</td>
                                    <td>:</td>
                                    <td>{{ $dta->get_kota($dta->kota_id) }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>{{ $dta->alamat }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer" style="margin-top: -20px;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-edit{{ $dta->id }}" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Universitas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{ url('admin/update/datauniversitas') }}">
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
                                <label class="col-form-label col-sm-3">Nama Universitas</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama_pt"
                                        placeholder="Nama Universitas.." required="" value="{{ $dta->nama_pt }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Kelompok & Akreditasi</label>
                                <div class="col-sm-5">
                                    <select name="kelompok_pt" class="form-control" required=""
                                        id="kelompok_pt{{ $dta->id }}">
                                        <option value="">.::Pilih Kelompok::.</option>
                                        <option value="PTA">PTA</option>
                                        <option value="PTK">PTK</option>
                                        <option value="PTN">PTN</option>
                                        <option value="PTS">PTS</option>
                                    </select>
                                    <script>
                                        document.getElementById('kelompok_pt{{ $dta->id }}').value = "{{ $dta->kelompok_pt }}";
                                    </script>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="akreditasi" placeholder="Akreditasi.."
                                        required="" value="{{ $dta->akreditasi }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Email & Telepon</label>
                                <div class="col-sm-5">
                                    <input type="email" class="form-control" name="email" placeholder="Email.."
                                        value="{{ $dta->email }}">
                                </div>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="telepon" placeholder="Telepon.."
                                        value="{{ $dta->telepon }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Website</label>
                                <div class="col-sm-9">
                                    <input type="url" class="form-control" name="website" placeholder="Website.."
                                        value="{{ $dta->website }}">
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
                                                <option value="{{ $prv->id }}">{{ $prv->nama_provinsi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-sm-3">Kabupaten/Kota</label>
                                    <div class="col-sm-9">
                                        <select name="kota_id" class="form-control select2 kota-edt"
                                            data-live-search="true" required="" autocomplete="off"
                                            id="kota_view{{ $dta->id }}">
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
                        <a href="{{ url('admin/delete/universitas/' . $dta->id) }}" role="button"
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
            $('#nav-data-univ').addClass('active').parents('.nav-top').addClass('menu-open').find(
                '#nav-universitas').addClass('active');

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
