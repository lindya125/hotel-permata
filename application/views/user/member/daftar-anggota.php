<div class="container">
    <div class="row">

        <div class="col-lg-5 mt-3 mx-auto">
            <div class="card">
                <div class="card-body">
                <h5 class="text-center">Daftar</h5>
                <hr>
                <?= $this->session->flashdata('pesan'); ?>
                    <form action="<?= base_url('member/daftar'); ?>" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" value="<?= set_value('nama'); ?>" id="nama" nama="nama" placeholder="Nama Lengkap">
                            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" value="<?= set_value('address'); ?>" id="address" nama="address" placeholder="Alamat Lengkap">
                            <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user"value="<?= set_value('email'); ?>" id="email" nama="email" placeholder="Alamat Email">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" id="password1" nama="password1" placeholder="Password">
                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" id="password2" nama="password2" placeholder="Ulangi Password">
                            <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
