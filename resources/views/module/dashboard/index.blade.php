@extends('main')
@section('title', '| Dashboard')

@section('content')

<div class="row">
    <div class="col-lg-12 p-3"> 
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Selamat Datang Yoga</h4> 
                <div class="card w-100">
                    <ul class="list-group list-group-flush d-flex flex-column" style="min-height: 200px;">
                        <li class="list-group-item bg-light d-flex justify-content-center align-items-center">
                            Total Penjualan Hari Ini
                        </li>
                        <li class="list-group-item flex-grow-1 d-flex flex-column justify-content-center align-items-center" style="min-height: 100px;">
                            <b style="font-size: 2rem;">12</b>
                            <span>Data terjual hari ini:</span>
                        </li>
                        
                        <li class="list-group-item bg-light d-flex justify-content-center align-items-center">
                            Terakhir diperbarui: 12-12-2021 12:12
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Selamat Datang Yoga F</h4>
                        </div>
                    </div>
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Statistik Penjualan</h4>
                    <canvas id="salesPieChart"></canvas>
                </div>
            </div>
        </div>
        
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection
