@extends('main')
@section('title', '| User')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Daftar List</h4>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ route('user.export') }}">
                        <button type="button" class="btn btn-success mb-2">Export</button>
                    </a>
                    <a href="{{ route('user.create') }}">
                        <button type="button" class="btn btn-info mb-2">Tambah User</button>
                    </a>
                </div>
                <div class="table-responsive">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $item)
                        <li>{{ $item }}</li>
                        @endforeach
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Email</th>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $user->id) }}">
                                        <button class="btn btn-warning">Edit</button>
                                    </a>
                        
                                    <form action="{{ route('user.delete', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection