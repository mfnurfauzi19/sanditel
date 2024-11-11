<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-bottom-primary">
                <div class="card-header bg-white py-3">
                    <div class="row">
                        <div class="col">
                            <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                                <?= $title; ?>
                            </h4>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('pengajuan_barang'); ?>" class="btn btn-sm btn-secondary btn-icon-split">
                                <span class="icon">
                                    <i class="fa fa-arrow-left"></i>
                                </span>
                                <span class="text">Kembali</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Pesan Flash Data -->
                    <?= $this->session->flashdata('pesan'); ?>
                    <!-- Form untuk Pengajuan Barang -->
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>No Pengajuan</label>
                        <input type="text" name="no_pengajuan" class="form-control" required>
                    </div>
                    <h4 class="h5 align-middle m-0 font-weight-bold text-primary">Daftar Barang</h4>
                    <br>
                    <!-- Form untuk Menambah Barang ke Cart -->
                    <?= form_open('pengajuan_barang/add_to_cart'); ?>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Merk/Kode</label>
                        <input type="text" name="merk_kode" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Qty</label>
                        <input type="number" name="qty" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis</label>
                        <input type="text" name="jenis" class="form-control" required>
                    </div>
                    <div class="row form-group">
                        <div class="col offset-md-4">
                            <button type="submit" class="btn btn-info btn-sm btn-icon-split">
                                <span class="icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </span>
                                <span class="text">Simpan</span>
                            </button>
                        </div>
                    </div>
                    <?= form_close(); ?>

                    <!-- Daftar Barang di Cart -->
                    <table class="table table-hover table-bordered" style="font-size:12px;margin-top:10px;">
                        <thead>
                            <tr>
                                <th style="text-align:center;">Barang</th>
                                <th style="text-align:center;">Merk/Kode</th>
                                <th style="text-align:center;">QTY</th>
                                <th style="text-align:center;">Jenis</th>
                                <th style="width:100px;text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($this->session->userdata('cart'))): ?>
                                <?php $cart = $this->session->userdata('cart'); ?>
                                <?php foreach ($cart as $key => $item): ?>
                                    <tr>
                                        <td style="text-align:center;"><?= $item['nama_barang']; ?></td>
                                        <td style="text-align:center;"><?= $item['merk_kode']; ?></td>
                                        <td style="text-align:center;"><?= $item['qty']; ?></td>
                                        <td style="text-align:center;"><?= $item['jenis']; ?></td>
                                        <td style="text-align:center;">
                                            <a href="<?= base_url('pengajuan_barang/remove/' . $key); ?>" class="btn btn-danger btn-sm">
                                                <span class="fa fa-window-close text-warning"></span> Batal
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align:center;">Belum ada barang dalam keranjang.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Tombol Kirim Pengajuan -->
                    <div class="row form-group">
                        <div class="col offset-md-4">
                            <?= form_open('pengajuan_barang/process_request'); ?>
                            <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
                            <?= form_close(); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
