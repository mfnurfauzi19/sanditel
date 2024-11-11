<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Scan Barcode'; ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/fontawesome.min.css'); ?>">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">Scan Barcode</h4>
            </div>
            <div class="card-body text-center">
                <input type="text" id="barcodeInput" class="form-control" placeholder="Tempatkan barcode di sini..." autofocus />
                
                <button id="scanButton" class="btn btn-primary mt-3">Scan</button>
                
                <button onclick="window.history.back();" class="btn btn-secondary mt-3">Kembali</button>
                
                <div id="scanResult" class="mt-3"></div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Menangkap input dari scanner
        let scannedBarcode = '';
        document.getElementById('barcodeInput').addEventListener('keydown', function (e) {
            if (e.key !== 'Enter') {
                scannedBarcode += e.key; // Tambahkan karakter ke scannedBarcode
            } else {
                // Kirim barcode saat 'Enter' ditekan
                console.log('Hasil Scan:', scannedBarcode);
                document.getElementById('scanResult').innerText = scannedBarcode;

                // AJAX untuk mengirim barcode ke server
                $.ajax({
                    url: '<?= base_url('barcode/process'); ?>',
                    type: 'POST',
                    data: { barcode: scannedBarcode },
                    success: function (response) {
                        const jsonResponse = JSON.parse(response); // Parse respons JSON
                        document.getElementById('scanResult').innerText = jsonResponse.message; // Tampilkan pesan
                    },
                    error: function (error) {
                        console.error('Error:', error);
                        document.getElementById('scanResult').innerText = 'Error: ' + error.statusText; // Tampilkan pesan error
                    }
                });

                scannedBarcode = ''; // Reset barcode setelah input
            }
        });

        // Fungsi untuk menangani klik tombol Scan
        document.getElementById('scanButton').addEventListener('click', function () {
            // Ambil input dari barcodeInput
            const barcode = document.getElementById('barcodeInput').value;
            if (barcode) {
                // Kirim barcode ke server saat tombol Scan ditekan
                $.ajax({
                    url: '<?= base_url('barcode/process'); ?>',
                    type: 'POST',
                    data: { barcode: barcode },
                    success: function (response) {
                        const jsonResponse = JSON.parse(response); // Parse respons JSON
                        document.getElementById('scanResult').innerText = jsonResponse.message; // Tampilkan pesan
                    },
                    error: function (error) {
                        console.error('Error:', error);
                        document.getElementById('scanResult').innerText = 'Error: ' + error.statusText; // Tampilkan pesan error
                    }
                });

                document.getElementById('barcodeInput').value = ''; // Kosongkan input setelah scan
            } else {
                alert('Silakan masukkan barcode sebelum menekan tombol Scan.');
            }
        });
    </script>
</body>
</html>
