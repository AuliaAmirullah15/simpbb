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
          <div class="row purchace-popup">
            <div class="col-12">
              <span class="d-block d-md-flex align-items-center">
                <h4>Kategori Permintaan</h4>
                
                
                <a class="btn ml-auto download-button d-none d-md-block purchase-button mt-4 mt-md-0" data-toggle="modal" data-target="#myModal">Tambah Kategori DPA Permintaan</a>
              </span>
              </span>
            </div>
          </div>
          <div class="row">
              
              <?php if($kategori != null) { $bulan = 0; $tahun = 0; foreach($kategori as $k) { if($bulan != $k->bulan OR $tahun != $k->tahun) { ?>
             
                <div class="col-sm-12"><h4><?php switch($k->bulan) {
    case '1' : echo "Januari "; $bln = "Januari"; break;
    case '2' : echo "Februari "; $bln = "Februari"; break;
    case '3' : echo "Maret "; $bln = "Maret";break;   
    case '4' : echo "April "; $bln = "April"; break;
        case '5' : echo "Mei "; $bln = "Mei"; break;
        case '6' : echo "Juni "; $bln = "Juni"; break;
        case '7' : echo "Juli "; $bln = "Juli"; break;
        case '8' : echo "Agustus "; $bln = "Agustus"; break;
        case '9' : echo "September "; $bln = "September";break;
        case '10' : echo "Oktober "; $bln = "Oktober"; break;
        case '11' : echo "November "; $bln = "November"; break;
        case '12' : echo "Desember "; $bln = "Desember"; break;
} echo $k->tahun; ?><span> <?php echo anchor('Permintaan/submit_permintaan/'.$k->bulan.'/'.$k->tahun,'<i class="mdi mdi-upload" title="Submit" OnClick="return confirm(\'Yakin Semua Permintaan Di Bulan '.$bln .' Tahun '. $k->tahun.' Sudah Dicek dan Siap Divalidasi? Laporan Permintaan Ini Akan Segera Divalidasi!\')"></i>',array('class'=>'submit_permintaan',
						'onclick'=>"return confirmDialog('Yakin Ingin Men-submit Data Ini?');")

                                                                         ); ?></span> <span><?php echo anchor('Permintaan/hapus_dpa_per_bulan/'.$k->bulan.'/'.$k->tahun,'<i class="mdi mdi-cancel" title="Hapus" OnClick="return confirm(\'Yakin Ingin Menghapus Semua Permintaan Di Bulan '.$bln .' Tahun '. $k->tahun.'? Data yang Sudah Diketik akan hilang!\')"></i>',array('class'=>'hapus_dpa_per_bulan',
						'onclick'=>"return confirmDialog('Yakin Ingin Menghapus Data Ini?');")

                                                                         ); ?></span></h4></div>
              
              
              <?php $bulan = $k->bulan; $tahun = $k->tahun; }  ?>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6 grid-margin stretch-card">
                
              <div class="card card-statistics bg-kategori ripple">
                  <a href="<?php echo base_url('Permintaan/detail_permintaan/'. $k->id_DPA); ?>">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                    <h3 class="font-weight-medium text-right mb-0"><i class="mdi mdi-cube text-info icon-lg"></i><?= $k->nama_kategori ?></h3>
                      
                       
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Total DPA</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php $DPA = "Rp " . number_format($k->DPA,2,',','.'); echo $DPA; ?></h3>
                      </div>
                    </div>
                  </div>
                </div>
                  </a>
              </div>
            </div>
             
              <?php } } else { ?>
                    
                    <center><h4>Maaf, Belum Ada Kategori Permintaan Yang Ditambah</h4></center>
                    
                <?php } ?>
          </div>
          
          <hr>
         
        <div class="row">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-info mr-2" data-toggle="modal" data-target="#myModal">Tambah Kategori DPA Permintaan</button>
            </div>
        </div>
          
          
          <!---- MODAL POPUP -->
          
          <!-- Modal -->
<div id="myModal" class="modal fade modal-lg" role="dialog">
  <div class="modal-dialog">
 <form method="post" action="<?php echo base_url('Permintaan/tambah_kategori_permintaan'); ?>">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Kategori DPA Per Bulan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        
          <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Bulan</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="bulan" id="bulan" onchange="showKategori(this.value)">
                              <option value="0">Pilih Bulan</option>
                              <option value="1">Januari</option>
                              <option value="2">Februari</option>
                              <option value="3">Maret</option>
                              <option value="4">April</option>
                              <option value="5">Mei</option>
                              <option value="6">Juni</option>
                              <option value="7">Juli</option>
                              <option value="8">Agustus</option>
                              <option value="9">September</option>
                              <option value="10">Oktober</option>
                              <option value="11">November</option>
                              <option value="12">Desember</option>
                            </select>
                          </div>
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Tahun</label>
                          <div class="col-sm-9">
                              <?php  $date_array = getdate(); $tahun = $date_array['year']; $bulan = $date_array['mon']; ?>
                            <select class="form-control" name="tahun" id="tahun" onchange="showKategori(this.value)">
                                <option value="<?= $tahun ?>"><?= $tahun ?></option>
                                <?php if($bulan == 12) { $tahun += 1; ?>
                                <option value="<?= $tahun ?>"><?= $tahun ?></option>
                                <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
            </div>
          <hr>
          <div class="row">
              <h4>DPA Per Kategori</h4>
          </div>
                <div id="dpa">
                <?php foreach($all_kategori as $ak) { ?>
                <div class="col-md-12">
                    <div class="form-group row">
                          <label class="col-sm-6 col-form-label"><?= $ak->nama_kategori ?></label>
                          <div class="col-sm-6">
                            <div class="input-group">
                          <div class="input-group-prepend bg-primary border-primary">
                            <span class="input-group-text bg-transparent text-white">Rp</span>
                          </div>
                        <input type="hidden" name="id_kategori_permintaan[]" value="<?= $ak->id_kategori ?>">
                          <input type="number" placeholder="0" class="form-control rupiah" id="dpa_kategori" name="dpa_kategori[]" aria-label="Amount (to the nearest rupiah)" value="<?= $ak->biaya ?>" disabled>
                        </div>
                          </div>
                        </div>
                </div>
                <?php } ?>
                </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" value="submit"/>
    </div>

  </div>
      </form>
</div>
          
          <!---- MODAL POPUP -->
          </div>
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
 <script>
function showKategori(str) {
    var bulan = $('#bulan').val();
    var tahun = $('#tahun').val();
    
    if (bulan != "0") {
        $(".rupiah").prop('disabled', false);
    } else { 
       $(".rupiah").prop('disabled', true);
    }
}
</script>

  <!-- End custom js for this page-->
</body>

</html>