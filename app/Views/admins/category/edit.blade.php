@extends('layouts.admin')

@section('content')
<div class="container py-3">
    <div class="card">
        <div class="card-header">Edit Data Kategori</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header">Data Lama</h5>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Kategori</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $category['name'] ?>" placeholder="Masukkan Nama Kategori" readonly >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header">Data Baru</h5>
                        <div class="card-body">
                            <div class="form-group">
                                <form action="<?php echo base_url('admins/kategori/update/'.$category['id']) ?>" method="POST">
                                    <label>Nama Kategori</label>
                                    <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Kategori">
                                    <button type="submit" class="btn btn-primary btn-sm mt-3">Update</button>
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