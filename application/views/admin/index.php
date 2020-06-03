<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- Content Kotak Atas -->
    <div class="row">

        <!-- Jumlah Anggota -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Anggota</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $this->User_model->getUserWhere(['role_id' => 2])->num_rows(); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stok Kamar Terdaftar -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Kamar Tersedia</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php 
                                    $where = ['stok != 0']; 
                                    $totalstok = $this->Kamar_model->total('stok', $where); 
                                    echo $totalstok; 
                                ?> 
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bed fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Check-in -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Check-in</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php 
                                    $where = ['check_in != 0']; 
                                    $totaldipinjam = $this->Kamar_model->total('check_in', $where); 
                                    echo $totaldipinjam; 
                                ?> 
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-minus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kamar Dibooking -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Check-out</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php 
                                    $where = ['check_out !=0']; 
                                    $totaldibooking = $this->Kamar_model->total('check_out', $where); 
                                    echo $totaldibooking; 
                                ?> 
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content Kotak Atas -->

    <!-- Content User -->
    <div class="row">
        <div class="table-responsive table-bordered col-lg mt-3">
            
            <div class="page-header"> 
                <span class="fas fa-users text-primary mt-2 "> Data User</span> 
            </div> 

            <table class="table mt-3"> 
                <thead> 
                    <tr> 
                        <th>#</th> 
                        <th>Nama Anggota</th> 
                        <th>Email</th> 
                        <th>Aktif</th> 
                        <th>Member Sejak</th> 
                    </tr> 
                </thead> 

                <tbody> 
                    <?php 
                    $i = 1; 
                    foreach ($anggota as $a) { ?> 
                    <tr> 
                        <td><?= $i++; ?></td>
                        <td><?= ucwords($a['name']); ?></td> 
                        <td><?= $a['email']; ?></td> 
                        <td><?= $a['is_active']; ?></td> 
                        <td><?= date('d F Y', $a['date_created']); ?></td> 
                    </tr> 
                    <?php } ?> 
                </tbody> 
            </table>

        </div>
    </div>
    <!-- End Content User -->

    <!-- Content Book -->
    <div class="row">
        <div class="table-responsive table-bordered col-lg mt-5"> 
            <div class="page-header"> 
                <span class="fas fa-book text-warning mt-2"> Data Kamar</span> 
            </div> 

            <div class="table-responsive"> 
                <table class="table mt-3" id="table-datatable"> 
                    <thead> 
                        <tr> 
                            <th>#</th> 
                            <th>Type Kamar</th> 
                            <th>Harga</th> 
                            <th>Tersedia</th> 
                            <th>Check-out</th> 
                            <th>Check-in</th> 
                            <!-- <th>Stok</th>  -->
                            <!-- <th>Dipinjam</th>  -->
                            <th>image</th> 
                        </tr> 
                    </thead> 
                
                    <tbody> 
                        <?php
                        $i = 1; 
                        foreach ($kamar as $k) { ?> 
                        <tr> 
                            <td><?= $i++; ?></td> 
                            <td><?= $k['type_kamar']; ?></td> 
                            <td><?= $k['harga']; ?></td> 
                            <td><?= $k['stok']; ?></td>
                            <td><?= $k['check_in']; ?></td> 
                            <td><?= $k['check_out']; ?></td> 
                            <td>
                            	<picture>
			                      <source srcset="" type="image/svg+xml">
			                      <img src="<?= base_url('assets/img/upload/') . $k['image']; ?>" class="img-fluid img-thumbnail" alt="..." style="width:60px;height:80px;">
			                	</picture>
                            </td> 
                            <!-- <td><?= $k['dipinjam']; ?></td>  -->
                            <!-- <td><?= $k['dibooking']; ?></td>  -->
                            </tr> 
                        <?php } ?> 
                    </tbody> 
                </table> 
                
            </div> 
        </div>
    </div>
    <!-- End Content Book -->



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 