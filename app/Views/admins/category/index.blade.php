@extends('layouts.admin')

@section('content')
<div class="container py-2  ">
    <div class="card">
        <div class="card-header"><h3 style="font-family: Abril Fatface, serif;">Data Kategori</h3></div>
        <div class="card-body">
            @include('admins.category.create')
            <div class="table-responsive">
                <table id="example" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $key => $item) : ?>

                            <tr>
                                <td><?php echo ++$key ?></td>
                                <td><?php echo $item['name'] ?></td>
                                <td class="text-center">
                                    <a href="<?php echo base_url('admins/kategori/edit/' . $item['id']) ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-danger btn-sm btn-delete" data-id="<?= $item['id'] ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>

                        <?php endforeach ?>

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
                        window.location.href = "<?= base_url('admins/kategori/delete/') ?>" + categoryId;
                    }
                });
            });
        });
    });
</script>

@endsection