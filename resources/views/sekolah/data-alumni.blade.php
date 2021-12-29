@extends('sekolah.layout')
@section('content')
    @php
    $sekolah = new App\Models\Sekolah();
    $provinsi = new App\Models\Provinsi();
    $universitas = new App\Models\Universitas();

    $siswa = new App\Models\Siswa();
    $tahun_lulus = [];
    $tahun_masuk = [];
    foreach ($siswa->all() as $sw) {
        $tahun_lulus[] = $sw->tahun_lulus;
        $tahun_masuk[] = $sw->tahun_masuk_pt;
    }
    @endphp
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Alumni</h1>
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
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Lihat Data Siswa Berdasarkan:</label>
                                                        <select class="form-control" id="select-data">
                                                            <option value="all">Semua Data</option>
                                                            <option value="universitas">Universitas Dimasuki</option>
                                                            <option value="tahun_lulus">Tahun Lulus Sekolah</option>
                                                            <option value="tahun_masuk">Tahun Masuk Universitas</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="universitas-view" class="col-6 row" hidden="">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Universitas Dimasuki:</label>
                                                            <select class="select2 form-control" id="universitas-opt">
                                                                <option value="">.::Pilih Universitas::.</option>
                                                                @foreach ($universitas->all() as $unv)
                                                                    <option value="{{ $unv->id }}">
                                                                        {{ $unv->nama_pt }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Tahun Masuk Universitas:</label>
                                                            <select class="select2 form-control" id="tahunmasuk-alt-opt"
                                                                disabled>
                                                                <option value="">.::Pilih Tahun Masuk::.</option>
                                                                @foreach (array_unique($tahun_masuk) as $tm)
                                                                    <option value="{{ $tm }}">
                                                                        {{ $tm }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="tahunlulus-view" class="col-3" hidden="">
                                                    <div class="form-group">
                                                        <label>Tahun Lulus:</label>
                                                        <select class="select2 form-control" id="tahunlulus-opt">
                                                            <option value="">.::Pilih Tahun Lulus::.</option>
                                                            @foreach (array_unique($tahun_lulus) as $tl)
                                                                <option value="{{ $tl }}">
                                                                    {{ $tl }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="tahunmasuk-view" class="col-3" hidden="">
                                                    <div class="form-group">
                                                        <label>Tahun Masuk Universitas:</label>
                                                        <select class="select2 form-control" id="tahunmasuk-opt">
                                                            <option value="">.::Pilih Tahun Masuk::.</option>
                                                            @foreach (array_unique($tahun_masuk) as $tm)
                                                                <option value="{{ $tm }}">
                                                                    {{ $tm }}
                                                                </option>
                                                            @endforeach
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

    <div class="modal fade modal-detail" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td colspan="3" class="text-center"><b>Data Siswa</b></td>
                            </tr>
                            <tr>
                                <td width="180">NISN</td>
                                <td width="10">:</td>
                                <td class="dtl dtl-nisn"></td>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>:</td>
                                <td class="dtl dtl-nama"></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td class="dtl dtl-jenis_kelamin"></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td class="dtl dtl-email"></td>
                            </tr>
                            <tr>
                                <td>Telepon</td>
                                <td>:</td>
                                <td class="dtl dtl-telepon">
                                </td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td class="dtl dtl-alamat"></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-center"><b>Data Seklah</b></td>
                            </tr>
                            <tr>
                                <td>Sekolah Asal</td>
                                <td>:</td>
                                <td class="dtl dtl-sekolah_"></td>
                            </tr>
                            <tr>
                                <td>Jurusan (Sekolah)</td>
                                <td>:</td>
                                <td class="dtl dtl-jurusan_skl"></td>
                            </tr>
                            <tr>
                                <td>Tahun Lulus</td>
                                <td>:</td>
                                <td class="dtl dtl-tahun_lulus"></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-center"><b>Data Universitas</b></td>
                            </tr>
                            <tr>
                                <td>Universitas</td>
                                <td>:</td>
                                <td class="dtl dtl-universitas_"></td>
                            </tr>
                            <tr>
                                <td>Jurusan (Universitas)</td>
                                <td>:</td>
                                <td class="dtl dtl-jurusan_pt"></td>
                            </tr>
                            <tr>
                                <td>Tahun Masuk</td>
                                <td>:</td>
                                <td class="dtl dtl-tahun_masuk_pt"></td>
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

    <div class="modal fade modal-edit" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Alumni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ url('sekolah/update/dataalumni') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-md-6 px-3">
                                <h5 class="mb-3 text-center">Data Siswa</h5>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Siswa</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nama" placeholder="Nama Siswa.."
                                            autocomplete="off" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="jenis_kelamin" required="" id="jenis_kelamin">
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" name="email" placeholder="Email.."
                                            required="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Telepon</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="telepon" placeholder="Telepon.."
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="alamat" placeholder="Alamat.."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 px-3">
                                <h5 class="mb-3 text-center">Data Sekolah</h5>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">NISN</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="nisn" placeholder="NISN.."
                                            required="" autocomplete="off" id="nisn">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jurusan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="jurusan_skl"
                                            placeholder="Jurusan (Sekolah)" required="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tahun Lulus</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="tahun_lulus"
                                            placeholder="Tahun Lulus.." required="" autocomplete="off">
                                    </div>
                                </div>
                                <h5 class="mb-3 text-center">Data Universitas </h5>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Universitas</label>
                                    <div class="col-sm-9">
                                        <select name="universitas_id" class="form-control select2" id="universitas_id"
                                            data-live-search="true" required="" autocomplete="off">
                                            <option value="">.::Pilih Universitas::.</option>
                                            @foreach ($universitas->all() as $unv)
                                                <option value="{{ $unv->id }}">
                                                    {{ $unv->nama_pt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jurusan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="jurusan_pt"
                                            placeholder="Jurusan (Universitas)" required="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tahun Masuk</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="tahun_masuk_pt"
                                            placeholder="Tahun Masuk.." required="" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id">
                        <input type="hidden" name="sekolah_id" value="{{ Auth::user()->id }}">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script>
        $(function() {
            $('#nav-data-alumni').addClass('active');

            var url = "{{ url('sekolah/config') }}";
            var headers = {
                "Accept": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }

            $('#select-data').change(function(e) {
                e.preventDefault();
                $('#sekolah-opt, #universitas-opt, #tahunlulus-opt, #tahunmasuk-opt').val('').select2();
                let val = $(this).val();

                if (val == 'all') {
                    $('#sekolah-view, #universitas-view, #tahunlulus-view, #tahunmasuk-view').attr('hidden',
                        '');
                    getData('all');
                } else if (val == 'universitas') {
                    $('#universitas-view').removeAttr('hidden');
                    $('#sekolah-view, #tahunlulus-view, #tahunmasuk-view').attr('hidden',
                        '');
                } else if (val == 'tahun_lulus') {
                    $('#tahunlulus-view').removeAttr('hidden');
                    $('#sekolah-view, #universitas-view, #tahunmasuk-view').attr('hidden',
                        '');
                } else if (val == 'tahun_masuk') {
                    $('#tahunmasuk-view').removeAttr('hidden');
                    $('#sekolah-view, #universitas-view, #tahunlulus-view').attr('hidden',
                        '');
                }
            });

            $('#universitas-opt').change(function(e) {
                e.preventDefault();

                $('#tahunmasuk-alt-opt').val('').select2();
                var get = $('#select-data').val();
                var val = $(this).val();

                if (val != '') {
                    $('#tahunmasuk-alt-opt').removeAttr('disabled');
                    getData(get, val);
                } else $('#tahunmasuk-alt-opt').attr('disabled', '');
            });

            $('#tahunlulus-opt').change(function(e) {
                e.preventDefault();

                var get = $('#select-data').val();
                var val = $(this).val();
                if (val != '') getData(get, val);
            });

            $('#tahunmasuk-opt').change(function(e) {
                e.preventDefault();

                var get = $('#select-data').val();
                var val = $(this).val();
                if (val != '') getData(get, val);
            });

            $('#tahunmasuk-alt-opt').change(function(e) {
                e.preventDefault();

                var get = 'universitas_alt';
                var unv = $('#universitas-opt').val();
                var val = $(this).val();
                if (val != '') getData(get, val, unv);
            });

            $(document).on('click', '.btn-detail', function(e) {
                e.preventDefault();

                $('.dtl').text('-');
                let data_id = $(this).attr('data-id');
                $.ajax({
                    url: url,
                    method: "POST",
                    headers: headers,
                    data: {
                        req: 'getSiswaDetail',
                        id: data_id
                    },
                    success: function(data) {
                        $.each(data, function(key, val) {
                            $('.dtl-' + key).text(val);
                        });
                    }
                });
            });

            $(document).on('click', '.btn-edit', function(e) {
                e.preventDefault();

                let data_id = $(this).attr('data-id');
                $.ajax({
                    url: url,
                    method: "POST",
                    headers: headers,
                    data: {
                        req: 'getSiswaDetail',
                        id: data_id
                    },
                    success: function(data) {
                        $.each(data, function(key, val) {
                            $('input[name="' + key + '"]').val(val);
                            $('select[name="' + key + '"]').val(val);
                            $('textarea[name="' + key + '"]').val(val);
                            $('#universitas_id').select2();
                        });
                    }
                });
            });

            getData('all');

            function getData(get, val = null, val2 = null) {
                $(".dataTableSiswa").dataTable().fnDestroy();
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
                    ajax: url + '/datatable?req=getSiswa&get=' + get + '&value=' + val + '&value2=' +
                        val2,
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
            }

        });
    </script>
@endsection
