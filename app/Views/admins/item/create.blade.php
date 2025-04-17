<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#myModal">
    Tambah <i class="fas fa-plus fa-lg"></i>
</button>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-info">
                <h4 class="modal-title">Data Baru
                    <p>
                        <small>Sebelum menyimpan, pastikan data sudah isi dengan lengkap dan <span class="text-success">Benar</span> agar tidak terjadi informasi yang <span class="text-danger">Salah.</span></small>
                    </p>
                </h4>
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal"></button>
            </div>


            <!-- Modal body -->
            <div class="modal-body">
                <form action="<?php echo base_url('/admins/item/store') ?>" method="POST">
                    <div class="form-group">
                        <label>Nama item</label>
                        <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Item">
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" class="form-control" name="price" placeholder="Masukkan Harga">
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" class="form-control" name="stock" placeholder="Masukkan Jumlah Stok">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">SIMPAN</button>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>