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
            
            <!-- CONTENT -->
            
            <div class="row">
                <div class="col-sm-8">
                    <?php if($status == 'asli') { ?>
                    <p><a href="<?php echo base_url('Permintaan/permintaan_asli') ; ?>">Permintaan Asli</a>/<b><a href="#">Detail Permintaan Asli</a></b></p>
                        <?php } else { ?>
                         <p><a href="<?php echo base_url('Permintaan/permintaan_divalidasi') ; ?>">Permintaan Sudah Divalidasi</a>/<b><a href="#">Detail Permintaan Validasi</a></b>
                    <?php } ?>
                </div>
                
                <div class="col-sm-4">
                    <div style="margin-right: 12px">
                        <a href="<?php echo base_url('Permintaan/detail_rekap_permintaan/'. $status.'/'. $id_sub_unit.'/'. $bulan .'/'. $tahun .'/print'); ?>"><button style="float:right; margin-bottom:10px" class="btn btn-primary">PRINT</button></a>
                    </div>
                </div>
            </div>
           
             <?php $nama_kategori = ''; foreach($kategori as $k) { ?>
            <div class="col-lg-12 grid-margin stretch-card">
                
                
               
              <div class="card">
                <div class="card-body">
                  
                        <h4 class="card-title"><?= $k->nama_kategori ?> <span><p style="float:right"><?= $DPA = "Rp " . number_format($k->DPA,2,',','.'); ?></p></span> </h4>
                   
                  
                
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
                        </tr>
                      </thead>
                      <tbody>
                         
                          <?php $sum = 0; $no = 1; foreach($data as $d) { if(($k->id_kategori == $d->id_kategori) AND ($d->permintaan != NULL)) { ?>
                          
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $d->permintaan ?></td>
                                <td><?= $d->kuantitas ?></td>
                                <td><?= $d->satuan ?></td>
                                <td><?php $harga_satuan = "Rp " . number_format($d->harga_satuan,2,',','.'); echo $harga_satuan; ?></td>
                                <td><?php $harga_total = "Rp " . number_format($d->harga_total,2,',','.'); echo $harga_total; ?></td>
                               
                            </tr>
                          <?php $sum += $d->harga_total; } } ?>
                          
                          
                          <tr>
                              <td colspan='5'><center>TOTAL</center></td> <td><?php $total = "Rp " . number_format($sum,2,',','.'); echo $total; ?></td>
                         
                         </tr>
                          
                          <tr>
                                
                              <td colspan="5"><center>Sisa</center></td> <td><?php $left = $k->DPA - $sum; $sisa = "Rp " . number_format($left,2,',','.'); echo $sisa; ?></td>
                            
                          </tr>
                      </tbody>
                    </table>
                      
                  </div>
                </div>
                
              </div>
           
            
            
            
            </div>
            
             <?php } ?>

            
             
        
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


  <!-- End custom js for this page-->
</body>

</html>