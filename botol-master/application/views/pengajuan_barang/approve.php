<div class="container">
    <h2>Approve Pengajuan Barang</h2>
    <?= $this->session->flashdata('pesan'); ?>
    <?= form_open('pengajuan_barang/process_approval/' . $request['id']); ?>
    
    <!-- No Pengajuan -->
    <div class="form-group">
        <label>No Pengajuan</label>
        <input type="text" class="form-control" value="<?= $request['no_pengajuan']; ?>" readonly>
    </div>
    
    <!-- Nama Barang -->
    <div class="form-group">
        <label>Nama Barang</label>
        <input type="text" class="form-control" value="<?= $request['nama_barang']; ?>" readonly>
    </div>
    
    <!-- Qty yang diajukan -->
    <div class="form-group">
        <label>Qty Diajukan</label>
        <input type="number" class="form-control" value="<?= $request['qty']; ?>" readonly>
    </div>
    
    <!-- Dropdown Status -->
    <div class="form-group">
        <label>Status Persetujuan</label>
        <select name="approval_status" id="approval_status" class="form-control" required>
            <option value="">-- Pilih Status --</option>
            <option value="approve">Approve</option>
            <option value="pending">Pending</option>
            <option value="tolak">Tolak</option>
        </select>
    </div>
    
    <!-- Jumlah Disetujui (Hanya tampil jika status "approve") -->
    <div class="form-group" id="approved_qty_container" style="display: none;">
        <label>Jumlah Disetujui</label>
        <input type="number" name="approved_qty" class="form-control">
    </div>
    
    <!-- Tombol Submit -->
    <button type="submit" class="btn btn-primary">Proses</button>
    <a href="<?= base_url('pengajuan_barang'); ?>" class="btn btn-secondary">Kembali</a>
    
    <?= form_close(); ?>
</div>

<script>
    // Menampilkan/menghilangkan input jumlah disetujui berdasarkan pilihan dropdown
    document.getElementById('approval_status').addEventListener('change', function () {
        var approvedQtyContainer = document.getElementById('approved_qty_container');
        if (this.value === 'approve') {
            approvedQtyContainer.style.display = 'block';
        } else {
            approvedQtyContainer.style.display = 'none';
        }
    });
</script>
