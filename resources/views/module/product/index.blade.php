@extends('main')
@section('title', '| Product')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Daftar Produk</h4>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ route('product.export') }}">
                        <button class="btn btn-success m-4">Export</button>
                    </a>
                    @if(Auth::user()->role === 'admin')                                            
                    <a href="{{ route('product.create') }}">
                        <button class="btn btn-primary m-4">Tambah data</button>
                    </a>

                @endif
                </div>
                <div class="table-responsive">
                    @if ($errors->any())
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                html: `{!! implode('<br>', $errors->all()) !!}`,
                                confirmButtonColor: "#d33",
                                confirmButtonText: "Tutup"
                            });
                        });
                    </script>
                @endif
                @if (session('success'))
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        Swal.fire({
                            title: "Sukses!",
                            text: "{!! session('success') !!}",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                    });
                </script>
                @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th> </th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                @if(Auth::user()->role === 'admin')                                            
                                <th>Action</th>
                            @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $product)
                            <tr>
                                <td>{{ $index +1  }}</td>
                                <td><img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="100"></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                @if(Auth::user()->role === 'admin')                                            
                                    <td>
                                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateStockModal{{ $product->id }}">
                                            Update Stock
                                        </button>
                                        <form action="{{ route('product.delete', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                            <!-- Modal Update Stock -->
                        <div class="modal fade" id="updateStockModal{{ $product->id }}" tabindex="-1" aria-labelledby="updateStockModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Stock</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('product.update.stock', $product->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="stock" class="form-label">Stock</label>
                                                <input type="number" class="form-control border-secondary" id="stock" name="stock" max="9999999999" oninput="this.value = this.value.slice(0, 10)" value="{{ $product->stock }}">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $products->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
