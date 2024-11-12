<?= $this->session->flashdata('pesan'); ?>

<div class="container-fluid">
    <!-- Sidebar Menu -->
    <div class="row">
        <div>
           
        </div>
        
        <!-- Main Content -->
        <div class="col-md-10">
            <hr>

            <!-- Menampilkan kategori di dalam dashboard -->
            <div class="card shadow-sm border-bottom-primary">
                <div class="card-header bg-white py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Kategori Barang</h5>
                </div>
                <div class="card-body">
                    
                    <!-- Tombol Kembali ke Data Aset -->
                    <a href="<?= base_url('dataasset/data') ?>" class="btn btn-secondary mb-3">Kembali</a>

                    <!-- Tombol untuk Menambahkan Barang Berdasarkan Kategori -->
                    <!-- <a href="<?= base_url('dataasset/tambah_barang/' . urlencode($kat['kategori'])) ?>" class="btn btn-success mb-3">Tambah Barang Berdasarkan Kategori</a> -->

                    <!-- Tabel Menampilkan Kategori dan Aksi -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Kategori</th>
                                <th>Jumlah Barang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($kategori as $kat): ?>
                            <tr>
                                <td><?= $kat['kategori'] ?></td>
                                <td><?= $kat['jumlah_barang'] ?></td>
                                <td>
                                    <!-- Tombol Detail Kategori -->
                                    <a href="<?= base_url('dataasset/detail/' . urlencode($kat['kategori'])) ?>" class="btn btn-info btn-sm">Detail</a>
                                    
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
