<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Input Asset
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('data_asset') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?php if (validation_errors()): ?>
                    <div class="alert alert-danger">
                        <?= validation_errors(); ?>
                    </div>
                <?php endif; ?>
                <?= form_open('data_asset/add'); ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama Asset</th>
                                <th>Merk/Type</th>
                                <th>Qty</th>
                                <th>OK</th>
                                <th>Rusak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <input type="text" name="nama_asset" class="form-control" placeholder="Nama Asset" required>
                                </td>
                                <td>
                                    <input type="text" name="merk_kode" class="form-control" placeholder="Merk/Type" required>
                                </td>
                                <td>
                                    <input type="number" name="qty" class="form-control" placeholder="Qty" required>
                                </td>
                                <td>
                                    <input type="number" name="ok" class="form-control" placeholder="Jumlah OK" required>
                                </td>
                                <td>
                                    <input type="number" name="rusak" class="form-control" placeholder="Jumlah Rusak" required>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row form-group justify-content-center">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
                <!-- Modal Peringatan -->
                <div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="warningModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="warningModalLabel">Peringatan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p id="warningMessage">Jumlah OK dan Rusak tidak sesuai dengan Qty.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Pastikan Anda sudah mengimpor jQuery dan Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        // Ketika form disubmit
        $('form').on('submit', function(e) {
            // Ambil nilai dari input
            var qty = parseInt($('input[name="qty"]').val()) || 0;
            var ok = parseInt($('input[name="ok"]').val()) || 0;
            var rusak = parseInt($('input[name="rusak"]').val()) || 0;

            // Aturan validasi
            if (ok + rusak > qty) {
                e.preventDefault(); // Hentikan pengiriman form
                $('#warningMessage').text("Jumlah Status tidak boleh melebihi Qty."); // Update pesan
                $('#warningModal').modal('show'); // Tampilkan modal peringatan
            } else if (ok + rusak !== qty) {
                e.preventDefault(); // Hentikan pengiriman form
                $('#warningMessage').text("Jumlah Status harus sama dengan Qty."); // Update pesan
                $('#warningModal').modal('show'); // Tampilkan modal peringatan
            }
        });
    });
</script>
