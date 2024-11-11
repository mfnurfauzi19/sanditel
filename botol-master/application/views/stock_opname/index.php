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
                                <?= $asset['nama_asset']; ?> - <?= $asset['merk_kode']; ?> | Qty : <?= $asset['qty']; ?> | Ok : <?= $asset['ok']; ?> | Rusak: <?= $asset['rusak']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Jumlah Tersedia</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="remarks">Catatan</label>
                    <textarea name="remarks" id="remarks" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
