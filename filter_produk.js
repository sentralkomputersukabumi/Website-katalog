function filterProducts() {
    // Ambil nilai dari select brand
    const selectedBrand = document.getElementById('product-brand').value;

    // Ambil semua elemen produk
    const products = document.querySelectorAll('.product');

    // Loop melalui semua produk
    products.forEach(product => {
        // Dapatkan nilai data-brand dari produk
        const productBrand = product.getAttribute('data-brand');

        // Jika selectedBrand adalah 'all', tampilkan semua produk, jika tidak hanya tampilkan yang sesuai
        if (selectedBrand === 'all' || productBrand === selectedBrand) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
}

