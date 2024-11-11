<div class="card-body">
    <?= $this->session->flashdata('pesan'); ?>
    <?php if (validation_errors()): ?>
        <div class="alert alert-danger">
            <?= validation_errors(); ?>
        </div>
    <?php endif; ?>
    <?= form_open('data_asset/add'); ?>
    <div class="table-responsive">
        <div class="col">
            <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                Form Input Data Barang
            </h4>
        </div>
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
                        <input type="text" name="merk_type" class="form-control" placeholder="Merk/Type" required>
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
    <?= form_close(); ?>
</div>
