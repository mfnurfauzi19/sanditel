<!-- views/data_barang/index.php -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Barang</h1>
    <a href="<?= site_url('dataBarang/create'); ?>" class="btn btn-primary mb-3">Tambah Barang</a>
    <?php if($this->session->flashdata('message')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('message'); ?>
        </div>
    <?php endif; ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Barang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Merk/Type</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($databarang)): ?>
                            <?php foreach($databarang as $barang): ?>
                                <tr>
                                    <td><?= isset($barang['id']) ? $barang['id'] : 'N/A'; ?></td>
                                    <td><?= isset($barang['nama_barang']) ? $barang['nama_barang'] : 'N/A'; ?></td>
                                    <td><?= isset($barang['merk_kode']) ? $barang['merk_kode'] : 'N/A'; ?></td>
                                    <td><?= isset($barang['qty']) ? $barang['qty'] : 'N/A'; ?></td>
                                    <td><?= isset($barang['harga']) ? $barang['harga'] : 'N/A'; ?></td>
                                    <td>
                                        <a href="<?= site_url('dataBarang/edit/'.$barang['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="<?= site_url('dataBarang/delete/'.$barang['id']); ?>" onclick="return confirm('Yakin ingin menghapus?');" class="btn btn-danger btn-sm">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">Tidak ada data barang.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
