<div class="container">
    <div class="card shadow-sm mt-4">
    <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Stock Opname</h6>
        </div>
        <div class="card-body">
            <?= $this->session->flashdata('pesan'); ?>

            <form action="<?= base_url('stock_opname/save'); ?>" method="post">
                <div class="form-group">
                    <label for="asset_id">Pilih Asset</label>
                    <select name="asset_id" id="asset_id" class="form-control" required>
                        <?php foreach ($assets as $asset): ?>
                            <option value="<?= $asset['id']; ?>">
                                <?= $asset['nama_asset']; ?> - <?= $asset['merk_kode']; ?> | Qty : <?= $asset['qty']; ?> | Ok : <?= $asset['ok']; ?> | Rusak: <?= $asset['status']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
               
               <center> <button type="submit" class="btn btn-primary">Cari</button></center>
            </form>
        </div>
    </div>
</div>
