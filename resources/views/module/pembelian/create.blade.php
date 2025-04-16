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
                                @foreach ($product as $item)
                                    
                                <div class="col-lg-4 col-md-6">
                                    <div class="card">
                                        <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light">
                                            <img src="{{ asset('storage/' . $item->image) }}" class="w-50" />
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title mb-3" id="name_{{ $item->id }}">{{ $item->name }}</h5>

                                            <p>Stok: <span id="stock_{{ $item->id }}">{{ $item->stock }}</span></p>
                                            <h6 class="mb-3">Rp. {{ number_format($item->price, 0, ',', '.') }}</h6>
                                            <input type="hidden" id="price_{{ $item->id }}" value="{{ $item->price }}">
                                            
                                            <center>
                                                <table>
                                                    <tr>
                                                        <td style="padding: 0px 10px; cursor: pointer;" onclick="updateQty({{ $item->id }}, -1)"><b>-</b></td>
                                                        <td style="padding: 0px 10px;" id="quantity_{{ $item->id }}" data-stock="{{ $item->stock }}">0</td>
                                                        <td style="padding: 0px 10px; cursor: pointer;" onclick="updateQty({{ $item->id }}, 1)"><b>+</b></td>
                                                    </tr>
                                                </table>
                                            </center>
                            
                                            <br>
                                            <p>Sub Total <b><span id="total_{{ $item->id }}">Rp. 0</span></b></p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Footer Fixed -->
                <div class="row fixed-bottom d-flex justify-content-end align-content-center"
                    style="margin-left: 18%; width: 83%; height: 70px; border-top: 3px solid #EEE4B1; background-color: white;">
                    <div class="col text-center" style="margin-right: 50px;">
                        <form action="{{ route('sale.store') }}" method="POST">
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

@push('script')
<script>
function updateQty(id, change) {
    let qtyElem = document.getElementById("quantity_" + id);
    let price = parseInt(document.getElementById("price_" + id).value);
    let totalElem = document.getElementById("total_" + id);
    let stock = parseInt(qtyElem.getAttribute("data-stock")); // Ambil stok

    let qty = parseInt(qtyElem.innerText) + change;

    // Cek apakah jumlah melebihi stok
    if (qty > stock) {
        alert("Stok tidak mencukupi!");
        qty = stock;
    }

    // Cek apakah jumlah tidak kurang dari 0
    if (qty < 0) qty = 0;

    qtyElem.innerText = qty;
    totalElem.innerText = "Rp. " + formatRupiah(price * qty);

    // Hapus input jika qty 0
    let shopItem = document.getElementById("shop_item_" + id);
    if (shopItem) shopItem.remove();

    // Tambah input jika qty > 0
    if (qty > 0) {
    let productName = document.getElementById("name_" + id).innerText.trim();
    let input = `<input id="shop_item_${id}" name="shop[]" value="${id};${productName};${price};${qty};${price * qty}" type="hidden" />`;
    document.getElementById("shop").insertAdjacentHTML("beforeend", input);
}

}

function formatRupiah(angka) {
    return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

</script>
@endpush