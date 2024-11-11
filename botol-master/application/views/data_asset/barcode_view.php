<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <style>
        /* Mengatur lebar modal dan memperpendeknya */
        .modal-dialog {
            max-width: 400px;
            margin: 1.75rem auto;
        }
        
        /* Mengatur posisi barcode sedikit lebih ke kiri */
        .barcode-container {
            display: flex;
            justify-content: flex-start;
            margin-left: -25px;
        }

        /* Menyusun tombol print di tengah */
        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }

        /* Aturan cetak khusus untuk kertas kecil */
        @media print {
            /* Mengatur ukuran halaman cetak menjadi lebih kecil, misal ukuran 8cm x 5cm */
            @page {
                size: 8cm 5cm; /* Lebar 8 cm, tinggi 5 cm */
                margin: 0; /* Hilangkan margin halaman */
            }

            body {
                margin: 0;
                padding: 0;
            }

            body * {
                visibility: hidden; /* Sembunyikan semua elemen */
            }

            .barcode-container, .barcode-container * {
                visibility: visible; /* Tampilkan hanya barcode */
            }

            .barcode-container {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                padding: 10px;
            }

            html, body {
                height: 100%;
            }
        }
    </style>
</head>
<body>
    
    <div class="container mt-5 text-center">
        <!-- Tampilkan barcode -->
        <div class="barcode-container">
            <?= $barcode; ?>
        </div>

        <!-- Tombol Print -->
        <div class="button-container">
            <button class="btn btn-primary" id="printButton">Print Barcode</button>
        </div>
    </div>

    <!-- Pastikan Anda sudah mengimpor jQuery dan Bootstrap JS jika diperlukan -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript untuk Print -->
    <script>
        document.getElementById('printButton').addEventListener('click', function () {
            window.print(); // Memicu perintah cetak
        });
    </script>
</body>
</html>
