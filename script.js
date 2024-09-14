function filterProducts() {
    var selectedBrand = document.getElementById('product-brand').value;
    var products = document.querySelectorAll('.product');
    
    products.forEach(function(product) {
        var productBrand = product.getAttribute('data-brand');
        
        if (selectedBrand === 'all' || productBrand === selectedBrand) {
            product.style.display = 'block';  // Tampilkan produk yang sesuai
        } else {
            product.style.display = 'none';  // Sembunyikan produk yang tidak sesuai
        }
    });
}




function sendWhatsAppMessage(productName, productPrice) {
    const phoneNumber = '6281234567890'; // Ganti dengan nomor WhatsApp Anda
    const message = `Halo, saya ingin membeli ${productName} seharga Rp ${productPrice}`;
    const encodedMessage = encodeURIComponent(message);
    const waLink = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;
    window.open(waLink, '_blank');
}
