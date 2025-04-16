@extends('main')
@section('title', '| Detail Pembelian')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <table style="width: 100%;">
                                        <thead>
                                            <h2>Produk yang dipilih</h2>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Produk A <br> <small>Rp. 500.000 X 2</small></td>
                                                <td><b>Rp. 1.000.000</b></td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top: 20px; font-size: 20px;"><b>Total</b></td>
                                                <td class="text-end" style="padding-top: 20px; font-size: 20px;">
                                                    <b>Rp. 1.000.000</b>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="member" class="form-label">Member Status</label>
                                            <small class="text-danger">Dapat juga membuat member</small>
                                            <select name="member" id="member" class="form-select" onchange="memberDetect()">
                                                <option value="Bukan Member">Bukan Member</option>
                                                <option value="Member">Member</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" id="phone-group">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12">No Telepon <small class="text-danger">(daftar/gunakan member)</small></label>
                                                <div class="col-md-12">
                                                    <input type="number" id="no_hp" name="no_hp"
                                                        class="form-control form-control-line @error('no_hp') is-invalid @enderror"
                                                        onKeyPress="if(this.value.length==13) return false;">
                                                    @error('no_hp')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="total_pay" class="form-label">Total Bayar</label>
                                            <input type="text" id="total_pay" class="form-control">
                                        </div>
                                    </div>                                    
                                    <div class="row text-end">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary" type="button">Pesan</button>
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