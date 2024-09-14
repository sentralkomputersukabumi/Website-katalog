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

// Memproses penghapusan produk jika ada data yang dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];

    // Menyiapkan dan menjalankan query untuk menghapus produk
    $query = "DELETE FROM produk WHERE id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        $pesan = "Produk berhasil dihapus!";
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
    <title>Admin - Hapus Produk</title>
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
        <h1>Admin Panel - Hapus Produk</h1>
    </header>

    <main>
        <form action="hapus_produk.php" method="POST">
            <label for="product_id">Pilih Produk untuk Dihapus:</label>
            <select name="product_id" id="product_id" required>
                <option value="" disabled selected>Pilih Produk</option>
                <?php
                // Koneksi ke database
                $host = 'localhost';
                $user = 'root'; // Ganti dengan username database Anda
                $pass = ''; // Ganti dengan password database Anda
                $db = 'toko';

                $koneksi = new mysqli($host, $user, $pass, $db);

                if ($koneksi->connect_error) {
                    die("Koneksi gagal: " . $koneksi->connect_error);
                }

                // Mendapatkan daftar produk dari database
                $query = "SELECT id, nama_produk FROM produk";
                $result = $koneksi->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id'] . '">' . $row['nama_produk'] . '</option>';
                    }
                } else {
                    echo '<option value="" disabled>Tidak ada produk tersedia</option>';
                }

                $koneksi->close();
                ?>
            </select>

            <button type="submit">Hapus Produk</button>
            <a href="admin.php">
            <button type="button">Tambah Produk</button>
        </a>
        </form>
    </main>
</body>
</html>
