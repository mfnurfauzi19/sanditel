<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Tenaga Kerja
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('customer') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open('', [], ['id' => $customer['id']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="fullname">Nama </label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-user"></i></span>
                            </div>
                            <input value="<?= set_value('fullname', $customer['fullname']); ?>" name="fullname" id="fullname" type="text" class="form-control" placeholder="Nama Customer...">
                        </div>
                        <?= form_error('fullname', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="phone">Nomor Telepon</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-phone"></i></span>
                            </div>
                            <input value="<?= set_value('phone', $customer['phone']); ?>" name="phone" id="phone" type="text" class="form-control" placeholder="Nomor Telepon...">
                        </div>
                        <?= form_error('phone', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="address">Divisi</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-building"></i></span>
                            </div>
                            <textarea name="address" id="address" class="form-control" rows="4" placeholder="Divisi...."><?= set_value('address', $customer['address']); ?></textarea>
                        </div>
                        <?= form_error('address', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>