<?php
$host = 'localhost';
$user = 'root'; // Ganti dengan username database Anda
$pass = ''; // Ganti dengan password database Anda
$db = 'toko';

// Membuat koneksi ke database
$koneksi = new mysqli($host, $user, $pass, $db);

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Menyiapkan dan menjalankan query untuk mendapatkan data produk
$query = "SELECT * FROM produk"; // Pastikan nama tabel sesuai dengan database Anda
$result = $koneksi->query($query);

// Menutup koneksi setelah query
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sentral Komputer Sukabumi</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="hero-banner">
            <h1>SELAMAT DATANG DI KATALOG SENTRAL KOMPUTER SUKABUMI!</h1>
            <p>Layanan Service Terpercaya untuk Semua Jenis Laptop</p>
            <a href="#shop" class="btn">Belanja Sekarang</a>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="#service">Layanan</a></li>
            <li><a href="#about">Tentang Kami</a></li>
            <li><a href="https://api.whatsapp.com/send/?phone=%2B6281977774055&text&type=phone_number&app_absent=0">Hubungi Kami</a></li>
        </ul>
    </nav>

    <!-- Select Product Section -->
    <section id="shop">
        <div class="filter-container">
            <h2>Pilih Produk</h2>
            <select id="product-brand" onchange="filterProducts()">
                <option value="all">Semua Merek</option>
                <option value="acer">Acer</option>
                <option value="lenovo">Lenovo</option>
                <option value="asus">Asus</option>
                <option value="msi">MSI</option>
                <option value="zyrex">Zyrex</option>
            </select>
        </div>
    </section>

    <h2>Daftar Produk</h2>
    <div class="product-list">
    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $productName = $row['nama_produk'];
            $productPrice = number_format($row['harga'], 2, ',', '.');
            echo '<div class="product" data-brand="' . strtolower($row['brand']) . '">';
            echo '<img src="img/' . $row['gambar'] . '" alt="' . $productName . '">';
            echo '<h2>' . $productName . '</h2>';
            echo '<p>' . $row['deskripsi'] . '</p>';
            echo '<p>Rp ' . $productPrice . '</p>';
            // Tombol beli sekarang dengan fungsi sendWhatsAppMessage
            echo '<button onclick="sendWhatsAppMessage(\'' . $productName . '\', \'' . $productPrice . '\')">Beli Sekarang</button>';
            echo '</div>';
        }
    } else {
        echo '<p class="no-products">Tidak ada produk yang tersedia.</p>';
    }
    ?>
</div>


    <footer>
        <p>&copy; 2024 Sentral Komputer Sukabumi</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>
