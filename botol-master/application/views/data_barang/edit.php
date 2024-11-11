<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Barang
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('data_barang') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open('data_barang/update/'.$barang['id']); ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama Barang</th>
                                <th>Merk/Type</th>
                                <th>Qty</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <input type="text" name="nama_barang" class="form-control" value="<?= $barang['nama_barang']; ?>" placeholder="Nama Barang" required>
                                </td>
                                <td>
                                    <input type="text" name="merk_kode" class="form-control" value="<?= $barang['merk_kode']; ?>" placeholder="Merk/Type" required>
                                </td>
                                <td>
                                    <input type="number" name="qty" class="form-control" value="<?= $barang['qty']; ?>" placeholder="Qty" required>
                                </td>
                                <td>
                                    <input type="number" name="harga" class="form-control" value="<?= $barang['harga']; ?>" placeholder="Harga" required>
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
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Pastikan Anda sudah mengimpor jQuery dan Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
