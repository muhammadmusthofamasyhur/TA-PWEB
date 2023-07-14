<!DOCTYPE html>
<html>
<head>
    <title>Peminjaman & Pengembalian</title>
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
    </style>
</head>
<body>
    <h2>Daftar Peminjaman & Pengembalian Buku</h2>

    <nav>
        <a href="layout.html">Beranda</a>
        <a href="katalog.php">Katalog Buku</a>
        <a href="peminjaman.php">Peminjaman & Pengembalian</a>
        <a href="tentangkami.html">Tentang Kami</a>
    </nav>
    <br>

    <?php
    // Koneksi ke database
    include "koneksi.php";

    // Mendapatkan data buku yang sedang dipinjam
    $sql = "SELECT * FROM db_perpustakaan WHERE `Status Buku` = 'dipinjam'";

    // Pencarian berdasarkan judul buku atau peminjam
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $sql .= " AND (Judul LIKE '%$search%' OR Peminjam LIKE '%$search%')";
    }

    // Form pencarian
    echo "<form action='' method='get'>";
    echo "Cari buku: <input type='text' name='search' placeholder='Judul Buku atau Peminjam'>";
    echo "<input type='submit' value='Cari'>";
    echo "</form>";
    echo "<br>";

    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        // Menampilkan data buku yang sedang dipinjam
        echo "<table>";
        echo "<tr><th>Kode Buku</th><th>Judul</th><th>Status Buku</th><th>Peminjam</th><th>Tanggal Pinjam</th><th>Batas Pinjam</th><th>Tanggal Pengembalian</th><th>Status</th><th>Aksi</th></tr>";

        while ($data = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $data["Kode Buku"] . "</td>";
            echo "<td>" . $data["Judul"] . "</td>";
            echo "<td>" . $data["Status Buku"] . "</td>";
            echo "<td>" . $data["Peminjam"] . "</td>";
            echo "<td>" . $data["Tanggal Pinjam"] . "</td>";
            echo "<td>" . $data["Batas Pinjam"] . "</td>";
            echo "<td>" . $data["Tanggal Pengembalian"] . "</td>";

            // Mendapatkan tanggal hari ini
            $today = date("Y-m-d");

           
            // Membandingkan tanggal pengembalian dengan tanggal batas
            if ($data["Tanggal Pengembalian"] > $data["Batas Pinjam"]) {
                echo "<td>Terlambat</td>";
            } elseif ($data["Tanggal Pengembalian"] = " " ) {
                echo "<td>Masih dalam Peminjaman</td>";
            } else {
                echo "<td>Tepat waktu</td>";
            }
            echo "<td><a href='editdatapeminjam.php?kode_buku=" . $data["Kode Buku"] . "'>Edit</a></td>";

            echo "</tr>";

    
        }
        echo "</table>";
    } else {
        echo "Tidak ada buku yang sedang dipinjam.";
    }

    // Menutup koneksi ke database
    mysqli_close($conn);
    ?>
</body>
</html>
