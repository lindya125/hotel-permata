<!DOCTYPE html>
<html>

<head>
    <title><?= $title; ?></title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/logo/'); ?>logo-pb.png">
</head>

<body>
    <style type="text/css">
        .table-data {
            width: 100%;
            border-collapse: collapse;
        }

        .table-data tr th,
        .table-data tr td {
            border: 1px solid black;
            font-size: 11pt;
            font-family: Verdana;
            padding: 10px 10px 10px 10px;
        }

        h3 {
            font-family: Verdana;
        }
    </style>

    <h3>
        <center>Laporan Data Kamar Online</center>
    </h3> <br />
    <table class="table-data">
        <thead>
            <tr>
                <th>No</th>
                <th>Type Kamar</th>
                <th>Harga</th>
                <!-- <th>Terbit</th> -->
                <!-- <th>Tahun Penerbit</th> -->
                <!-- <th>ISBN</th> -->
                <th>Stok</th>
            </tr>
        </thead>
        <tbody> <?php $no = 1;
                foreach ($kamar as $k) {    ?> <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td><?= $k['type_kamar']; ?></td>
                    <td><?= $k['harga']; ?></td>
                    <!-- <td><?= $k['penerbit']; ?></td>
                    <td><?= $k['tahun_terbit']; ?></td>
                    <td><?= $k['isbn']; ?></td> -->
                    <td><?= $k['stok']; ?></td>
                </tr> 
            <?php   
        }   
        ?> 
            </tbody>
    </table>

    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>