<div class="container-fluid">
    <!-- Flash Message -->
    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('message'); ?>
        </div>
    <?php endif; ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Peminjaman Asset</h6>
        </div>
        <div class="col-auto mt-2 mb-2">
            <a href="<?= base_url('peminjaman/create') ?>" class="btn btn-sm btn-primary btn-icon-split">
                <span class="icon">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">
                    Tambah Peminjaman Asset
                </span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barang</th>
                            <th>Peminjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Jumlah Dipinjam</th>
                            <th>Sisa Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($peminjaman)): ?>
                            <?php foreach ($peminjaman as $index => $item): ?>
                                <tr>
                                    <td><?= $index + 1; ?></td>
                                    <td><?= htmlspecialchars($item['nama_asset']); ?> (<?= htmlspecialchars($item['barcode']); ?>)</td>
                                    <td><?= htmlspecialchars($item['peminjam']); ?> / <?= htmlspecialchars($item['departemen']); ?></td>
                                    <td><?= htmlspecialchars(date('d-m-Y', strtotime($item['tanggal_pinjam'])));?></td>
                                    <td><?= htmlspecialchars(date('d-m-Y', strtotime($item['tanggal_kembali'])));?></td>
                                    <td><?= htmlspecialchars($item['jumlah_pinjam']); ?></td>
                                    <td><?= $item['sisa_stok']; ?></td> <!-- Menampilkan sisa stok -->
                                        <td>
                                        <a href="<?= base_url('peminjaman/edit/' . $item['id']) ?>" class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="<?= base_url('peminjaman/delete/' . $item['id']) ?>" class="btn btn-success btn-sm" onclick="return confirm('Data sudah dikembalikan oleh yang bersangkutan?');">
                                            <i class="fa fa-check"></i> kembalikan
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data peminjaman.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to initialize DataTable -->
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        // Opsi DataTable dapat ditambahkan di sini
        "language": {
            "emptyTable": "Tidak ada data tersedia di tabel ini.",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
            "lengthMenu": "Tampilkan _MENU_ entri",
            "search": "Cari:",
            "zeroRecords": "Tidak ada entri yang cocok ditemukan."
        }
    });
});
</script>
