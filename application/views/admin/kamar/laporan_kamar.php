<!-- Begin Page Content -->

<div class="container-fluid">

    <?= $this->session->flashdata('pesan'); ?>
    <div class="row">
        <div class="col-lg-12">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <?= $this->session->flashdata('pesan'); ?>
            <a target="_blank" href="<?= base_url('laporan/cetak_laporan_kamar'); ?>" class="btn btn-primary mb-3"><i class="fas fa-print"></i> Print</a>
            <a target="_blank" href="<?= base_url('laporan/laporan_kamar_pdf'); ?>" class="btn btn-warning mb-3"><i class="far fa-file-pdf"></i> Download Pdf</a>
            <a target="_blank" href="<?= base_url('laporan/export_excel'); ?>" class="btn btn-success mb-3"><i class="far fa-file-excel"></i> Export ke Excel</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Type Kamar</th>
                        <th scope="col">Harga</th>
                        <!-- <th scope="col">Penerbit</th> -->
                        <!-- <th scope="col">Tahun Terbit</th> -->
                        <!-- <th scope="col">ISBN</th> -->
                        <th scope="col">Stok</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $a = 1;
                    foreach ($kamar as $k) { ?> <tr>
                            <th scope="row"><?= $a++; ?></th>
                            <td><?= $k['type_kamar']; ?></td>
                            <td><?= $k['harga']; ?></td>
                            <!-- <td><?= $k['penerbit']; ?></td> -->
                            <!-- <td><?= $k['tahun_terbit']; ?></td> -->
                            <!-- <td><?= $k['isbn']; ?></td> -->
                            <td><?= $k['stok']; ?></td>
                        </tr> <?php } ?> </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content