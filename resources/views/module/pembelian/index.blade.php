@extends('main')
@section('title', '| Pembelian')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success m-4">Export xlxs</button>
                        <button class="btn btn-primary m-4">Tambah data</button>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Pelanggan</th>
                                    <th scope="col">Tanggal Penjualan</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Dibuat Oleh</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <td>NON-MEMBER</td>
                                    <td>01 Januari 2025</td>
                                    <td>Rp. 1.000.000</td>
                                    <td>Pegawai Tidak Ada</td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#lihat-1">Lihat</button>
                                        </div>
                                    </td>
                                </tr>
                             
                                
                                <div class="modal fade" id="lihat-1" tabindex="-1" aria-labelledby="modalLihat" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLihat">Detail Penjualan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <small>
                                                            Member Status : Member</br>
                                                            No. HP : 112</br>
                                                            Poin Member : 700
                                                        </small>
                                                    </div>
                                                    <div class="col-6">
                                                        <small>
                                                            Bergabung Sejak : 22 Feb 27
                                                        </small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3 text-center mt-5">
                                                    <div class="col-3"><b>Nama Produk</b></div>
                                                    <div class="col-3"><b>Qty</b></div>
                                                    <div class="col-3"><b>Harga</b></div>
                                                    <div class="col-3"><b>Sub Total</b></div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col-3 text-center">Produk A</div>
                                                    <div class="col-3 text-center">2</div>
                                                    <div class="col-3 text-center">Rp. 500.000</div>
                                                    <div class="col-3 text-center">Rp. 1.000.000</div>
                                                </div>
                                                <div class="row text-center mt-3">
                                                    <div class="col-9 text-end"><b>Total</b></div>
                                                    <div class="col-3"><b>Rp. 1.000.000</b></div>
                                                </div>
                                                <div class="row mt-3">
                                                    <center>
                                                        Dibuat pada : 27 Febuary 2027 <br> Oleh : 
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
