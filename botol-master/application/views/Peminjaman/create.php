<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Peminjaman Asset</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-bottom-primary">
                <div class="card-header bg-white py-3">
                    <div class="row">
                        <div class="col">
                            <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                                Form Tambah Peminjaman Asset
                            </h4>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('peminjaman') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                                <span class="icon">
                                    <i class="fa fa-arrow-left"></i>
                                </span>
                                <span class="text">Kembali</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <?= form_open('peminjaman/create'); ?>
                    
                    <div class="form-group">
                        <label for="barang_id">Barang</label>
                        <select name="barang_id" id="barang_id" class="form-control" required>
                            <option value="">Pilih Barang</option>
                            <?php foreach ($barang as $item): ?>
                                <option value="<?= $item['id']; ?>" data-stok="<?= $item['sisa_stok']; ?>">
                                    <?= $item['nama_asset']; ?> 
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('barang_id', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <!-- Tampilkan Sisa Stok di sini
                    <div class="form-group">
                        <span id="sisaStokText" class="text-info">Sisa Stok: -</span>
                    </div> -->

                    <div class="form-group">
                        <label for="tanggal_pinjam">Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" required>
                        <?= form_error('tanggal_pinjam', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_kembali">Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" required>
                        <?= form_error('tanggal_kembali', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok yang Tersedia</label>
                        <input type="number" id="stok" class="form-control" value="0" readonly>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_pinjam">Jumlah yang Dipinjam</label>
                        <input type="number" name="jumlah_pinjam" id="jumlah_pinjam" class="form-control" min="1" required>
                        <?= form_error('jumlah_pinjam', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="peminjam">Peminjam</label>
                        <input type="text" name="peminjam" id="peminjam" class="form-control" min="1" required>
                        <?= form_error('peminjam', '<small class="text-danger">', '</small>'); ?>
                    </div>
                        <div class="form-group">
                            <label for="departemen">Departemen</label>
                            <select id="departemen" name="departemen" class="form-control">
                                <option value="">Pilih Departemen</option>
                                <option value="BPKAD">BPKAD</option>
                                <option value="PBJ">PBJ</option>
                                <option value="BIRO UMUM">BIRO UMUM</option>
                                <option value="BIRO ORGANISASI">BIRO ORGANISASI</option>
                                <option value="BIRO KESRA">BIRO KESRA</option>
                                <option value="SECURITY">SECURITY</option>
                                <option value="BKD">BKD</option>
                                <option value="CLEANING SERVICE">CLEANING SERVICE</option>
                            </select>
                        </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Tambah Peminjaman</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>

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
                    <p id="warningMessage">Tanggal pengembalian Tidak bisa kurang dari Tanggal Peminjaman</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk update sisa stok berdasarkan pilihan barang -->
    <script>
        document.getElementById("barang_id").addEventListener("change", function() {
            const selectedOption = this.options[this.selectedIndex];
            const sisaStok = selectedOption.getAttribute("data-stok");
            document.getElementById("sisaStokText").innerText = "Sisa Stok: " + sisaStok;
        });
    </script>

    <!-- JavaScript tambahan lainnya -->
    <script>
    $(document).ready(function() {
        const barangSelect = $('#barang_id');
        const stokInput = $('#stok');
        const jumlahPinjamInput = $('#jumlah_pinjam');
        const warningMessage = $('#warningMessage');
        const warningModal = $('#warningModal');

        barangSelect.on('change', function() {
            const stok = $(this).find(':selected').data('stok');
            stokInput.val(stok);
            jumlahPinjamInput.attr('max', stok);
        });

        jumlahPinjamInput.on('input', function() {
            const maxStok = parseInt(stokInput.val(), 10);
            const jumlahPinjam = parseInt($(this).val(), 10);

            if (jumlahPinjam > maxStok) {
                warningMessage.text('Jumlah pinjaman tidak boleh melebihi stok yang tersedia!');
                warningModal.modal('show');
                $(this).val(maxStok); // Set jumlah pinjam ke stok maksimum
            }
        });

        $('form').on('submit', function(e) {
            const tp = new Date($('#tanggal_pinjam').val());
            const tk = new Date($('#tanggal_kembali').val());

            if (tk < tp) {
                e.preventDefault();
                warningMessage.text("Tanggal pengembalian tidak boleh kurang dari tanggal peminjaman");
                warningModal.modal('show');
            }
        });
    });
    </script>

</body>
</html>
