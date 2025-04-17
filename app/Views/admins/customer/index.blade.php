@extends('layouts.admin')

@section('content')
    <div class="container py-2  ">
        <div class="card">
            <div class="card-header">
                <h3 style="font-family: Abril Fatface, serif;">Data Pelanggan</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table">
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
                                <td><?php echo ++$key; ?></td>
                                <td>
                                    <img src="<?= base_url('/uploads/customers/' . $item->image) ?>" width="60px"
                                        class="rounded me-2" alt="Tour Image">
                                </td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->telphone }}</td>
                                <td class="text-center">
                                    <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $item->id }}">
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
   
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
            }
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
@endsection
