<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Form Ubah Data Anggota
                </div>
                <div class="card-body">
                    <form class="" method="post" action="<?= base_url('user/ubahprofil'); ?>">
                    <input type="hidden" name="id" value="<?= $user['id']; ?>">     
                    <!-- <input type="hidden" name="id" value="<?= $a['id']; ?>">  -->
                        <div class="form-group row"> 
                        <label for="email" class="col-sm-2 col-form-label">Email</label> 
                            <div class="col-sm-10"> 
                                <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly> 
                            </div> 
                        </div> 
                        
                        <div class="form-group row"> 
                        <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label> 
                            <div class="col-sm-10"> 
                                <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>"> 
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?> 
                            </div> 
                        </div> 
                        
                        <div class="form-group row"> 
                        <div class="col-sm-2">Gambar</div> 
                            <div class="col-sm-10"> 
                                <div class="row"> 
                                    <div class="col-sm-3"> 
                                        <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail" alt=""> 
                                    </div> 
                                    
                                    <div class="col-sm-9"> 
                                        <div class="custom-file"> 
                                            <input type="file" class="custom-file-input" id="image" name="image"> 
                                            <label class="custom-file-label" for="image">Pilih file</label>
                                        </div> 
                                    </div> 
                                </div> 
                            </div> 
                        </div>  
                        <button type="submit" class="btn btn-primary btn-user btn-block"> Ubah </button> 
                    </form> 
                </div>
            </div> 
        </div>
    </div> 
</div>
