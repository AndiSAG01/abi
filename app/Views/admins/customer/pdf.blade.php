<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title_pdf ?></title>
    <style>
        #table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td, #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .logo {
            width: 100px;
        }

        .title {
            text-align: center;
            flex-grow: 1;
        }

        .signature {
            width: 100%;
            margin-top: 50px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="data:image/png;base64,<?= base64_encode(file_get_contents(FCPATH . 'assets/images/logo.jpg')) ?>" alt="Logo" class="logo">
        <div class="title" style="margin-top: -80px">
            <h1>Laporan Pelanggan</h1>
        </div>
        <div style="width: 100px;"></div> <!-- spacer agar logo & title rata -->
    </div>

    <table id="table">
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
                    <td><?= ++$key; ?></td>
                    <td><?= $item['name']; ?></td>
                    <td><?= $item['email']; ?></td>
                    <td><?= $item['telphone']; ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <div class="signature">
        <p>Jambi, <?= $today ?></p>
        <br><br><br>
        <p><?= $user_name ?></p>
    </div>
</body>

</html>
