<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Asset
                </h4>
            </div>
            <div class="col-auto">
                <!-- Tombol Input Data Asset -->
                <a href="<?= base_url('dataasset/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon"><i class="fa fa-plus"></i></span>
                    <span class="text">Input Data Asset</span>
                </a>
                <!-- Tombol By Kategori -->
                <a href="<?= base_url('dataasset/index_kategori') ?>" class="btn btn-sm btn-secondary btn-icon-split ml-2">
                    <span class="icon"><i class="fas fa-list"></i></span>
                    <span class="text">By Kategori</span>
                </a>
                <!-- Tombol Scan Barcode -->
                <a href="<?= base_url('barcode/scan') ?>" class="btn btn-sm btn-success btn-icon-split ml-2">
                    <span class="icon"><i class="fas fa-barcode"></i></span>
                    <span class="text">Scan Barcode</span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <!-- <th>No.</th> -->
                    <th>Nama Asset</th>
                    <th>Merk / Kode</th>
                    <th>Kategori</th>
                    <!-- <th>Quantity</th> -->
                    <th>Status</th>
                    <th>Updated QC/Stock Opname</th>
                    <th>Kode Barcode</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($dataasset) : ?>
                    <?php foreach ($dataasset as $asset) : ?>
                        <tr>
                            <!-- <td><?= $asset['id'] ?></td> -->
                            <td><?= $asset['nama_asset'] ?></td>
                            <td><?= $asset['merk_kode'] ?></td>
                            <td><?= $asset['kategori'] ?></td>
                            <td><?= $asset['status'] == 1 ? 'OK' : 'Rusak' ?></td>
                            <td><?= date('d-m-Y H:i:s', strtotime($asset['updated_at'])); ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#barcodeModal" data-barcode="<?= $asset['id'] ?>">
                                    <span class="icon"><i class="fas fa-barcode"></i></span>
                                    <span class="text">Lihat Barcode</span>
                                </button>
                            </td>
                            <td>
                                <a href="<?= base_url('dataasset/edit/' . $asset['id']) ?>" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= base_url('dataasset/delete/' . $asset['id']) ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data aset yang ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

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
            <div class="modal-body text-center" id="barcodeContainer">
                <div id="barcodeDisplay" class="mb-3"></div>
                <button id="generateBarcodeButton" class="btn btn-primary mb-3">Generate Barcode</button>
                <br>
                <button id="printBarcodeButton" class="btn btn-primary">Print Barcode</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Warning -->
<!-- Modal Warning -->
<div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="warningModalLabel">Peringatan: Barang Akan Kembali</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Beberapa barang akan kembali dalam 2 hari ke depan. Pastikan pengembalian dilakukan tepat waktu.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary">Periksa Pengembalian</button>
      </div>
    </div>
  </div>
</div>

<?php if ($peringatan): ?>
    <script>
        // Tampilkan modal jika ada barang yang masa pinjamnya akan habis dalam 2 hari
        $(document).ready(function() {
            $('#warningModal').modal('show');
        });
    </script>
<?php endif; ?>


<script>
    var csrfName = '<?= $this->security->get_csrf_token_name(); ?>';  
    var csrfHash = '<?= $this->security->get_csrf_hash(); ?>';  
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('button[data-toggle="modal"]').on('click', function() {
            var assetId = $(this).data('barcode');
            console.log('Asset ID:', assetId);

            if (localStorage.getItem('barcode_generated_' + assetId) === 'true') {
                var barcodeUrl = localStorage.getItem('barcode_text_' + assetId);
                console.log('Barcode URL:', barcodeUrl);
                $('#barcodeDisplay').html('<img src="' + barcodeUrl + '" alt="Barcode" class="barcode">');
                $('#generateBarcodeButton').prop('disabled', true).text('Barcode Sudah Digenerate');
            } else {
                $('#barcodeDisplay').html('');
                $('#generateBarcodeButton').prop('disabled', false).text('Generate Barcode');
            }

            $('#generateBarcodeButton').data('barcode', assetId);
        });

        $('#generateBarcodeButton').on('click', function() {
            var assetId = $(this).data('barcode');
            $.ajax({
                url: '<?= base_url('dataasset/get_asset_info') ?>',
                type: 'GET',
                data: { assetId: assetId },
                dataType: 'json',
                success: function(response) {
                    if (response.merk_kode) {
                        var barcodeText = response.merk_kode + '_' + Math.floor(Math.random() * 10000000000);
                        var barcodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' + barcodeText + '&size=150x150';

                        $('#barcodeDisplay').html('<img src="' + barcodeUrl + '" alt="' + barcodeText + '" class="barcode">');
                        $('#barcodeDisplay').append('<p class="barcode-text">' + barcodeText + '</p>'); 

                        localStorage.setItem('barcode_generated_' + assetId, 'true');
                        localStorage.setItem('barcode_text_' + assetId, barcodeUrl);
                        localStorage.setItem('barcode_text_' + assetId + '_text', barcodeText);

                        $('#generateBarcodeButton').prop('disabled', true).text('Barcode Sudah Digenerate');

                        $.ajax({
                            url: '<?= base_url('dataasset/save_barcode') ?>',
                            type: 'POST',
                            data: {
                                assetId: assetId,
                                barcode: barcodeText,
                                [csrfName]: csrfHash
                            },
                            success: function(saveResponse) {
                                csrfHash = saveResponse.csrfHash;
                            },
                            error: function(xhr, status, error) {
                                console.log('Error saving barcode:', error);
                            }
                        });
                    } else {
                        alert('Gagal mendapatkan data merk_kode dari server!');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data asset!');
                }
            });
        });

        $('#printBarcodeButton').on('click', function() {
            var barcodeUrl = $('#barcodeDisplay img').attr('src');
            if (barcodeUrl) {
                var printWindow = window.open('', '_blank', 'width=400,height=300');
                printWindow.document.write('<html><head><title>Print Barcode</title>');
                printWindow.document.write('<style>img { width: 150px; height: 150px; margin: 0 auto; display: block; }</style>');
                printWindow.document.write('</head><body>');
                printWindow.document.write('<img src="' + barcodeUrl + '" alt="Barcode"/><br/>');
                printWindow.document.write('<button onclick="window.print()">Print</button>');
                printWindow.document.write('</body></html>');
                printWindow.document.close();
            } else {
                alert('Barcode belum digenerate.');
            }
        });
    });
</script>
