<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan - Daftar Buku</title>
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
    <form action="" method="POST">
        <div>
            <label for="kode_buku">Kode Buku</label>
            <input type="text" name="kode_buku" placeholder="Masukkan kode buku">
        </div>
        <div>
            <label for="judul">Judul</label>
            <input type="text" name="judul" placeholder="Masukkan judul buku">
        </div>
        <div>
            <label for="pengarang">Pengarang</label>
            <input type="text" name="pengarang" placeholder="Masukkan nama pengarang">
        </div>
        <div>
            <label for="penerbit">Penerbit</label>
            <input type="text" name="penerbit" placeholder="Masukkan nama penerbit">
        </div>
        <div>
            <label for="tahun_terbit">Tahun Terbit</label>
            <input type="text" name="tahun_terbit" placeholder="Masukkan tahun terbit">
        </div>
        <div>
            <label for="status_buku">Status Buku</label>
            <select name="status_buku" id="status_buku">
                <option value="Tersedia">Tersedia</option>
                <option value="Dipinjam">Dipinjam</option>
            </select>
        </div><br>

        <div>
            <label for="peminjam">Peminjam</label>
            <input type="text" name="peminjam" placeholder="Masukkan nama peminjam">
        </div>
        <div>
            <label for="tanggal_pinjam">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" placeholder="Masukkan tanggal pinjam">
        </div><br>
        <div>
            <label for="batas_pinjam">Batas Pinjam</label>
            <input type="date" name="batas_pinjam" placeholder="Masukkan tanggal batas pinjam">
        </div><br>
        <div>
            <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
            <input type="date" name="tanggal_pengembalian" placeholder="Masukkan tanggal pengembalian">
        </div>

        <br>

        <div class="align-center">
            <button type="submit" name="simpan">SIMPAN</button>
            <button type="reset">BATAL</button> 
        </div>
    </form>

    <?php
    include "koneksi.php";

    if (isset($_POST['simpan'])) 
    {
        $kode_buku   = $_POST['kode_buku'];
        $judul   = $_POST['judul'];
        $pengarang   = $_POST['pengarang'];
        $penerbit   = $_POST['penerbit'];
        $tahun_terbit   = $_POST['tahun_terbit'];
        $status_buku   = $_POST['status_buku'];
        $peminjam   = $_POST['peminjam'];
        $tanggal_pinjam = $_POST['tanggal_pinjam'];
        $batas_pinjam   = $_POST['batas_pinjam'];
        $tanggal_pengembalian   = $_POST['tanggal_pengembalian'];   

        // Perhatikan penggunaan variabel dalam query dan penambahan tanda kutip
        $insert = "INSERT INTO db_perpustakaan VALUES('$kode_buku', '$judul','$pengarang', '$penerbit', '$tahun_terbit', '$status_buku', '$peminjam', '$tanggal_pinjam', '$batas_pinjam', '$tanggal_pengembalian')"; 
        mysqli_query($conn, $insert) or die(mysqli_error($conn));

        echo "<div class='align-center'><h5> Silahkan Tunggu, Data sedang Disimpan</h5></div>";

        echo "<meta http-equiv='refresh' content='1;url=http://localhost/perpustakaan/katalog.php'>";
    }
    ?>

</body>
</html>
