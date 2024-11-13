<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Daftar Pengajuan Barang
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= site_url('pengajuan_barang/add') ?>" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i> Tambah Pengajuan Barang
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal Pengajuan</th>
                            <th>No Pengajuan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($requests as $request): ?>
                        <tr>
                            <td><?= date('d-m-Y', strtotime($request['tanggal'])); ?></td>
                            <td><?= $request['no_pengajuan']?>/VII/PAMBMD/2024</td>
                            <td>
                                <?php if ($request['approved'] == 2): ?>
                                    <span class="badge badge-success">Approved</span>
                                <?php elseif ($request['approved'] == 0): ?>
                                    <span class="badge badge-danger">Rejected</span>
                                <?php elseif ($request['approved'] == 1): ?>
                                    <span class="badge badge-warning">Pending</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($this->session->userdata('login_session')['role'] === 'admin' || $request['approved'] == 1): ?>
                                    <a href="<?= site_url('pengajuan_barang/edit/' . $request['id']) ?>" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="<?= site_url('pengajuan_barang/delete/' . $request['id']) ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus pengajuan ini?');">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if ($this->session->userdata('login_session')['role'] === 'admin' && $request['approved'] == 1): ?>
                                    <a href="<?= site_url('pengajuan_barang/approve/' . $request['id']) ?>" class="btn btn-success btn-sm" title="Approve">
                                        <i class="fa fa-check"></i>
                                    </a>
                                    
                                <?php endif; ?>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewDetailsModal<?= $request['id']; ?>" title="Lihat">
                                        <i class="fa fa-eye"></i>
                                    </button>
                            </td>
                        </tr>

                        <!-- Modal Detail Pengajuan Barang -->
                        <div class="modal fade" id="viewDetailsModal<?= $request['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewDetailsModalLabel<?= $request['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewDetailsModalLabel<?= $request['id']; ?>">Detail Pengajuan Barang</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Detail Pengajuan Barang -->
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal Pengajuan:</label>
                                            <p><?= $request['tanggal']; ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_pengajuan">No Pengajuan:</label>
                                            <p><?= $request['no_pengajuan']; ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_barang">Nama Barang:</label>
                                            <p><?= $request['nama_barang']; ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="merk_kode">Merk/Kode:</label>
                                            <p><?= $request['merk_kode']; ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="qty">Quantity:</label>
                                            <p><?= $request['qty']; ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis">Jenis Barang:</label>
                                            <p><?= $request['jenis']; ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status Pengajuan:</label>
                                            <?php if ($request['approved'] == 2): ?>
                                                <span class="badge badge-success">Approved</span>
                                            <?php elseif ($request['approved'] == 0): ?>
                                                <span class="badge badge-danger">Rejected</span>
                                            <?php elseif ($request['approved'] == 1): ?>
                                                <span class="badge badge-warning">Pending</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="approved_qty">Approved Quantity:</label>
                                            <p><?= $request['approved_qty'] ?: '-'; ?></p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span>Showing <?= $currentIndex + 1; ?> to <?= min($currentIndex + $itemsPerPage, $totalItems); ?> of <?= $totalItems; ?> entries</span>
                    </div>
                    <div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item <?= $currentIndex == 0 ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="<?= site_url('pengajuan_barang/index/' . max(0, $currentIndex - $itemsPerPage)); ?>">Previous</a>
                                </li>
                                <?php 
                                $totalPages = ceil($totalItems / $itemsPerPage);
                                for ($i = 0; $i < $totalPages; $i++): ?>
                                    <li class="page-item <?= $currentIndex == $i * $itemsPerPage ? 'active' : ''; ?>">
                                        <a class="page-link" href="<?= site_url('pengajuan_barang/index/' . ($i * $itemsPerPage)); ?>"><?= $i + 1; ?></a>
                                    </li>
                                <?php endfor; ?>
                                <li class="page-item <?= ($currentIndex + $itemsPerPage) >= $totalItems ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="<?= site_url('pengajuan_barang/index/' . ($currentIndex + $itemsPerPage)); ?>">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
