@extends('layouts.admin')

@section('content')
<div class="container py-3">
    <div class="card">
        <div class="card-header">Edit Data item</div>
        <div class="card-body">
            <div class="row">
                <!-- Old Data -->
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header">Data Lama</h5>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label>Bank Name</label>
                                <input type="text" class="form-control" value="<?= $bank['name']; ?>" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label>Account Number</label>
                                <input type="text" class="form-control" value="<?= $bank['account_number']; ?>" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label>Image</label><br>
                                <?php if ($bank['image']) : ?>
                                    <img src="<?= base_url('uploads/banks/' . $bank['image']); ?>" alt="Bank Image" width="120">
                                <?php else : ?>
                                    <p><i>No image uploaded</i></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
        
                <!-- New Data (Edit Form) -->
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header">Data Baru</h5>
                        <div class="card-body">
                            <form action="<?= base_url('/admins/bank/update/' . $bank['id']); ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group mb-3">
                                    <label>Bank Name</label>
                                    <input type="text" name="name" class="form-control" value="<?= old('name', $bank['name']); ?>" placeholder="Enter bank name">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Account Number</label>
                                    <input type="text" name="account_number" class="form-control" value="<?= old('account_number', $bank['account_number']); ?>" placeholder="Enter account number">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Bank Image (Optional)</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                <a href="<?= base_url('/admins/bank'); ?>" class="btn btn-secondary btn-sm">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection