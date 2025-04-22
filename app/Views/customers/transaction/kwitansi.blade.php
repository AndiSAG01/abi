<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $title_pdf ?></title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            margin: 40px;
        }

        .header,
        .footer {
            width: 100%;
        }

        .logo {
            float: left;
        }

        .company-info {
            float: right;
            text-align: right;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        h2 {
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        th {
            background-color: #e8f4fd;
        }

        .no-border td {
            border: none;
            padding: 5px 8px;
        }

        .total-box {
            background-color: #f3f3f3;
            font-weight: bold;
        }

        .paid {
            color: red;
            font-weight: bold;
            font-size: 24px;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="clearfix header">
        <div class="logo">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(FCPATH . 'assets/images/logo.jpg')) }}"
                width="150px">
        </div>
        <div class="company-info">
            <h2>Invoice</h2>
            <p><strong>Kerinci Smart Tourism</strong><br>
                Kerincismart.tourism@gmail.com</p>
        </div>
    </div>

    <hr>

    <table class="no-border">
        <tr>
            <td><strong>DIBERIKAN KEPADA</strong><br><?= esc($customer['username']) ?></td>
            <td style="text-align: right;">
                <strong>Invoice #</strong> <?= esc($transaction_code) ?><br>
                <strong>Tanggal</strong> <?= date('d M Y', strtotime($transaction['created_at'])) ?>
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>Barang</th>
                <th>Kuantitas</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php 
        $total = 0;
        foreach ($tours as $tour): 
            $subtotal = $tour['price'] * $tour['quantity'];
            $total += $subtotal;
        ?>
            <tr>
                <td>
                    <?= esc($tour['name']) ?><br>
                    <small>Check in <?= date('d F Y', strtotime($transaction['start_date'] ?? '')) ?></small><br>
                    <small>Check out <?= date('d F Y', strtotime($transaction['end_date'] ?? '')) ?></small>
                </td>
                <td><?= $tour['quantity'] ?></td>
                <td>Rp<?= number_format($tour['price'], 0, ',', '.') ?></td>
                <td>Rp<?= number_format($transaction['amount'], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <table class="no-border" style="margin-top: 10px;">
        <tr>
            <td style="text-align: right;">Subtotal</td>
            <td style="text-align: right; width: 200px;">Rp<?= number_format($transaction['amount'], 0, ',', '.') ?></td>
        </tr>
        <tr>
            <td style="text-align: right;">Total</td>
            <td style="text-align: right;">Rp<?= number_format($transaction['amount'], 0, ',', '.') ?></td>
        </tr>
        <tr>
            <td style="text-align: right;">Lunas pada <?= date('d M Y', strtotime($payment['payment_date'])) ?></td>
            <td style="text-align: right;">Rp<?= number_format($transaction['amount'], 0, ',', '.') ?></td>
        </tr>
        <tr class="total-box">
            <td style="text-align: right;">Jumlah yang Harus Dibayar</td>
            <td style="text-align: right; color: green;">
                Rp<?= number_format( $transaction['amount'], 0, ',', '.') ?></td>
        </tr>
    </table>

    <p class="paid">Lunas</p>

</body>

</html>
