<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Asset
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
                <?= form_open('data_asset/update/' . $asset['id'], ['id' => 'editAssetForm']); ?>
                
                <div class="form-group">
                    <label for="nama_asset">Nama Asset</label>
                    <input type="text" id="nama_asset" name="nama_asset" class="form-control" value="<?= set_value('nama_asset', $asset['nama_asset']); ?>" required>
                    <?= form_error('nama_asset', '<small class="text-danger">', '</small>'); ?>
                </div>
                
                <div class="form-group">
                    <label for="merk_kode">Merk/Type</label>
                    <input type="text" id="merk_kode" name="merk_kode" class="form-control" value="<?= set_value('merk_kode', $asset['merk_kode']); ?>" required>
                    <?= form_error('merk_kode', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label for="qty">Qty</label>
                    <input type="number" id="qty" name="qty" class="form-control" value="<?= set_value('qty', $asset['qty']); ?>" required>
                    <?= form_error('qty', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label for="ok">Jumlah OK</label>
                    <input type="number" id="ok" name="ok" class="form-control" value="<?= set_value('ok', $asset['ok']); ?>" required>
                    <?= form_error('ok', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label for="rusak">Jumlah Rusak</label>
                    <input type="number" id="rusak" name="rusak" class="form-control" value="<?= set_value('rusak', $asset['rusak']); ?>" required>
                    <?= form_error('rusak', '<small class="text-danger">', '</small>'); ?>
                </div>

                <!-- Modal Konfirmasi -->
                <div class="modal fade" id="confirmUpdateModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Update</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin meng-update data asset ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="button" id="confirmUpdate" class="btn btn-primary">Ya, Update</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Pemberitahuan Ketidaksamaan -->
                <div class="modal fade" id="mismatchModal" tabindex="-1" role="dialog" aria-labelledby="mismatchModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mismatchModalLabel">Kesalahan Input</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Jumlah Status harus sama dengan Qty. Silakan periksa input Anda.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Pemberitahuan Jumlah Melebihi -->
                <div class="modal fade" id="exceedModal" tabindex="-1" role="dialog" aria-labelledby="exceedModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exceedModalLabel">Kesalahan Input</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Jumlah Status tidak boleh melebihi Qty. Silakan periksa input Anda.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col text-center">
                        <button type="button" class="btn btn-primary" id="showUpdateModal">Update</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
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
        // Ketika tombol Update diklik, tampilkan modal konfirmasi
        $('#showUpdateModal').on('click', function() {
            var qty = parseInt($('#qty').val());
            var ok = parseInt($('#ok').val());
            var rusak = parseInt($('#rusak').val());

            // Validasi bahwa jumlah OK dan Rusak tidak boleh melebihi Qty
            if (ok + rusak > qty) {
                $('#exceedModal').modal('show'); // Tampilkan modal pemberitahuan jika jumlah OK dan Rusak melebihi Qty
            } else if (ok + rusak != qty) {
                $('#mismatchModal').modal('show'); // Tampilkan modal pemberitahuan jika tidak sesuai
            } else {
                $('#confirmUpdateModal').modal('show'); // Tampilkan modal konfirmasi jika validasi berhasil
            }
        });

        // Jika user mengkonfirmasi update
        $('#confirmUpdate').on('click', function() {
            $('#editAssetForm').submit(); // Kirim form
        });
    });
</script>
