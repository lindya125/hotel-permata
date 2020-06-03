<div class="container">
    <center>
        <table>
            <tr>
                <td>
                    <div class="table-responsive full-width">
                        <table class="table table-bordered table-striped table-hover" id="table-datatable">
                            <tr>
                                <th>No Reservasi</th>
                                <th>Tanggal Reservasi</th>
                                <th>ID User</th>
                                <th>ID Kamar</th>
                                <th>Tanggal Check-in</th>
                                <th>Tanggal Check-out</th>
                                <th>Terlambat</th>
                                <th>Denda</th>
                                <th>Status</th>
                                <th>Total Denda</th>
                                <th>Akan Dikembalikan</th>
                            </tr>
                            <?php
                            $a = 1;

                            foreach ($reservasi as $r) {
                            ?>
                                <tr>
                                    <td><?= $r['no_pinjam']; ?></td>
                                    <td><?= $r['tgl_pinjam']; ?></td>
                                    <td><?= $r['id_user']; ?></td>
                                    <td><?= $r['id_buku']; ?></td>
                                    <td><?= $r['tgl_kembali']; ?></td>
                                    <td> <?= date('Y-m-d'); ?>
                                        <input type="hidden" name="tgl_pengembalian" id="tgl_pengembalian" value="<?= date('Y-m-d'); ?>">
                                    </td>
                                    <td> <?php $tgl1 = new DateTime($r['tgl_kembali']);
                                            $tgl2 = new DateTime();
                                            $selisih = $tgl2->diff($tgl1)->format("%a");
                                            echo $selisih;
                                            ?> Hari
                                    </td>
                                    <td><?= $r['denda']; ?></td>

                                    <?php if ($r['status'] == "Pinjam") {
                                        $status = "warning";
                                    } else {
                                        $status = "secondary";
                                    } ?>
                                    <td><i class="btn btn-outline-primary <?= $status; ?> btn-sm"><?= $r['status']; ?></i></td>

                                    <?php
                                    if ($selisih < 0) {
                                        $total_denda = $r['denda'] * 0;
                                    } else {
                                        $total_denda = $r['denda'] * $selisih;
                                    }
                                    ?>

                                    <td><?= $total_denda; ?>
                                        <input type="hidden" name="totaldenda" id="totaldenda" value="<?= $total_denda; ?>">
                                    </td>
                                    <td nowrap>
                                        <?php if ($r['status'] == "Kembali") { ?>
                                            <i class="btn btn-sm btn-outline-secondary"><i class="fas fa-fw fa-edit"></i>Ubah Status</i>
                                        <?php } else { ?> <a class="btn btn-sm btn-outline-info" href="<?= base_url('reservasi/ubahStatus/' . $r['id_buku'] . '/' . $r['no_pinjam']); ?>"><i class="fas fa-fw fa-edit"></i>Ubah Status</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php
                            } ?>
                        </table>
                    </div>
                </td>
            </tr>

        </table>
    </center>
</div>