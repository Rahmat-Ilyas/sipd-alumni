@extends('admin.layout')
@section('content')
    @php
    $data = new App\Models\UniversitasFav();
    $universitas = new App\Models\Universitas();
    @endphp
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Universitas Favorit</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Universitas</a></li>
                            <li class="breadcrumb-item active">Universitas Favorit</li>
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
                                            <th>Provinsi</th>
                                            <th>Kab/Kota</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->all() as $i => $dta)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $dta->universitas->npsn }}</td>
                                                <td>{{ $dta->universitas->nama_pt }}</td>
                                                <td>{{ $dta->universitas->provinsi->nama_provinsi }}</td>
                                                <td>{{ $dta->universitas->get_kota($dta->universitas->kota_id) }}</td>
                                                <td width="120" class="text-center">
                                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                        data-target="#modal-del{{ $dta->id }}">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Universitas Favorit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ url('admin/store/universitas-fav') }}">
                    @csrf
                    <div class="modal-body px-5">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4">NPSN/Nama Universitas</label>
                            <div class="col-sm-8">
                                <select name="universitas_id" class="form-control selectpicker" id="universitas_id"
                                    data-live-search="true" required="">
                                    <option value="">.::Pilih NPSN/Nama Universitas::.</option>
                                    @foreach ($universitas->get_uniq() as $unv)
                                        <option value="{{ $unv->id }}">{{ $unv->npsn . '/' . $unv->nama_pt }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <h4 class="text-center">Detail Universitas</h4>
                        <div class="row justify-content-center">
                            <div class="col-sm-10">
                                <table class="">
                                    <tr style="height: 10px">
                                        <td width="200"><b>NPSN</b></td>
                                        <td width="10">:</td>
                                        <td id="vl_npsn">-</td>
                                    </tr>
                                    <tr>
                                        <td width="200"><b>Nama Universitas</b></td>
                                        <td width="10">:</td>
                                        <td id="vl_nama_pt">-</td>
                                    </tr>
                                    <tr>
                                        <td width="200"><b>Kelompok</b></td>
                                        <td width="10">:</td>
                                        <td id="vl_kelompok_pt">-</td>
                                    </tr>
                                    <tr>
                                        <td width="200"><b>Akreditasi</b></td>
                                        <td width="10">:</td>
                                        <td id="vl_akreditasi">-</td>
                                    </tr>
                                    <tr>
                                        <td width="200"><b>Telepon</b></td>
                                        <td width="10">:</td>
                                        <td id="vl_telepon">-</td>
                                    </tr>
                                    <tr>
                                        <td width="200"><b>Email</b></td>
                                        <td width="10">:</td>
                                        <td id="vl_email">-</td>
                                    </tr>
                                    <tr>
                                        <td width="200"><b>Website</b></td>
                                        <td width="10">:</td>
                                        <td id="vl_website">-</td>
                                    </tr>
                                    <tr>
                                        <td width="200"><b>Provinsi</b></td>
                                        <td width="10">:</td>
                                        <td id="vl_provinsi_">-</td>
                                    </tr>
                                    <tr>
                                        <td width="200"><b>Kabupaten/Kota</b></td>
                                        <td width="10">:</td>
                                        <td id="vl_kota">-</td>
                                    </tr>
                                    <tr>
                                        <td width="200"><b>Alamat</b></td>
                                        <td width="10">:</td>
                                        <td id="vl_alamat">-</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Tambahkan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($data->all() as $dta)
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
                        <a href="{{ url('admin/delete/universitasfav/' . $dta->id) }}" role="button"
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
            $('#nav-univ-fav').addClass('active').parents('.nav-top').addClass('menu-open').find(
                '#nav-universitas').addClass('active');
            $('.selectpicker').selectpicker();

            var url = "{{ url('admin/config') }}";
            var headers = {
                "Accept": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }

            $('#universitas_id').change(function(e) {
                e.preventDefault();
                var universitas_id = $(this).val();

                $.ajax({
                    url: url,
                    method: "POST",
                    headers: headers,
                    data: {
                        req: 'getUnivDetail',
                        universitas_id: universitas_id
                    },
                    success: function(data) {
                        $.each(data, function(key, val) {
                            $('#vl_' + key).text(val);
                        });
                    }
                });
            });
        });
    </script>
@endsection
