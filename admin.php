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

$pesan = ""; // Variabel untuk menyimpan pesan

// Memproses formulir jika ada data yang dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $gambar = $_POST['gambar'];
    $brand = $_POST['brand'];
    $type = $_POST['type'];
    $processor = $_POST['processor'];

    // Menyiapkan dan menjalankan query untuk menambahkan produk
    $query = "INSERT INTO produk (nama_produk, deskripsi, harga, gambar, brand, type, processor) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ssdssss", $nama_produk, $deskripsi, $harga, $gambar, $brand, $type, $processor);

    if ($stmt->execute()) {
        $pesan = "Produk berhasil ditambahkan!";
    } else {
        $pesan = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Sentral Komputer Sukabumi</title>
    <link rel="stylesheet" href="admin.css">
    <script>
        // JavaScript untuk menampilkan pop-up
        function showPopup(message) {
            if (message) {
                alert(message);
            }
        }
    </script>
</head>
<body onload="showPopup('<?php echo $pesan; ?>')"> <!-- Panggil fungsi saat halaman dimuat -->
    <header>
        <h1>Admin Panel - Tambah Produk</h1>
    </header>

    <main>
        <form action="admin.php" method="post">
            <label for="nama_produk">Nama Produk:</label>
            <input type="text" id="nama_produk" name="nama_produk" required>
            
            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" required></textarea>
            
            <label for="harga">Harga:</label>
            <input type="number" id="harga" name="harga" step="0.01" required>
            
            <label for="gambar">URL Gambar:</label>
            <input type="file" id="gambar" name="gambar" required>
            
            <label for="brand">Merek:</label>
            <select id="brand" name="brand" required>
                <option value="asus">Asus</option>
                <option value="lenovo">Lenovo</option>
                <option value="acer">Acer</option>
                <option value="msi">MSI</option>
                <option value="hp">HP</option>
                <option value="zyrex">Zyrex</option>
            </select>
            
            <label for="type">Jenis:</label>
            <select id="type" name="type" required>
                <option value="standar">Standar</option>
                <option value="gaming">Gaming</option>
            </select>

            <label for="processor">Processor:</label>
            <select id="processor" name="processor" required>
                <option value="intel">Intel</option>
                <option value="amd">AMD</option>
            </select>
            
            <button type="submit">Tambah Produk</button>
            <a href="hapus_produk.php">
                <br> 
            <button type="button">Hapus Produk</button>
        </a>
        </form>
    </main>
</body>
</html>
