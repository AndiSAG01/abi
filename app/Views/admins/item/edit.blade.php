@extends('layouts.admin')

@section('content')
<div class="container py-3">
    <div class="card">
        <div class="card-header">Edit Data item</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header">Data Lama</h5>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama item</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $item['name'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $item['price'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $item['stock'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header">Data Baru</h5>
                        <div class="card-body">
                            <div class="form-group">
                                <form action="<?php echo base_url('/admins/item/update/' . $item['id']) ?>" method="POST">
                                    <div class="form-group">
                                        <label>Nama item</label>
                                        <input type="text" class="form-control" name="name" value="<?php echo $item['name'] ?>" placeholder="Masukkan Nama item">
                                    </div>
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="number" class="form-control" name="price" value="<?php echo $item['price'] ?>" placeholder="Masukkan Harga">
                                    </div>
                                    <div class="form-group">
                                        <label>Stok</label>
                                        <input type="number" class="form-control" name="stock" value="<?php echo $item['stock'] ?>" placeholder="Masukkan Jumlah Stok">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection