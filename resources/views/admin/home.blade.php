@extends('admin.layout')
@section('content')
    @php
    $univ = new App\Models\Universitas();
    $univfav = new App\Models\UniversitasFav();
    $sekolah = new App\Models\Sekolah();
    $siswa = new App\Models\Siswa();
    @endphp
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ count($univ->all()) }}</h3>

                                <p>Jumlah Universitas</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ url('admin/universitas/data-universitas') }}" class="small-box-footer">More info
                                <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ count($univfav->all()) }}</h3>

                                <p>Universitas Favorit</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ url('admin/universitas/universitas-fav') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ count($sekolah->all()) }}</h3>

                                <p>Jumlah Sekolah</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ url('admin/data-sekolah') }}" class="small-box-footer">More info
                                <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ count($siswa->all()) }}</h3>

                                <p>Siswa Terdaftar</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ url('admin/data-siswa/data-siswa') }}" class="small-box-footer">More info
                                <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h4>Grafik Data Siswa di Universitas Favorit</h4>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="position-relative mb-4" style="height: 500px">
                                    {{-- <canvas id="sales-chart" height="300"></canvas> --}}
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('javascript')
    <script>
        $(function() {
            $('#nav-home').addClass('active');

            var url = "{{ url('admin/config') }}";
            var headers = {
                "Accept": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }

            $.ajax({
                url: url,
                method: "POST",
                headers: headers,
                data: {
                    req: 'getCart',
                },
                success: function(res) {
                    const data = {
                        labels: res.univ,
                        datasets: [{
                            label: 'Jumlah Siswa',
                            backgroundColor: 'rgb(75, 192, 192)',
                            borderColor: 'rgb(255, 99, 132)',
                            data: res.siswa,
                        }]
                    };

                    const config = {
                        type: 'bar',
                        data: data,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            responsive: true,
                            maintainAspectRatio: false
                        },
                    };

                    const myChart = new Chart(
                        document.getElementById('myChart'),
                        config
                    );

                }
            });
        });
    </script>
@endsection
