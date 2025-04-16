@extends('main')
@section('title', '| Pilih Product')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <section>
                        <div class="text-center container">
                            <div class="row">

                                <div class="col-lg-4 col-md-6">
                                    <div class="card">
                                        <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light">
                                            <img src="{{ asset('storage/produk.jpg') }}" class="w-50" />
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title mb-3" id="name_1">Produk Contoh</h5>
                                
                                            <p>Stok: <span id="stock_1">10</span></p>
                                            <h6 class="mb-3">Rp. 100.000</h6>
                                            <input type="hidden" id="price_1" value="100000">
                                            
                                            <center>
                                                <table>
                                                    <tr>
                                                        <td style="padding: 0px 10px; cursor: pointer;" onclick="updateQty(1, -1)"><b>-</b></td>
                                                        <td style="padding: 0px 10px;" id="quantity_1" data-stock="10">0</td>
                                                        <td style="padding: 0px 10px; cursor: pointer;" onclick="updateQty(1, 1)"><b>+</b></td>
                                                    </tr>
                                                </table>
                                            </center>
                                
                                            <br>
                                            <p>Sub Total <b><span id="total_1">Rp. 0</span></b></p>
                                        </div>
                                    </div>
                                </div>
                                
                            
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Footer Fixed -->
                <div class="row fixed-bottom d-flex justify-content-end align-content-center"
                    style="margin-left: 18%; width: 83%; height: 70px; border-top: 3px solid #EEE4B1; background-color: white;">
                    <div class="col text-center" style="margin-right: 50px;">
                        <form action="{{ route('sales.store') }}" method="post">
                            @csrf
                            <div id="shop"></div>
                            <button class="btn btn-primary">Selanjutnya</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

