<!-- start carousel -->
<div class="container mb-5">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/img/upload/deluxe.jpg" height="400" class="d-block w-100" alt="...">
                <!-- <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div> -->
            </div>
            <div class="carousel-item">
                <img src="assets/img/upload/deluxe.jpg" height="400" class="d-block w-100" alt="...">
                <!-- <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div> -->
            </div>
            <div class="carousel-item">
                <img src="assets/img/upload/deluxe.jpg" height="400" class="d-block w-100" alt="...">
                <!-- <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div> -->
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<!-- akhir carousel -->

<!-- konten -->
    <section class="content mb-5">
        <div class="container mt-3" id="content">
            <div class="row">
                <div class="col align-self-center">
                    <h1 class="mb-3">
                        Hotel Permata
                    </h1>
                    <p class="mb-4">
                        Permata Convention Hotel is a business and leisure hotel in Bogor. Sitting amidst lush greenery, it is strategically located opposite the famous Bogor Botanical Garden and Presidential Palace, minutes away from factory outlets and the biggest mall in Bogor, Botani Square.
                    </p>
                </div>
                <div class="col d-none d-sm-block">
                    <img src="assets/img/logo/permata-logo.png" width="500px" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- akhir konten -->

<?= $this->session->flashdata('pesan'); ?>

<div class="container">
    <div class="row">
        <!-- looping products -->
        <?php foreach ($kamar as $kamar) { ?>
            <div class="col-md-2 col-md-3">
                <div class="thumbnail" style="height: 370px;">
                    <img src="<?php echo base_url(); ?>assets/img/upload/<?= $kamar->image; ?>" style="max-width:100%; max-height: 100%; height: 200px; width: 180px">
                    <div class="caption">
                        <h5 style="min-height:30px;"><?= $kamar->type_kamar ?></h5>
                        <h6><?= $kamar->harga ?></h6>
                        <!-- <h6><?= substr($kamar->tahun_terbit, 0, 4) ?></h6> -->
                        <p>
                            <?php
                            if ($kamar->stok < 1) {
                                echo "<i class='disable btn btn-outline-primary fas fw fa-meteor'> Stok Kosong</i>";
                            } else {
                                echo "<a class='btn btn-outline-primary fas fw fa-shopping-cart' href='" . base_url('booking/tambahBooking/' . $kamar->id) . "'> Booking</a>";
                            }
                            ?>
                            <a class="btn btn-outline-warning fas fw fa-search" href="<?= base_url('home/detailKamar/' . $kamar->id); ?>"> Detail</a></p>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- end looping -->
    </div>
</div>