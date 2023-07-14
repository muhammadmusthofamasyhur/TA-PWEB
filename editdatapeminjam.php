<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan - Update Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 15px;
        }

        button[type="submit"],
        button[type="reset"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        button[type="reset"] {
            background-color: #f44336;
        }

        button[type="submit"]:hover,
        button[type="reset"]:hover {
            opacity: 0.8;
        }

        div.align-center {
            text-align: center;
        }

        h5 {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <?php
    include "koneksi.php";

    $kode_buku = $_GET['kode_buku'];
    $ambil_data = mysqli_query($conn, "SELECT * FROM db_perpustakaan WHERE `db_perpustakaan`.`Kode Buku` = '$kode_buku'");

    if (!$ambil_data) {
        die("Query error: " . mysqli_error($conn));
    }

    $data = mysqli_fetch_array($ambil_data);

    if (!$data) {
        die("Data not found");
    }
    ?>

    <form action="" method="POST">
        <div>
            <label for="kode_buku">Kode Buku</label>
            <input type="text" name="kode_buku" value="<?php echo $data['Kode Buku']; ?>" placeholder="Masukkan kode buku">
        </div>
        <div>
            <label for="judul">Judul</label>
            <input type="text" name="judul" value="<?php echo $data['Judul']; ?>" placeholder="Masukkan judul buku">
        </div>
        <div>
            <label for="pengarang">Pengarang</label>
            <input type="text" name="pengarang" value="<?php echo $data['Pengarang']; ?>" placeholder="Masukkan nama pengarang">
        </div>
        <div>
            <label for="penerbit">Penerbit</label>
            <input type="text" name="penerbit" value="<?php echo $data['Penerbit']; ?>" placeholder="Masukkan nama penerbit">
        </div>
        <div>
            <label for="tahun_terbit">Tahun Terbit</label>
            <input type="text" name="tahun_terbit" value="<?php echo $data['Tahun Terbit']; ?>" placeholder="Masukkan tahun terbit">
        </div>
        <div>
            <label for="status_buku">Status Buku</label>
            <select name="status_buku" id="status_buku">
                <option value="Tersedia" <?php if ($data['Status Buku'] == 'Tersedia') echo 'selected'; ?>>Tersedia</option>
                <option value="Dipinjam" <?php if ($data['Status Buku'] == 'Dipinjam') echo 'selected'; ?>>Dipinjam</option>
            </select>
        </div>
        <div>
            <label for="peminjam">Peminjam</label>
            <input type="text" name="peminjam" value="<?php echo $data['Peminjam']; ?>" placeholder="Masukkan nama peminjam">
        </div>
        <div>
            <label for="tanggal_pinjam">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" value="<?php echo $data['Tanggal Pinjam']; ?>" placeholder="Masukkan tanggal pinjam">
        </div>
        <div>
            <label for="batas_pinjam">Batas Pinjam</label>
            <input type="date" name="batas_pinjam" value="<?php echo $data['Batas Pinjam']; ?>" placeholder="Masukkan tanggal batas pinjam">
        </div>
        <div>
            <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
            <input type="date" name="tanggal_pengembalian" value="<?php echo $data['Tanggal Pengembalian']; ?>" placeholder="Masukkan tanggal pengembalian">
        </div>

        <div class="align-center">
            <button type="submit" name="simpan">UPDATE</button>
            <button type="reset">BATAL</button>
        </div>
    </form>

    <?php
    if (isset($_POST['simpan'])) 
    {
        $kode_buku   = $_POST['kode_buku'];
        $judul       = $_POST['judul'];
        $pengarang   = $_POST['pengarang'];
        $penerbit    = $_POST['penerbit'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $status_buku = $_POST['status_buku'];
        $peminjam = $_POST['peminjam'];
        $tanggal_pinjam = $_POST['tanggal_pinjam'];
        $batas_pinjam = $_POST['batas_pinjam'];
        $tanggal_pengembalian = $_POST['tanggal_pengembalian'];

        $update = "UPDATE db_perpustakaan SET judul='$judul', pengarang='$pengarang', penerbit='$penerbit', `Tahun Terbit`='$tahun_terbit', `Status Buku`='$status_buku', `Peminjam`='$peminjam', `Tanggal Pinjam`='$tanggal_pinjam', `Batas Pinjam`='$batas_pinjam', `Tanggal Pengembalian`='$tanggal_pengembalian' WHERE `Kode Buku`='$kode_buku'";
        mysqli_query($conn, $update) or die(mysqli_error($conn));

        echo "<div align='center'><h5> Data berhasil diperbarui.</h5></div>";

        echo "<meta http-equiv='refresh' content='1;url=http://localhost/perpustakaan/peminjaman.php'>";
    }
    ?>
</body>
</html>
