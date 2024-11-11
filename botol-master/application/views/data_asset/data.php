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
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Input Data Asset
                    </span>
                </a>
                <!-- Tombol Scan Barcode -->
                <a href="<?= base_url('barcode/scan') ?>" class="btn btn-sm btn-success btn-icon-split ml-2">
                    <span class="icon">
                        <i class="fas fa-barcode"></i>
                    </span>
                    <span class="text">
                        Scan Barcode
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Asset</th>
                    <th>Merk / Kode</th>
                    <th>Quantity</th>
                    <th>OK</th>
                    <th>Rusak</th>
                    <th>Kode Barcode</th> <!-- Kolom untuk Kode Barcode -->
                    <th>Action</th> <!-- Kolom untuk Action -->
                </tr>
            </thead>
            <tbody>
                <?php if ($dataasset) : ?>
                    <?php foreach ($dataasset as $asset) : ?>
                        <tr>
                            <td><?= $asset['id'] ?></td>
                            <td><?= $asset['nama_asset'] ?></td>
                            <td><?= $asset['merk_kode'] ?></td>
                            <td><?= $asset['qty'] ?></td>
                            <td><?= $asset['ok'] ?></td>
                            <td><?= $asset['rusak'] ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#barcodeModal" data-barcode="<?= $asset['merk_kode'] ?>">
                                    <span class="icon">
                                        <i class="fas fa-barcode"></i> <!-- Ikon Barcode -->
                                    </span>
                                    <span class="text">
                                        Lihat Barcode
                                    </span>
                                </button>
                            </td>
                            <td>
                                <a href="<?= base_url('dataasset/edit/' . $asset['id']) ?>" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i> <!-- Ikon Edit -->
                                </a>
                                <a href="<?= base_url('dataasset/delete/' . $asset['id']) ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i> <!-- Ikon Hapus -->
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
            <div class="modal-body" id="barcodeContainer">
                <!-- Barcode akan ditampilkan di sini -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Pastikan Anda sudah mengimpor jQuery dan Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('button[data-toggle="modal"]').on('click', function() {
            var barcodeData = $(this).data('barcode');
            $.ajax({
                url: '<?= base_url('dataasset/generate_barcode/') ?>' + barcodeData,
                method: 'GET',
                success: function(response) {
                    $('#barcodeContainer').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus, errorThrown);
                    alert('Error: ' + textStatus + ' ' + errorThrown);
                }
            });
        });
    });
</script>
