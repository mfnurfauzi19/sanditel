<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Add Asset
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
                <?= form_open('data_asset/add', ['id' => 'addAssetForm']); ?>
                
                <div class="form-group">
                    <label for="nama_asset">Nama Asset</label>
                    <input type="text" id="nama_asset" name="nama_asset" class="form-control" placeholder="Nama Asset" required>
                    <?= form_error('nama_asset', '<small class="text-danger">', '</small>'); ?>
                </div>
                
                <div class="form-group">
                    <label for="merk_kode">Merk/Type</label>
                    <input type="text" id="merk_kode" name="merk_kode" class="form-control" placeholder="Merk/Type" required>
                    <?= form_error('merk_kode', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Laptop">Laptop</option>
                        <option value="Komputer">Komputer</option>
                        <option value="Power Supply">Power Supply</option>
                        <option value="Walkie Talkie">Walkie Talkie</option>
                        <option value="Switch Management">Switch Management</option>
                        <option value="Router L3">Router L3</option>
                        <option value="Server">Server</option>
                        <option value="Rack">Rack</option>
                        <option value="Tools Networking">Tools Networking</option>
                        <option value="Antena">Antena</option>
                    </select>
                    <?= form_error('kategori', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label for="qty">Qty</label>
                    <input type="number" id="qty" name="qty" class="form-control" value="1" readonly required>
                    <?= form_error('qty', '<small class="text-danger">', '</small>'); ?>
                </div>


                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="1">OK</option>
                        <option value="0">Rusak</option>
                    </select>
                    <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="row form-group">
                    <div class="col text-center">
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
