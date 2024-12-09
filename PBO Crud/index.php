<?php
include_once 'Barand.php';
include_once 'Pelanggan.php';

$barand = new Barand();
$pelanggan = new Pelanggan();

$barand_data = $barand->read();
$pelanggan_data = $pelanggan->read();

// Proses untuk menghapus data barand
if (isset($_GET['delete_barand'])) {
    $barand->delete($_GET['delete_barand']);
    header("Location: index.php"); // Refresh halaman setelah menghapus data
    exit;
}

// Proses untuk menghapus data pelanggan
if (isset($_GET['delete_pelanggan'])) {
    $pelanggan->delete($_GET['delete_pelanggan']);
    header("Location: index.php"); // Refresh halaman setelah menghapus data
    exit;
}

// Proses untuk mengedit data barand
if (isset($_POST['edit_barand'])) {
    $barand->update($_POST['id'], $_POST['nama'], $_POST['harga'], $_POST['stok']);
    header("Location: index.php"); // Refresh halaman setelah mengedit data
    exit;
}

// Proses untuk mengedit data pelanggan
if (isset($_POST['edit_pelanggan'])) {
    $pelanggan->update($_POST['id'], $_POST['nama'], $_POST['email'], $_POST['telepon'], $_POST['alamat']);
    header("Location: index.php"); // Refresh halaman setelah mengedit data
    exit;
}

// Proses untuk menambah data barand
if (isset($_POST['add_barand'])) {
    $barand->create($_POST['nama'], $_POST['harga'], $_POST['stok']);
    header("Location: index.php"); // Refresh halaman setelah menambah data
    exit;
}

// Proses untuk menambah data pelanggan
if (isset($_POST['add_pelanggan'])) {
    $pelanggan->create($_POST['nama'], $_POST['email'], $_POST['telepon'], $_POST['alamat']);
    header("Location: index.php"); // Refresh halaman setelah menambah data
    exit;
}

// Form untuk mengedit data barand
$edit_barand = null;
if (isset($_GET['edit_barand'])) {
    $edit_barand = $barand->find($_GET['edit_barand']);
}

// Form untuk mengedit data pelanggan
$edit_pelanggan = null;
if (isset($_GET['edit_pelanggan'])) {
    $edit_pelanggan = $pelanggan->find($_GET['edit_pelanggan']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP dengan JSON</title>
    <style>

        * { 
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 30px;
            outline : none;
        }

        h1, h2, h3 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            text-decoration: none;
            color: #4CAF50;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <h1>CRUD PHP dengan PBO BY FAREL NUR AKBAR</h1>

    <h2>Data Barand</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($barand_data as $item): ?>
            <tr>
                <td><?= $item['id']; ?></td>
                <td><?= $item['nama']; ?></td>
                <td><?= $item['harga']; ?></td>
                <td><?= $item['stok']; ?></td>
                <td>
                    <a href="?edit_barand=<?= $item['id']; ?>">Edit</a>
                    <a href="?delete_barand=<?= $item['id']; ?>" onclick="return confirm('Are you sure?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Tambah Barand</h3>
    <form method="POST" action="">
        <label>Nama Barang: <input type="text" name="nama" required></label>
        <label>Harga: <input type="number" name="harga" required></label>
        <label>Stok: <input type="number" name="stok" required></label>
        <input type="submit" name="add_barand" value="Tambah">
    </form>

    <?php if ($edit_barand): ?>
        <h3>Edit Barand</h3>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= $edit_barand['id']; ?>">
            <label>Nama: <input type="text" name="nama" value="<?= $edit_barand['nama']; ?>" required></label>
            <label>Harga: <input type="number" name="harga" value="<?= $edit_barand['harga']; ?>" required></label>
 <label>Stok: <input type="number" name="stok" value="<?= $edit_barand['stok']; ?>" required></label>
            <input type="submit" name="edit_barand" value="Simpan">
        </form>
    <?php endif; ?>

    <h2>Data Pelanggan</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($pelanggan_data as $item): ?>
            <tr>
                <td><?= $item['id']; ?></td>
                <td><?= $item['nama']; ?></td>
                <td><?= $item['email']; ?></td>
                <td><?= $item['telepon']; ?></td>
                <td><?= $item['alamat']; ?></td>
                <td>
                    <a href="?edit_pelanggan=<?= $item['id']; ?>">Edit</a>
                    <a href="?delete_pelanggan=<?= $item['id']; ?>" onclick="return confirm('Are you sure?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Tambah Pelanggan</h3>
    <form method="POST" action="">
        <label>Nama: <input type="text" name="nama" required></label>
        <label>Email: <input type="email" name="email" required></label>
        <label>Telepon: <input type="text" name="telepon" required></label>
        <label>Alamat: <input type="text" name="alamat" required></label>
        <input type="submit" name="add_pelanggan" value="Tambah">
    </form>

    <?php if ($edit_pelanggan): ?>
        <h3>Edit Pelanggan</h3>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= $edit_pelanggan['id']; ?>">
            <label>Nama: <input type="text" name="nama" value="<?= $edit_pelanggan['nama']; ?>" required></label>
            <label>Email: <input type="email" name="email" value="<?= $edit_pelanggan['email']; ?>" required></label>
            <label>Telepon: <input type="text" name="telepon" value="<?= $edit_pelanggan['telepon']; ?>" required></label>
            <label>Alamat: <input type="text" name="alamat" value="<?= $edit_pelanggan['alamat']; ?>" required></label>
            <input type="submit" name="edit_pelanggan" value="Simpan">
        </form>
    <?php endif; ?>
</body>
</html>