<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Scan Barcode & QR Code'; ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/fontawesome.min.css'); ?>">
    <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">Scan Barcode & QR Code</h4>
            </div>
            <div class="card-body text-center">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                <!-- Row untuk tombol Scan dan Upload QR -->
                <div class="row mb-3">
                    <!-- Input untuk Barcode manual -->
                    <div class="col-md-8">
                        <input type="text" id="barcodeInput" class="form-control" placeholder="Tempatkan barcode di sini..." autofocus />
                    </div>
                    <!-- Tombol Scan untuk Barcode -->
                    <div class="col-md-2">
                        <button id="scanButton" class="btn btn-primary w-100">Scan Barcode</button>
                    </div>
                    <!-- Tombol Upload QR di samping tombol Scan -->
                    <div class="col-md-2">
                        <label for="uploadQRCode" class="btn btn-info w-100">Unggah QR Code</label>
                        <input type="file" id="uploadQRCode" class="d-none" accept="image/*">
                    </div>
                </div>
                <button onclick="window.history.back();" class="btn btn-secondary mt-3">Kembali</button>
                
                <!-- Kotak Hasil Scan -->
                <div id="scanResult" class="mt-3 p-4 border rounded bg-light" style="display:none;">
                    <h5>Hasil Scan:</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Aset</th>
                                <th>Merk</th>
                                <th>Status</th>
                                <th>Qty</th>
                                <th>Barcode</th>
                            </tr>
                        </thead>
                        <tbody id="assetDetails">
                            <!-- Data akan dimasukkan di sini melalui AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi untuk menangani input dari scanner atau manual input
        let scannedBarcode = '';

        // Event untuk input manual
        document.getElementById('barcodeInput').addEventListener('keydown', function (e) {
            if (e.key !== 'Enter') {
                scannedBarcode += e.key; // Tambahkan karakter ke scannedBarcode
            } else {
                scanBarcode(); // Proses barcode setelah tekan Enter
            }
        });

        // Fungsi untuk menangani klik tombol Scan
        document.getElementById('scanButton').addEventListener('click', function () {
            scannedBarcode = ''; // Reset barcode
            scanBarcode(); // Jalankan scan barcode
        });

        // Fungsi untuk memproses barcode
        function scanBarcode() {
            const barcode = scannedBarcode || document.getElementById('barcodeInput').value;
            if (barcode) {
                processScan(barcode);
            } else {
                alert('Silakan masukkan barcode terlebih dahulu.');
            }
            scannedBarcode = ''; // Reset barcode setelah input
        }

        function processScan(barcode) {
            const csrfName = '<?= $this->security->get_csrf_token_name(); ?>';
            const csrfHash = '<?= $this->security->get_csrf_hash(); ?>';

            $.ajax({
                url: '<?= base_url('barcode/process'); ?>',
                type: 'POST',
                data: {
                    barcode: barcode,
                    [csrfName]: csrfHash
                },
                success: function(response) {
                    const jsonResponse = JSON.parse(response);
                    if (jsonResponse.status === 'success') {
                        let assetInfo = `
                            <tr>
                                <td>${jsonResponse.asset.nama_asset}</td>
                                <td>${jsonResponse.asset.merk_kode}</td>
                                <td>${jsonResponse.asset.status}</td>
                                <td>${jsonResponse.asset.qty}</td>
                                <td>${jsonResponse.asset.barcode}</td>
                            </tr>
                        `;
                        document.getElementById('assetDetails').innerHTML = assetInfo;
                        document.getElementById('scanResult').style.display = 'block';
                    } else {
                        document.getElementById('scanResult').innerText = jsonResponse.message;
                        document.getElementById('scanResult').style.display = 'block';
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                    document.getElementById('scanResult').innerText = 'Error: ' + error.statusText;
                    document.getElementById('scanResult').style.display = 'block';
                }
            });
        }

        // Fungsi untuk membaca QR Code dari file gambar
        document.getElementById('uploadQRCode').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    const img = new Image();
                    img.onload = function () {
                        const canvas = document.createElement('canvas');
                        const ctx = canvas.getContext('2d');
                        canvas.width = img.width;
                        canvas.height = img.height;
                        ctx.drawImage(img, 0, 0, img.width, img.height);

                        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                        const code = jsQR(imageData.data, canvas.width, canvas.height);

                        if (code) {
                            document.getElementById('barcodeInput').value = code.data;
                            processScan(code.data); // Kirim hasil scan ke server
                        } else {
                            alert("QR Code tidak terdeteksi.");
                        }
                    };
                    img.src = event.target.result;
                };
                reader.readAsDataURL(file); // Membaca file gambar sebagai data URL
            }
        });
    </script>
</body>
</html>
