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
                <h4>Sub Unit Yang Mengajukan Permintaan</h4>
                
                
               
              </span>
              </span>
            </div>
          </div>
          <div class="row">
              
              <?php if($data != null) { foreach($data as $k) { 
    switch($k->bulan) {
    case '1' : $bln = "Januari"; break;
    case '2' : $bln = "Februari"; break;
    case '3' : $bln = "Maret";break;   
    case '4' : $bln = "April"; break;
        case '5' : $bln = "Mei"; break;
        case '6' : $bln = "Juni"; break;
        case '7' : $bln = "Juli"; break;
        case '8' : $bln = "Agustus"; break;
        case '9' : $bln = "September";break;
        case '10' : $bln = "Oktober"; break;
        case '11' : $bln = "November"; break;
        case '12' : $bln = "Desember"; break;
}  ?> 
              
              
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6 grid-margin stretch-card">
                
              <div class="card card-statistics bg-kategori ripple">
                  <a href="<?php echo base_url('Permintaan/edit_validasi_permintaan/'. $k->id_sub_unit.'/'. $k->bulan.'/'. $k->tahun); ?>">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                    <h3 class="font-weight-medium text-right mb-0"><i class="mdi mdi-cube text-info icon-lg"></i><?= $k->nama_sub_unit ?></h3>
                      
                       
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right"><?= $bln ?></p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?= $k->tahun ?></h3>
                      </div>
                    </div>
                  </div>
                </div>
                  </a>
              </div>
            </div>
             
              <?php } } else { ?>
                    
                    <center><h4>Maaf, Belum Ada Sub Unit Yang Melaporkan Permintaan</h4></center>
                    
                <?php } ?>
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