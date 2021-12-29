@extends('admin.layout')
@section('content')
    @php
    $provinsi = new App\Models\Provinsi();
    @endphp
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Provinsi</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                            <li class="breadcrumb-item active">Data Provinsi</li>
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
                            <div class="card-body row">
                                <div class="col-md-8">
                                    <table class="table table-bordered table-striped dataTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Provinsi</th>
                                                <th>Jumlah Kabupaten/Kota</th>
                                                <th width="80">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($provinsi->all() as $i => $dta)
                                                <tr>
                                                    <td>{{ $i + 1 }}</td>
                                                    <td>{{ $dta->nama_provinsi }}</td>
                                                    <td class="text-center">{{ $dta->jumlah_kota($dta->id) }}</td>
                                                    <td width="10" class="text-center">
                                                        <button class="btn btn-sm btn-primary mb-2" data-toggle="modal"
                                                            data-target="#modal-edit{{ $dta->id }}"
                                                            data-toggle1="tooltip" title="Edit Data"><i
                                                                class="fa fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-danger mb-2" data-toggle="modal"
                                                            data-target="#modal-del{{ $dta->id }}"
                                                            data-toggle1="tooltip" title="Hapus Data"><i
                                                                class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Provinsi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ url('admin/store/dataprovinsi') }}">
                    @csrf
                    <div class="modal-body px-5">
                        <div class="form-group">
                            <label class="col-form-label">Nama Provinsi</label>
                            <input type="tetx" class="form-control" name="nama_provinsi" placeholder="Nama Provinsi.."
                                required="" style="text-transform: uppercase;">
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

    @foreach ($provinsi->all() as $dta)

        <div class="modal fade" id="modal-edit{{ $dta->id }}" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Provinsi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{ url('admin/update/dataprovinsi') }}">
                        @csrf
                        <div class="modal-body px-5">
                            <div class="form-group">
                                <label class="col-form-label">Nama Provinsi</label>
                                <input type="text" class="form-control" name="nama_provinsi" placeholder="Nama Provinsi.."
                                    required="" value="{{ $dta->nama_provinsi }}" style="text-transform: uppercase;">
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
                        <a href="{{ url('admin/delete/provinsi/' . $dta->id) }}" role="button"
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
            $('#nav-provinsi').addClass('active').parents('.nav-top').addClass('menu-open').find(
                '#nav-master-data').addClass('active');

        });
    </script>
@endsection
