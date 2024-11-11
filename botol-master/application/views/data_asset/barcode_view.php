<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Generator</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <style>
        .barcode-container {
            margin-top: 20px;
        }

        .barcode-container img {
            max-width: 100%; /* Membuat barcode responsif */
            width: 200px;   /* Menetapkan lebar barcode */
            height: auto;
        }

        .button-container {
            margin-top: 20px;
        }

        .button-container a,
        .button-container button {
            padding: 10px 20px;
        }

        .barcode-text {
            font-size: 16px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="container mt-5 text-center">
        <!-- Tombol untuk menampilkan barcode -->
        <button class="btn btn-primary" data-toggle="modal" data-target="#barcodeModal" data-barcode="1">GATE Barcode</button>

        <!-- Modal untuk menampilkan barcode -->
        <div class="modal fade" id="barcodeModal" tabindex="-1" role="dialog" aria-labelledby="barcodeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="barcodeModalLabel">Barcode</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="barcodeContainer">
                        <div id="barcodeDisplay"></div>
                        <button id="generateBarcodeButton" class="btn btn-primary">Generate Barcode</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pastikan Anda sudah mengimpor jQuery dan Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
       $(document).ready(function() {
        // Ketika tombol untuk melihat barcode diklik
        $('button[data-toggle="modal"]').on('click', function() {
            var assetId = $(this).data('barcode');  // Ambil ID asset yang diklik

            // Periksa apakah barcode sudah ada di localStorage
            if (localStorage.getItem('barcode_generated_' + assetId) === 'true') {
                var barcodeUrl = localStorage.getItem('barcode_text_' + assetId);
                $('#barcodeDisplay').html('<img src="' + barcodeUrl + '" alt="Barcode" class="barcode">');
                $('#generateBarcodeButton').prop('disabled', true).text('Barcode Sudah Digenerate');
            } else {
                $('#barcodeDisplay').html('');
                $('#generateBarcodeButton').prop('disabled', false).text('Generate Barcode');
            }

            $('#generateBarcodeButton').data('barcode', assetId); // Simpan assetId
        });

        // Ketika tombol "Generate Barcode" diklik
        $('#generateBarcodeButton').on('click', function() {
            var assetId = $(this).data('barcode');  // Ambil assetId yang disimpan sebelumnya

            // Proses generate barcode di JavaScript (bukan di controller)
            var barcodeText = 'barcode_' + assetId + '_' + Math.floor(Math.random() * 10000000000);  // Menghasilkan barcode unik
            var barcodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' + barcodeText + '&size=150x150';  // Menggunakan API untuk menghasilkan barcode

            // Menampilkan barcode di dalam modal
            $('#barcodeDisplay').html('<img src="' + barcodeUrl + '" alt="Barcode" class="barcode">');

            // Menyimpan status dan barcode di localStorage
            localStorage.setItem('barcode_generated_' + assetId, 'true');
            localStorage.setItem('barcode_text_' + assetId, barcodeUrl);

            // Menonaktifkan tombol dan mengganti teks
            $('#generateBarcodeButton').prop('disabled', true).text('Barcode Sudah Digenerate');
        });
    });
    </script>

</body>
</html>
