@extends('main')
@section('title', '| Edit User')

@section('content')

<div class="row">
  @if ($errors->any())
  <div class="alert alert-danger">
      @foreach($errors->all() as $item)
      <li>{{ $item }}</li>
      @endforeach
  </div>
@endif
    <form action="{{ route('user.update', $users->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
      
        <!-- Nama User -->
        <div class="mb-3">
          <label for="name" class="form-label">Nama User</label>
          <input type="text" class="form-control border-secondary"  id="name" name="name" value="{{ $users->name }}" required>
        </div>
      
        <!-- email -->
        <div class="mb-3">
          <label for="email" class="form-label">Email User</label>
          <input type="email" class="form-control border-secondary"  id="email" name="email" value="{{ $users->email }}" required>
        </div>
      
        <!-- password -->
        <div class="mb-3">
          <label for="password" class="form-label">Password Baru User</label>
          <input type="password" class="form-control border-secondary" id="password" name="password">
        </div>

        <!-- role -->
        <div class="mb-3">
          <label for="role" class="form-label">Role</label>
          <select name="role" id="role" class="form-select" >
              <option selected disabled hidden>Pilih Role</option>
              <option value="admin">Admin</option>
              <option value="employee">employee</option>
          </select>
      </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary">Simpan</button>
      </form>      
</div>

@endsection
