<div class="container">
    <h2 class="my-4">Tambah Aset</h2>
    <?= $this->session->flashdata('message'); ?>
    <?= $this->session->flashdata('error'); ?>

    <?= form_open('dataasset/add'); ?>
        <div class="form-group">
            <label for="nama_asset">Nama Asset</label>
            <input type="text" name="nama_asset" class="form-control" id="nama_asset" placeholder="Masukkan Nama Asset">
            <?= form_error('nama_asset', '<small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group">
            <label for="merk_kode">Merk/Kode</label>
            <input type="text" name="merk_kode" class="form-control" id="merk_kode" placeholder="Masukkan Merk/Kode">
            <?= form_error('merk_kode', '<small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group">
            <label for="qty">Quantity</label>
            <input type="number" name="qty" class="form-control" id="qty" placeholder="Masukkan Quantity">
            <?= form_error('qty', '<small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" id="status">
                <option value="OK">OK</option>
                <option value="Not Yet">Not Yet</option>
            </select>
            <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    <?= form_close(); ?>
</div>
