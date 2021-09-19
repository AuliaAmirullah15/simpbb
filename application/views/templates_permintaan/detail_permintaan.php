<!DOCTYPE html>
<html lang="en">
<?php if($_SESSION['username'] == '') {
    redirect('Login');
}
    ?>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Star Admin Free Bootstrap Admin Dashboard Template</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo base_url('assets_s/vendors/iconfonts/mdi/css/materialdesignicons.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets_s/vendors/css/vendor.bundle.base.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets_s/vendors/css/vendor.bundle.addons.css');?>">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo base_url('assets_s/css/style.css');?>">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo base_url('assets_s/images/favicon.png');?>" />
    <style>
        .ripple a {
            color: white;
        }
        .bg-kategori {
            background: linear-gradient(120deg, #00e4d0, #5983e8);
            color: white;
            background-position: center;
            transition: background 1.5s;
        }
        
        .modal-header {
  padding: 2px 16px;
   background: linear-gradient(120deg, #00e4d0, #5983e8);
    color: white;
            padding : 10px 7px 10px 7px;
}
        .modal-title {
            float : left;
        }
        
        /* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
}

.close:hover,
.close:focus {
  color: #d209fa;
  text-decoration: none;
  cursor: pointer;
}
        
        /* Ripple effect */
.bg-kategori:hover {
  background: #5983e8 radial-gradient(circle, transparent 1%, #5983e8 1%) center/15000%;
   
}
.ripple:active {
  background-color: #6eb9f7;
  background-size: 100%;
  transition: background 0s;
}
    </style>
    
    <style>
    #notif {
    -moz-animation: cssAnimation 0s ease-in 5s forwards;
    /* Firefox */
    -webkit-animation: cssAnimation 0s ease-in 5s forwards;
    /* Safari and Chrome */
    -o-animation: cssAnimation 0s ease-in 5s forwards;
    /* Opera */
    animation: cssAnimation 0s ease-in 5s forwards;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
}
@keyframes cssAnimation {
    to {
        width:0;
        height:0;
        overflow:hidden;
    }
}
@-webkit-keyframes cssAnimation {
    to {
        width:0;
        height:0;
        visibility:hidden;
    }
    
    </style>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php $this->load->view('head_foot/header') ; ?>
    <!-- partial -->
   <?php $this->load->view('head_foot/menubar') ; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            
            <?php foreach($DPA as $d) {
            $id_DPA = $d->id_DPA;
            $id_sub_unit = $d->id_sub_unit;
            $DPA = $d->DPA;
            $bulan = $d->bulan;
            $tahun = $d->tahun;
            $status_validasi = $d->status_validasi;
            $id_kategori = $d->id_kategori;
            $nama_kategori = $d->nama_kategori;
    
} ?>
            
            
            <!-- CONTENT -->
            
             <?php if($message != '') { ?>
              <div class="section-body" id="notif">
						<div class="alert alert-info" role="alert">
                            <h6><?= $message ?></h6></div>
              </div>
            <?php } ?>
    
            <div class="row">
                <div class="col-sm-12">
                    <p><a href="<?php echo base_url('Permintaan/buat_permintaan') ; ?>">Kategori/<b><a href="#">Detail Permintaan</a></b></p>
                </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Detail Permintaan <?= $nama_kategori ?> </h4>
                  <p class="card-description">
                      <form method="post" action="<?php echo base_url('Permintaan/ubah_dpa/'. $id_DPA) ; ?>">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group row">
                          <label class="col-sm-5 col-form-label">Bulan</label>
                          <div class="col-sm-7">
                            <select class="form-control" name="bulan" id="bulan" disabled>
                              <option value="1" <?php if($bulan == '1') {echo "selected";} ?>>Januari</option>
                              <option value="2" <?php if($bulan == '2') {echo "selected";} ?>>Februari</option>
                              <option value="3" <?php if($bulan == '3') {echo "selected";} ?>>Maret</option>
                              <option value="4" <?php if($bulan == '4') {echo "selected";} ?>>April</option>
                              <option value="5" <?php if($bulan == '5') {echo "selected";} ?>>Mei</option>
                              <option value="6" <?php if($bulan == '6') {echo "selected";} ?>>Juni</option>
                              <option value="7" <?php if($bulan == '7') {echo "selected";} ?>>Juli</option>
                              <option value="8" <?php if($bulan == '8') {echo "selected";} ?>>Agustus</option>
                              <option value="9" <?php if($bulan == '9') {echo "selected";} ?>>September</option>
                              <option value="10" <?php if($bulan == '10') {echo "selected";} ?>>Oktober</option>
                              <option value="11" <?php if($bulan == '11') {echo "selected";} ?>>November</option>
                              <option value="12" <?php if($bulan == '12') {echo "selected";} ?>>Desember</option>
                            </select>
                          </div>
                        </div>
                      </div>
                       <div class="col-md-3">
                        <div class="form-group row">
                          <label class="col-sm-5 col-form-label">Tahun</label>
                          <div class="col-sm-7">
                              <input class="form-control" type="text" value="<?= $tahun ?>" name="tahun" id="tahun" disabled>
                          </div>
                        </div>
                      </div>
                        
                         <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">DPA</label>
                          <div class="col-sm-10">
                              <div class="input-group">
                          <div class="input-group-prepend bg-primary border-primary">
                            <span class="input-group-text bg-transparent text-white">Rp</span>
                          </div>
                       
                          <input type="number" placeholder="0" class="form-control rupiah" id="dpa" name="dpa" aria-label="Amount (to the nearest rupiah)" value = "<?= $DPA ?>">
                        </div>
                          </div>
                        </div>
                      </div>
                        
                        <div class="col-md-2">
                        <div class="form-group row">
                          <input type="submit" class="btn btn-primary" value="Ubah DPA">
                        </div>
                      </div>
                        
                        
                   
                          </div></form><hr>
                    
          
                         <div class="col-md-3">
                        <div class="form-group row">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah Data</button>
                        </div>
                      </div>
                
          
          
                  </p>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            #
                          </th>
                          <th>
                            Deskripsi
                          </th>
                          <th>
                            Kuantitas
                          </th>
                          <th>
                            Satuan
                          </th>
                          <th>
                            Harga Satuan
                          </th>
                         <th>
                            Harga Total
                          </th>
                        <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if($permintaan == null) { ?>
                            <tr><td colspan = '7'><center>Maaf, Tidak Ada Data</center></td></tr>
                        <?php } else { $sum = 0; $no = 1; foreach($permintaan as $p) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $p->permintaan ?></td>
                                <td><?= $p->kuantitas ?></td>
                                <td><?= $p->satuan ?></td>
                                <td><?php $harga_satuan = "Rp " . number_format($p->harga_satuan,2,',','.'); echo $harga_satuan; ?></td>
                                <td><?php $harga_total = "Rp " . number_format($p->harga_total,2,',','.'); echo $harga_total; ?></td>
                                <td><?php echo anchor('Permintaan/hapus_permintaan/'.$p->id_permintaan.'/'. $id_DPA,'<button class="btn btn-warning" title="Hapus" OnClick="return confirm(\'Yakin Ingin Menghapus Data ini ?\')">Hapus</button>',array('class'=>'hapus_permintaan',
						'onclick'=>"return confirmDialog('Yakin Ingin Menghapus Data Ini?');")

                                                                         ); ?></td>
                            </tr>
                          <?php $sum += $p->harga_total;} ?>
                          
                          <tr>
                              <td colspan='5'><center>TOTAL</center></td> <td><?php $total = "Rp " . number_format($sum,2,',','.'); echo $total; ?></td>
                              <td></td>
                         </tr>
                          
                          <tr>
                                
                              <td colspan="5"><center>Sisa</center></td> <td><?php $left = $DPA - $sum; $sisa = "Rp " . number_format($left,2,',','.'); echo $sisa; ?></td>
                              <td></td>
                          </tr>
                          <?php } ?>
                      </tbody>
                    </table>
                      
                  </div>
                </div>
              </div>
            </div>
            
              <!-- Modal -->
<div id="myModal" class="modal fade modal-lg" role="dialog">
  <div class="modal-dialog">
 <form method="post" action="<?php echo base_url('Permintaan/tambah_permintaan/'. $id_DPA); ?>">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Permintaan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>Kategori : <?= $nama_kategori ?></p>
          <hr>
          
          <div class="form-group row">
                          <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi">
                          </div>
         </div>
          
          <div class="form-group row">
            
                          <label for="kuantitas" class="col-sm-3 col-form-label">Kuantitas/Satuan</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="kuantitas" name="kuantitas" placeholder="0">
                          </div><div class="col-sm-6">
                            <input type="text" class="form-control" id="satuan" name="satuan" placeholder="kg">
                          </div>
         </div>
          
           <div class="form-group row">
            
                          <label for="kuantitas" class="col-sm-3 col-form-label">Harga Satuan</label>
                         
                <div class="col-sm-9">
                            <div class="input-group">
                          <div class="input-group-prepend bg-primary border-primary">
                            <span class="input-group-text bg-transparent text-white">Rp</span>
                          </div>
                      
                          <input type="number" placeholder="0" class="form-control rupiah" id="harga_satuan" name="harga_satuan" aria-label="Amount (to the nearest rupiah)">
                        </div>
                          </div>
         </div>
          
           <div class="form-group row">
            
                          <label for="kuantitas" class="col-sm-3 col-form-label">Harga Total</label>
                         
                <div class="col-sm-9">
                            <div class="input-group">
                          <div class="input-group-prepend bg-primary border-primary">
                            <span class="input-group-text bg-transparent text-white">Rp</span>
                          </div>
                      
                          <input type="number" placeholder="0" class="form-control rupiah" id="harga_total" name="harga_total" aria-label="Amount (to the nearest rupiah)">
                        </div>
                          </div>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" value="submit"/>
    </div>

  </div>
      </form>
</div>
    
            <!-- END CONTENT -->
        
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="<?php echo base_url('assets_s/vendors/js/vendor.bundle.base.js');?>"></script>
  <script src="<?php echo base_url('assets_s/vendors/js/vendor.bundle.addons.js');?>"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?php echo base_url('assets_s/js/off-canvas.js');?>"></script>
  <script src="<?php echo base_url('assets_s/js/misc.js');?>"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?php echo base_url('assets_s/js/dashboard.js');?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
 <script>
    $('input').keyup(function(){ // run anytime the value changes


    var firstValue = parseFloat($('#kuantitas').val()); // get value of field
    var secondValue = parseFloat($('#harga_satuan').val()); // convert it to a float
   
    
                    
    var sum = firstValue * secondValue;
    document.getElementById('harga_total').value = sum;
                    
                  
                    
});
    
    </script>

  <!-- End custom js for this page-->
</body>

</html>