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
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">Stock Opname</h4>
            </div>
            <div class="card-body text-center">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                <div class="row mb-3">
                    <div class="col-md-8">
                        <input type="text" id="barcodeInput" class="form-control" placeholder="Tempatkan barcode di sini..." autofocus />
                    </div>
                    <div class="col-md-2">
                        <button id="scanButton" class="btn btn-primary w-100">Scan Barcode</button>
                    </div>
                    <div class="col-md-2">
                        <label for="uploadQRCode" class="btn btn-info w-100">Unggah QR Code</label>
                        <input type="file" id="uploadQRCode" class="d-none" accept="image/*">
                    </div>
                </div>
                <button onclick="window.history.back();" class="btn btn-secondary mt-3">Kembali</button>

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
                                <th>Aksi</th>
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
    let scannedBarcode = '';  // Track temporary barcode input

    // Event listener to capture barcode input as you type
    document.getElementById('barcodeInput').addEventListener('keydown', function (e) {
        if (e.key !== 'Enter') {
            scannedBarcode += e.key;
        } else {
            scanBarcode();
        }
    });
    document.getElementById('uploadQRCode').addEventListener('change', function (e) {
        const file = e.target.files[0]; // Ambil file yang diunggah
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                const img = new Image();
                img.onload = function () {
                    // Membuat canvas untuk mengambil data gambar
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    canvas.width = img.width;
                    canvas.height = img.height;
                    ctx.drawImage(img, 0, 0, img.width, img.height);

                    // Ambil data gambar dari canvas
                    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);

                    // Menggunakan jsQR untuk memindai data QR dari imageData
                    const code = jsQR(imageData.data, canvas.width, canvas.height);
                    
                    if (code) {
                        // QR Code terdeteksi, masukkan ke dalam input barcode
                        document.getElementById('barcodeInput').value = code.data;
                        processScan(code.data);  // Panggil proses pemindaian setelah QR berhasil
                    } else {
                        alert("QR Code tidak terdeteksi.");
                    }
                };
                img.src = event.target.result; // Set source gambar untuk diproses
            };
            reader.readAsDataURL(file); // Baca file gambar sebagai Data URL
        }
    });

    // Handle the scan button click
    document.getElementById('scanButton').addEventListener('click', function () {
        scannedBarcode = '';  // Reset any scanned barcode
        scanBarcode();
    });

    // Process the scanned barcode or input value
    function scanBarcode() {
        const barcode = scannedBarcode || document.getElementById('barcodeInput').value;
        if (barcode) {
            processScan(barcode);
        } else {
            alert('Silakan masukkan barcode terlebih dahulu.');
        }
        scannedBarcode = '';  // Reset barcode after scanning
    }

    // Process scan by sending the barcode to the server via AJAX
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
                    // Update UI with asset data
                    updateAssetDetails(jsonResponse.asset);
                } else {
                    alert(jsonResponse.message);
                    resetForm();  // Reset form after failure
                }
            },
            error: function(error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memproses barcode.');
                resetForm();  // Reset form on error
            }
        });
    }
    

    // Update asset details in UI
    function updateAssetDetails(asset) {
        let assetInfo = `
            <tr>
                <td>${asset.nama_asset}</td>
                <td>${asset.merk_kode}</td>
                <td>
                    <select id="statusDropdown" class="form-control">
                        <option value="1" ${asset.status === '1' ? 'selected' : ''}>OK</option>
                        <option value="0" ${asset.status === '0' ? 'selected' : ''}>Rusak</option>
                    </select>
                </td>
                <td>${asset.qty}</td>
                <td>${asset.barcode}</td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="updateStatus('${asset.barcode}')">Update Status</button>
                </td>
            </tr>
        `;
        document.getElementById('assetDetails').innerHTML = assetInfo;
        document.getElementById('scanResult').style.display = 'block';
    }

    // Reset form to clear any inputs
    function resetForm() {
        document.getElementById('barcodeInput').value = '';  // Clear barcode input field
        document.getElementById('scanResult').style.display = 'none';  // Hide results
        document.getElementById('assetDetails').innerHTML = '';  // Clear asset details
    }

    // Update asset status
    function updateStatus(barcode) {
        const newStatus = document.getElementById('statusDropdown').value;
        const csrfName = '<?= $this->security->get_csrf_token_name(); ?>';
        const csrfHash = '<?= $this->security->get_csrf_hash(); ?>';

        $.ajax({
            url: '<?= base_url('barcode/update_status'); ?>',
            type: 'POST',
            data: {
                barcode: barcode,
                new_status: newStatus,
                [csrfName]: csrfHash
            },
            success: function(response) {
                const jsonResponse = JSON.parse(response);
                if (jsonResponse.status === 'success') {
                    alert('Status berhasil diperbarui.');
                } else {
                    alert('Gagal memperbarui status: ' + jsonResponse.message);
                }
            },
            error: function(error) {
                console.error('Error:', error);
                alert('Error: ' + error.statusText);
            }
        });
    }
</script>

</body>
</html>
