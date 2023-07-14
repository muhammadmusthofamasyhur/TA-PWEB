<!DOCTYPE html>
<html>
<head>
    <title>Katalog Buku Perpustakaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        h2 {
            text-align: center;
            padding: 20px;
            background-color: #f2f2f2;
            margin-top: 0;
        }

        nav {
            background-color: #333;
            overflow: hidden;
            margin-bottom: 20px;
        }

        nav a {
            float: left;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        form a {
            color: #333;
            text-decoration: none;
            margin-right: 10px;
        }

        input[type="text"] {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 8px 16px;
            border-radius: 4px;
            border: none;
            background-color: #717171;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #333;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #333;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        table td a {
            color: #333;
            text-decoration: none;
            margin-right: 10px;

            padding: 8px 16px;
            border-radius: 4px;
            border: none;
            background-color: #717171;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        table td a:hover {
            background-color: #333;
            color: white;
        }

        div a {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #333;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h2>Katalog Buku Perpustakaan</h2>

    <nav>
        <a href="layout.html">Beranda</a>
        <a href="katalog.php">Katalog Buku</a>
        <a href="peminjaman.php">Peminjaman & Pengembalian</a>
        <a href="tentangkami.html">Tentang Kami</a>
    </nav>
    <br>

    <?php
    
    include "koneksi.php";

    // Form pencarian
    echo "<form action='' method='get'>";
    echo "<div><a href='tambahdatabuku.php'>Tambah Data</a> Cari buku: <input type='text' name='search' placeholder='Judul Buku atau Penerbit'>";
    echo "<input type='submit' value='Cari'></div>";
    echo "</form>";
    echo "<br>";

    // Mendapatkan data buku
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $sql = "SELECT * FROM db_perpustakaan WHERE Judul LIKE '%$search%' OR Penerbit LIKE '%$search%'";
    } else {
        $sql = "SELECT * FROM db_perpustakaan";
    }

    // Mengambil data buku dari database
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Kode Buku</th><th>Judul</th><th>Pengarang</th><th>Penerbit</th><th>Tahun Terbit</th><th>Status Buku</th><th>Aksi</th>";

        while($data = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$data["Kode Buku"]."</td>";
            echo "<td>".$data["Judul"]."</td>";
            echo "<td>".$data["Pengarang"]."</td>";
            echo "<td>".$data["Penerbit"]."</td>";
            echo "<td>".$data["Tahun Terbit"]."</td>";
            echo "<td>".$data["Status Buku"]."</td>";
            echo "<td><a href='editdatabuku.php?kode_buku=".$data["Kode Buku"]."'>Edit</a><a href='hapusdatabuku.php?kode_buku=".$data["Kode Buku"]."'>Hapus</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada data buku.";
    }

    mysqli_close($conn);
    ?>
</body>
</html>
