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
                        <h1 class="m-0">Semua Universitas</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Data Siswa Terdaftar</a></li>
                            <li class="breadcrumb-item active">Semua Universitas</li>
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
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="enhanced-results.html">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Result Type:</label>
                                                        <select class="select2 form-control input-sm" multiple="multiple"
                                                            data-placeholder="Any" style="width: 100%;">
                                                            <option>Text only</option>
                                                            <option>Images</option>
                                                            <option>Video</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Sort Order:</label>
                                                        <select class="select2 form-control input-sm" style="width: 100%;">
                                                            <option selected>ASC</option>
                                                            <option>DESC</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Order By:</label>
                                                        <select class="select2 form-control input-sm" style="width: 100%;">
                                                            <option selected>Title</option>
                                                            <option>Date</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <table class="table table-bordered table-striped dataTableSiswa">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NISN</th>
                                            <th>Nama Lengkap</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Asal Sekolah</th>
                                            <th>Tahun Lulus</th>
                                            <th>Universitas</th>
                                            <th>Tahun Masuk</th>
                                            <th width="80">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

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

@endsection

@section('javascript')
    <script>
        $(function() {
            $('#nav-data-siswa').addClass('active').parents('.nav-top').addClass('menu-open').find(
                '#nav-siswa-terdaftar').addClass('active');

            var url = "{{ url('admin/config') }}";
            var headers = {
                "Accept": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }

            $('.dataTableSiswa').DataTable({
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: url + '/datatable?req=getSiswa',
                columns: [{
                        data: 'no',
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'nisn',
                        name: 'nisn',
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin'
                    },
                    {
                        data: 'sekolah',
                        name: 'sekolah'
                    },
                    {
                        data: 'tahun_lulus',
                        name: 'tahun_lulus'
                    },
                    {
                        data: 'universitas',
                        name: 'universitas'
                    },
                    {
                        data: 'tahun_masuk_pt',
                        name: 'tahun_masuk_pt'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
    </script>
@endsection
