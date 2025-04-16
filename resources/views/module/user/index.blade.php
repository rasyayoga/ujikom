@extends('main')
@section('title', '| User')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0">Daftar List</h4>
                    <button type="button" class="btn btn-info mb-4">Tambah User</button>
                </div>
                <div class="table-responsive">
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
                            <tr>
                                <td>1</td>
                                <td>user1@example.com</td>
                                <td>User Satu</td>
                                <td>Admin</td>
                                <td>
                                    <button class="btn btn-warning">Edit</button>
                                    <button class="btn btn-danger" onclick="confirm('Yakin ingin menghapus User ini?')">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>user2@example.com</td>
                                <td>User Dua</td>
                                <td>Member</td>
                                <td>
                                    <button class="btn btn-warning">Edit</button>
                                    <button class="btn btn-danger" onclick="confirm('Yakin ingin menghapus User ini?')">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>user3@example.com</td>
                                <td>User Tiga</td>
                                <td>Guest</td>
                                <td>
                                    <button class="btn btn-warning">Edit</button>
                                    <button class="btn btn-danger" onclick="confirm('Yakin ingin menghapus User ini?')">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection