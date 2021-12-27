@extends('sekolah.layout')
@section('content')
    @php
    $universitas = new App\Models\Universitas();
    @endphp
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Input Data Alumni</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Input Data Alumni</li>
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
                            <div class="card-body">
                                <form class="form-horizontal" method="post"
                                    action="{{ url('sekolah/store/dataalumni') }}">
                                    @csrf
                                    <div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <div class="card card-secondary">
                                                <div class="card-body px-4">
                                                    <h5 class="mb-3 text-center">Data Siswa</h5>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Nama Siswa</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="nama"
                                                                placeholder="Nama Siswa.." autocomplete="off" required=""
                                                                value="{{ old('nama') ? old('nama') : '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control" name="jenis_kelamin" required=""
                                                                id="jenis_kelamin">
                                                                <option value="Laki-laki">Laki-laki</option>
                                                                <option value="Perempuan">Perempuan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Email</label>
                                                        <div class="col-sm-9">
                                                            <input type="email" class="form-control" name="email"
                                                                placeholder="Email.." required="" autocomplete="off"
                                                                value="{{ old('email') ? old('email') : '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Telepon</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" class="form-control" name="telepon"
                                                                placeholder="Telepon.." autocomplete="off"
                                                                value="{{ old('telepon') ? old('telepon') : '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Alamat</label>
                                                        <div class="col-sm-9">
                                                            <textarea class="form-control" name="alamat"
                                                                placeholder="Alamat..">{{ old('alamat') ? old('alamat') : '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card card-secondary">
                                                <div class="card-body px-4">
                                                    <h5 class="mb-3 text-center">Data Sekolah</h5>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">NISN</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" class="form-control" name="nisn"
                                                                placeholder="NISN.." required="" autocomplete="off"
                                                                id="nisn">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Jurusan</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="jurusan_skl"
                                                                placeholder="Jurusan (Sekolah)" required=""
                                                                autocomplete="off"
                                                                value="{{ old('jurusan_skl') ? old('jurusan_skl') : '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Tahun Lulus</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" class="form-control" name="tahun_lulus"
                                                                placeholder="Tahun Lulus.." required="" autocomplete="off"
                                                                value="{{ old('tahun_lulus') ? old('tahun_lulus') : '' }}">
                                                        </div>
                                                    </div>
                                                    <h5 class="mb-3 text-center">Data Universitas </h5>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Universitas</label>
                                                        <div class="col-sm-9">
                                                            <select name="universitas_id" class="form-control select2"
                                                                id="universitas_id" data-live-search="true" required=""
                                                                autocomplete="off">
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
                                                                placeholder="Jurusan (Universitas)" required=""
                                                                autocomplete="off"
                                                                value="{{ old('jurusan_pt') ? old('jurusan_pt') : '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Tahun Masuk</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" class="form-control"
                                                                name="tahun_masuk_pt" placeholder="Tahun Masuk.."
                                                                required="" autocomplete="off"
                                                                value="{{ old('tahun_masuk_pt') ? old('tahun_masuk_pt') : '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label"></label>
                                                        <div class="col-sm-9">
                                                            <input type="hidden" name="sekolah_id"
                                                                value="{{ Auth::user()->id }}">
                                                            <button type="submit"
                                                                class="btn btn-primary btn-block">Simpan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
            $('#nav-input-alumni').addClass('active');

            @if (old('jenis_kelamin'))
                $('#jenis_kelamin').val("{{ old('jenis_kelamin') }}");
                $('#universitas_id').select2('val', "{{ old('universitas_id') }}");
                $('#nisn').focus();
            @endif
        });
    </script>
@endsection
