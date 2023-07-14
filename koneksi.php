<?php
    // Koneksi database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "perpustakaan";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn) {
        echo " ";
    }else{
        echo "Gagal Terkoneksi";
    }
?>