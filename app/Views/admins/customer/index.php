<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="container py-2  ">
    <div class="card">
        <div class="card-header">
            <h3 style="font-family: Abril Fatface, serif;">Data Pelanggan</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto Profil</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No.Telphone</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customer as $key => $item) : ?>

                            <tr>
                                <td><?php echo ++$key ?></td>
                                <td>
                                <img src="<?= base_url('/uploads/customers/' . $item['image']) ?>" width="60px" class="rounded me-2" alt="Tour Image">
                                </td>
                                <td><?php echo $item['name'] ?></td>
                                <td><?php echo $item['email'] ?></td>
                                <td><?php echo $item['telphone'] ?></td>
                                <td class="text-center">
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
</div>
<?= $this->endsection() ?>