<div class="container-fluid">
    <div class="row">
        <div class=>
            <!-- Sidebar bisa diletakkan di sini jika diperlukan -->
        </div>

        <div class="col-md-10">
            <!-- Card untuk detail kategori dengan margin kiri -->
            <div class="card shadow-sm border-bottom-primary mt-4 ml-md-3"> <!-- menambahkan margin kiri -->
                <div class="card-header bg-white py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Detail Kategori: <?= $kategori ?></h5>
                </div>
                <div class="card-body">
                    <!-- Form Pencarian Aset -->
                    <form method="get" action="<?= current_url() ?>" class="form-inline mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Cari Aset..." value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                        <button type="submit" class="btn btn-primary ml-2">Cari</button>
                    </form>
                    <a href="<?= base_url('dataasset/index_kategori') ?>" class="btn btn-secondary mb-3">Kembali</a>


                    <!-- Tabel untuk menampilkan aset -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Aset</th>
                                <th>Merk</th>
                                <th>Kategori</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($assets)): ?>
                                <?php foreach ($assets as $asset): ?>
                                <tr>
                                    <td><?= $asset['id'] ?></td>
                                    <td><?= $asset['nama_asset'] ?></td>
                                    <td><?= $asset['merk_kode'] ?></td>
                                    <td><?= $asset['kategori'] ?></td>
                                    <td><?= $asset['qty'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3">Tidak ada aset ditemukan</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Menampilkan jumlah hasil pencarian -->
                    <p>Jumlah Aset: <?= $jumlah_field ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
