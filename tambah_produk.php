<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    
    // Upload gambar
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

    // Simpan ke database
    $sql = "INSERT INTO produk (nama_produk, deskripsi, harga, gambar) 
            VALUES ('$nama_produk', '$deskripsi', '$harga', '$target_file')";
    
    if ($koneksi->query($sql) === TRUE) {
        echo "Produk berhasil ditambahkan!";
        header("Location: admin.php");
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}
?>
