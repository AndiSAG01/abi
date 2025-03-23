<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Default Title' ?></title>
</head>
<body>

    <header>
        <h1>Website Header</h1>
<?= view('sidebar'); ?>
    </header>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <footer>
        <p>Website Footer</p>
    </footer>

</body>
</html>
