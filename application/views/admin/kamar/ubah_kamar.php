<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <div class="row">
        <div class="col-lg-6">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <?= $this->session->flashdata('pesan'); ?>
            <?php foreach ($kamar as $k) { ?>
                <form action="<?= base_url('buku/ubahBuku'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="<?= $k['id']; ?>">
                        <input type="text" class="form-control form-control-user" id="type_kamar" name="type_kamar" placeholder="Masukkan Type Kamar" value="<?= $k['type_kamar']; ?>">
                    </div>
                    <div class="form-group">
                        <select name="id_kategori" class="form-control form-control-user">
                            <option value="<?= $id; ?>" selected="selected"><?= $k; ?></option>
                            <?php
                            foreach ($kategori as $k) { ?>
                                <option value="<?= $k['id']; ?>"><?= $k['kategori']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="harga" name="harga" placeholder="Masukkan harga" value="<?= $k['harga']; ?>">
                    </div>
                   <!--  <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="penerbit" name="penerbit" placeholder="Masukkan nama penerbit" value="<?= $k['penerbit']; ?>">
                    </div>
                    <div class="form-group">
                        <select name="tahun" class="form-control form-control-user">
                            <option value="<?= $k['tahun_terbit']; ?>"><?= $k['tahun_terbit']; ?></option>
                            <?php
                            for ($i = date('Y'); $i > 1500; $i--) { ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                            <?php } ?>
                        </select>
                    </div> -->
                    <!-- <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="isbn" name="isbn" placeholder="Masukkan ISBN" value="<?= $k['isbn']; ?>">
                    </div> -->
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="stok" name="stok" placeholder="Masukkan nominal stok" value="<?= $k['stok']; ?>">
                    </div>
                    <div class="form-group">
                        <?php
                        if (isset($k['image'])) { ?>

                            <input type="hidden" name="old_pict" id="old_pict" value="<?= $k['image']; ?>">

                            <picture>
                                <source srcset="" type="image/svg+xml">
                                <img src="<?= base_url('assets/img/upload/') . $k['image']; ?>" class="rounded mx-auto mb-3 d-blok" alt="...">
                            </picture>

                        <?php } ?>

                        <input type="file" class="form-control form-control-user" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <input type="button" class="form-control form-control-user btn btn-dark col-lg-3 mt-3" value="Kembali" onclick="window.history.go(-1)">
                        <input type="submit" class="form-control form-control-user btn btn-primary col-lg-3 mt-3" value="Update">
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</div>