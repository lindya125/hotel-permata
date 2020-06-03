<table border=1>
    <?php
    foreach ($useraktif as $u) {
    ?>
    <tr>
        <th>Nama Anggota : <?= ucwords($u->name); ?></th>
    </tr>
    <tr>
        <th>Kamar Yang dibooking:</th>
    </tr>
    <?php } ?>
    <tr>
        <td>
            <div class="table-responsive">
                <table border=1>
                    <tr>
                        <th>No.</th>
                        <th>Kamar</th>
                        <th>Harga</th>
                        <!-- <th>penerbit</th> -->
                        <!-- <th>Tahun</th> -->
                        <th>Check In</th>
                        <th>Check Out</th>
                    </tr>
                    <?php
                    $no = 1;
                        foreach ($items as $i) {
                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td>
                        <?= $i['type_kamar']; ?>
                        </td>
                        <td><?= $i['harga']; ?></td>
                        <!-- <td><?= $i['penerbit']; ?></td> -->
                        <!-- <td><?= $i['tahun_terbit']; ?></td> -->
                        <td><?= $i['tgl_booking']; ?></td>
                        <td><?= $i['batas_check_out']; ?></td>
                    </tr>
                    <?php $no++;
                    } 
                    ?>
                </table>
            </div>
        </td>
    </tr>

    <tr>
        <td>
            <hr>
        </td>
    </tr>
    <tr>
        <td align="center">
            <?= md5(date('d M Y H:i:s')); ?>
        </td>
    </tr>
</table>