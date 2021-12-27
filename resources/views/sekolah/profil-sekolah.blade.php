@extends('sekolah.layout')
@section('content')
    @php
    $provinsi = new App\Models\Provinsi();
    $sekolah = new App\Models\Sekolah();
    $data = $sekolah->where('id', Auth::user()->id)->first();
    @endphp
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Profil Sekolah</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Profil Sekolah</li>
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
                                <h4 class="text-center">Data Sekolah</h4>
                                <hr>
                                <div class="row justify-content-center">
                                    <div class="col-sm-8">
                                        <div id="detail-profil-skl">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td width="180">NPSN</td>
                                                        <td width="10">:</td>
                                                        <td>{{ $data->npsn }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama Sekolah</td>
                                                        <td>:</td>
                                                        <td>{{ $data->nama_sekolah }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Telepon</td>
                                                        <td>:</td>
                                                        <td>{{ $data->telepon ? $data->telepon : '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td>:</td>
                                                        <td>{{ $data->email ? $data->email : '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Provinsi</td>
                                                        <td>:</td>
                                                        <td>{{ $data->provinsi->nama_provinsi }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kota</td>
                                                        <td>:</td>
                                                        <td>{{ $data->get_kota($data->kota_id) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alamat</td>
                                                        <td>:</td>
                                                        <td>{{ $data->alamat }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Username</td>
                                                        <td>:</td>
                                                        <td>{{ $data->username }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <button class="btn btn-primary" id="btn-edit-profil-skl"><i
                                                    class="fa fa-edit"></i> Edit Profil Sekolah</button>
                                        </div>
                                        <div id="edit-profil-skl" hidden="">
                                            <form method="POST" action="{{ url('sekolah/update/profilsekolah') }}">
                                                @csrf
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">NPSN</label>
                                                    <div class="col-sm-9">
                                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                                        <input type="number" name="npsn" class="form-control" required=""
                                                            autocomplete="off" placeholder="NPSN.."
                                                            value="{{ $data->npsn }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Nama Sekolah</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="nama_sekolah" class="form-control"
                                                            required="" autocomplete="off" placeholder="Nama Sekolah.."
                                                            value="{{ old('nama_sekolah') ? old('nama_sekolah') : $data->nama_sekolah }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Telepon</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" name="telepon" class="form-control"
                                                            placeholder="Telepon.." autocomplete="off"
                                                            value="{{ old('telepon') ? old('telepon') : $data->telepon }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="email" name="email" class="form-control"
                                                            placeholder="Email.." autocomplete="off"
                                                            value="{{ old('email') ? old('email') : $data->email }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-sm-3">Provinsi</label>
                                                    <div class="col-sm-9">
                                                        <select name="provinsi_id" class="form-control select2"
                                                            id="provinsi_id" data-live-search="true" required=""
                                                            autocomplete="off">
                                                            <option value="">.::Pilih Provinsi::.</option>
                                                            @foreach ($provinsi->all() as $prv)
                                                                <option value="{{ $prv->id }}">
                                                                    {{ $prv->nama_provinsi }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-sm-3">Kabupaten/Kota</label>
                                                    <div class="col-sm-9">
                                                        <select name="kota_id" class="form-control select2 kota_id"
                                                            data-live-search="true" required="" autocomplete="off"
                                                            id="kota_view">
                                                            <option value="">.::Pilih Kota::.</option>
                                                            @foreach ($data->provinsi->get_kota($data->provinsi_id) as $kta)
                                                                <option value="{{ $kta->id }}">
                                                                    {{ $kta->nama_kota }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Alamat</label>
                                                    <div class="col-sm-9">
                                                        <textarea name="alamat" class="form-control" required=""
                                                            placeholder="Alamat.."
                                                            rows="3">{{ old('alamat') ? old('alamat') : $data->alamat }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Username</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="username" class="form-control"
                                                            placeholder="Username.." autocomplete="off" required
                                                            value="{{ old('username') ? old('username') : $data->username }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Password</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="password" class="form-control"
                                                            placeholder="Password.." autocomplete="off">
                                                        <span class="text-info">Note: Silahkan masukkan password baru
                                                            untuk
                                                            mengganti password lama</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-9">
                                                        <button type="submit" class="btn btn-primary">Update Data</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            id="batal-edit-profil-skl">Batal</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                    </div>
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
            $('#nav-profil-sekolah').addClass('active');

            var url = "{{ url('sekolah/config') }}";
            var headers = {
                "Accept": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }

            $('#btn-edit-profil-skl').click(function(event) {
                $('#edit-profil-skl').removeAttr('hidden');
                $('#detail-profil-skl').attr('hidden', '');
            });
            $('#batal-edit-profil-skl').click(function(event) {
                $('#edit-profil-skl').attr('hidden', '');
                $('#detail-profil-skl').removeAttr('hidden');
            });

            $('#provinsi_id').change(function(e) {
                e.preventDefault();
                var provinsi_id = $(this).val();
                getKota(provinsi_id);
            });

            $('#provinsi_id').val("{{ $data->provinsi_id }}").select2();
            $('.kota_id').val("{{ $data->kota_id }}").select2();

            function getKota(provinsi_id) {
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
                    }
                });
            }

            @if (old('npsn'))
                $('#edit-profil-skl').removeAttr('hidden');
                $('#detail-profil-skl').attr('hidden', '');
                $('#provinsi_id').val("{{ old('provinsi_id') }}").select2();
                $('.kota_id').val("{{ old('kota_id') }}").select2();
            @endif
        });
    </script>
@endsection
