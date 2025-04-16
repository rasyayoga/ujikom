@extends('main')
@section('title', '| Pembelian')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="table table-bordered">
                                        <table>
                                            <tr class="tabletitle">
                                                <td class="item">Nama Produk</td>
                                                <td class="item">QTy</td>
                                                <td class="item">Harga</td>
                                                <td class="item">Sub Total</td>
                                            </tr>
                                            <tr class="service">
                                                <td class="tableitem"><p class="itemtext">Produk A</p></td>
                                                <td class="tableitem"><p class="itemtext">2</p></td>
                                                <td class="tableitem"><p class="itemtext">Rp. 500.000</p></td>
                                                <td class="tableitem"><p class="itemtext">Rp. 1.000.000</p></td>
                                            </tr>
                                            <tr class="tabletitle">
                                                <td></td>
                                                <td></td>
                                                <td><h4>Total Harga</h4></td>
                                                <td><h4>Rp. 1.000.000</h4></td>
                                            </tr>
                                            <tr class="tabletitle">
                                                <td></td>
                                                <td></td>
                                                <td><h4>Total Bayar</h4></td>
                                                <td><h4>Rp. 1.000.000</h4></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Nama Member (identitas)</label>
                                            <input type="text" id="name" class="form-control" required value="John Doe" maxlength="50">
                                        </div>
                                        <div class="form-group">
                                            <label for="poin" class="form-label">Poin</label>
                                            <input type="text" id="poin" value="100" disabled class="form-control">
                                        </div>
                                        <div class="form-check ms-4">
                                            <input class="form-check-input" type="checkbox" value="Ya" id="check2" disabled>
                                            <label class="form-check-label" for="check2">Gunakan poin</label>
                                            <small class="text-danger">Poin tidak dapat digunakan pada pembelanjaan pertama.</small>
                                        </div>
                                    </div>
                                    <div class="row text-end">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary" type="button">Selanjutnya</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection