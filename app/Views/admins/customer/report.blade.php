@extends('layouts.admin')

@section('content')
    <div class="container py-2  ">
        <div class="card">
            <div class="card-header">
                <h3 style="font-family: Abril Fatface, serif;">Laporan Data Pelanggan</h3>
            </div>
            <div class="card-body">
                <a href="{{  site_url('laporan/customer/pdf') }}" class="btn btn-danger text-white">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>            
                <div class="table-responsive">
                    <table id="example" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No.Telphone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($customer as $key => $item) : ?>

                            <tr>
                                <td><?php echo ++$key; ?></td>
                                <td><?php echo $item->username; ?></td>
                                <td><?php echo $item->email ?></td>
                                <td><?php echo $item->telphone ?></td>
                            </tr>

                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
