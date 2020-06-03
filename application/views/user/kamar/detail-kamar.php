<div class="x_panel" align="center">
    <div class="x_content">
        <div class="row">
            <div class="col-sm-3 col-md-3">
                <div class="thumbnail" style="height: auto; position: relative; left: 100%; width: 200%;">
                    <img src="<?php echo base_url(); ?>assets/img/upload/<?= $gambar; ?>" style="max-width:100%; max-height: 100%; height: 150px; width: 120px">
                    <div class="caption">
                        <h5 style="min-height:40px;" align="center"><?= $type_kamar ?></h5>
                        <center>
                            <table class="table table-stripped">
                                <tr>
                                    <th nowrap>Type Kamar: </th>
                                    <td nowrap><?= $type_kamar; ?></td>
                                    <td>&nbsp;</td>
                                    <th>Kategori: </th>
                                    <td><?= $kategori ?></td>
                                </tr>
                                <tr>
                                    <th nowrap>Harga: </th>
                                    <td><?= $harga ?></td>
                                    <td>&nbsp;</td>
                                    <th>Check Out: </th>
                                    <td><?= $check_out ?></td>
                                </tr>
                                <tr>
                                    <th nowrap>Tersedia: </th>
                                    <td><?= $stok ?></td>
                                    <td>&nbsp;</td>
                                    <th>Check In: </th>
                                    <td><?= $check_in ?></td>
                                </tr>
                            </table>
                        </center>
                        <p>
                            <?php
                            if ($stok < 1) {
                                echo "<i class='disable btn btn-outline-primary fas fw fa-meteor'> Stok Kosong</i>";
                            } else {
                                echo "<a class='btn btn-outline-primary fas fw fa-shopping-cart' href='" . base_url('booking/tambahBooking/' . $id) . "'> Booking</a>";
                            }
                            ?>
                            <span class="btn btn-outline-secondary fas fw fa-reply" onclick="window.history.go(-1)"> Kembali</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>