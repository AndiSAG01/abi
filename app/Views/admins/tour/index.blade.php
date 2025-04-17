@extends('layouts.admin')

@section('content')
<div class="container py-2  ">
    <div class="card">
        <div class="card-header">
            <h3 style="font-family: Abril Fatface, serif;">Data Informasi Tour</h3>
        </div>
        <div class="card-body">
            <a href="/admins/tour/create" class="btn btn-primary btn-sm  mb-3">Tambah <i class="fas fa-plus fa-lg"></i></a>
            <div class="table-responsive">
                <table id="example" class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Deskripsi Tour</th>
                            <th>Nama Klasifikasi</th>
                            <th>Nama Kategori</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tours as $key => $item) : ?>
                            <tr>
                                <td class="text-center"><?= ++$key ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?= base_url('uploads/tours/' . $item['image']) ?>" width="60px" class="rounded me-2" alt="Tour Image">
                                        <div>
                                            <strong><?= esc($item['name']) ?></strong>
                                            <p class="mb-0 text-muted"><?= esc($item['location']) ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="p-2 rounded">
                                        <ul class="mb-0 ps-3">
                                            <?php foreach (explode(',', $item['classification_names']) as $classification) : ?>
                                                <li><?= esc(trim($classification)) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <div class="p-2 rounded">
                                        <ul class="mb-0 ps-3">
                                            <?php foreach (explode(',', $item['category_names']) as $category) : ?>
                                                <li><?= esc(trim($category)) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </td>

                                <td>
                                    <?php if ($item['status'] == 'aktif'): ?>
                                        <span class="badge bg-success rounded">
                                            <?= esc($item['status']) ?>
                                        </span>
                                    <?php else : ?>
                                        <span class="badge bg-danger rounded">
                                            <?= esc($item['status']) ?>
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <div class="d-flex">

                                        <a href="<?= base_url('admins/tour/show/' . $item['id']) ?>" class="btn btn-sm btn-info" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= base_url('admins/tour/edit/' . $item['id']) ?>" class="btn btn-sm btn-warning" style="margin:2px" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger btn-delete" data-id="<?= $item['id'] ?>" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".btn-delete").forEach(function(button) {
            button.addEventListener("click", function() {
                let categoryId = this.getAttribute("data-id");

                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data akan dihapus secara permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "<?= base_url('admins/tour/delete/') ?>" + categoryId;
                    }
                });
            });
        });
    });
</script>

@endsection