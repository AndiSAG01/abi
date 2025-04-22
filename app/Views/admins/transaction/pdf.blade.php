<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title_pdf }}</title>
    
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
            margin: 30px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .logo {
            width: 120px;
        }

        .title-container {
            flex-grow: 1;
            text-align: center;
            margin-top: -60px;
        }

        .title-container h1 {
            margin: 0;
        }

        .title-container p {
            font-size: 14px;
            margin: 4px 0 0;
            font-style: italic;
        }

        #table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        #table th,
        #table td {
            border: 1px solid #999;
            padding: 10px;
        }

        #table th {
            background-color: #4CAF50;
            color: white;
            text-align: center;
        }

        #table td ul {
            margin: 0;
            padding-left: 18px;
        }

        .btn-badge {
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 4px;
            border: none;
            color: white;
        }

        .btn-danger {
            background-color: #e74c3c;
        }

        .btn-info {
            background-color: #3498db;
        }

        .btn-success {
            background-color: #2ecc71;
        }

        .signature {
            width: 100%;
            margin-top: 50px;
            text-align: right;
        }

        .tour-info {
            display: flex;
            align-items: center;
        }

        .tour-info img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            margin-right: 10px;
        }

        .tour-info div {
            line-height: 1.2;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(FCPATH . 'assets/images/logo.jpg')) }}"
            class="logo" alt="Logo">
        <div class="title-container">
            <h1>Laporan Transaksi</h1>
            <p>Periode: {{ $start_date && $end_date ? "$start_date s.d. $end_date" : 'Semua Periode' }}</p>
        </div>
        <div style="width: 120px;"></div>
    </div>

    <table  id="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Destinasi</th>
                <th>Tanggal Berangkat</th>
                <th>Tanggal Kepulangan</th>
                <th>Jumlah Peserta</th>
                <th>Item</th>
                <th>Subtotal Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $key => $item)
                <tr>
                    <td class="text-center">{{ ++$key }}</td>
                    <td>
                        <div class="tour-info">
                            <div>
                                <strong>{{ $item['tour_name'] }}</strong><br>
                                <small>Lokasi: {{ $item['tour_location'] }}</small>
                            </div>
                        </div>
                    </td>
                    <td style="white-space: nowrap;" class="text-center">{{ $item['start_date'] }}</td>
                    <td style="white-space: nowrap;" class="text-center">{{ $item['end_date'] }}</td>
                    <td class="text-center">{{ $item['total_people'] }}</td>
                    <td style="white-space: nowrap;">
                        @php
                            $items = explode(',', $item['items_names']);
                            $qtys = explode(',', $item['qty']);
                        @endphp
                        <ul>
                            @foreach ($items as $index => $item_name)
                                <li>{{ $item_name }} - {{ $qtys[$index] ?? 0 }} pcs</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="text-right" style="white-space: nowrap;">Rp. {{ number_format($item['amount'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature">
        <p>Jambi, {{ $today }}</p>
        <br><br><br>
        <p>{{ $user_name }}</p>
    </div>
</body>

</html>
