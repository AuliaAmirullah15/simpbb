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
<!--
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
-->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets_s/css/DataTables/jquery.dataTables.css?1423553989');?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets_s/css/DataTables/extensions/dataTables.colVis.css?1423553990');?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets_s/css/DataTables/extensions/dataTables.tableTools.css?1423553990');?>" />
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
    
            <div class="col-lg-12 grid-margin stretch-card">
                
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?= $title ?></h4>
                  <p class="card-description">
                      
                
                
          
          
                  </p>
                    
                  <div class="table-responsive">
                    <table id="datatable1" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>
                            #
                          </th>
                            <?php if($_SESSION['level'] != '3') { ?>
                          <th>
                            Sub Unit
                          </th>
                            <?php } ?>
                          <th>
                            Bulan
                          </th>
                          <th>
                            Tahun
                          </th>
                            <?php if($_SESSION['level'] == '3' AND $status == 'asli') { ?>
                            
                                <th>Status Validasi</th>
                            <?php } ?>
                        <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if($data == null) { ?>
                            <tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                        <?php } else { $no = 1; foreach($data as $d) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <?php if($_SESSION['level'] != '3') { ?>
                                <td><?= $d->nama_sub_unit ?></td>
                                <?php } ?>
                                <td><?php switch($d->bulan) {
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
} ?></td>
                                <td><?= $d->tahun ?></td>
                                <?php if($_SESSION['level'] == '3' AND $status == 'asli') { ?>
                                
                                    <td><?php if($d->status_validasi == 'diajukan') {echo "Belum Divalidasi";} else { echo "Sudah Divalidasi"; } ?></td>
                                
                                <?php } ?>
                                <td><?php echo anchor('Permintaan/detail_rekap_permintaan/'.$status.'/'. $d->id_sub_unit.'/'. $d->bulan.'/'. $d->tahun,'<button class="btn btn-info" title="Detail")">Detail</button>',array('class'=>'detail_permintaan')

                                                                         ); ?></td>
                            </tr>
                         
                          <?php } } ?>
                      </tbody>
                    </table>
                      
                  </div>
                </div>
              </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!--
    <script>
        $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>
     <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
     <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
-->
    <script src="<?php echo base_url('assets_s/js/DataTables/jquery.dataTables.min.js');?>"></script>
		<script src="<?php echo base_url('assets_s/js/DataTables/extensions/ColVis/js/dataTables.colVis.min.js');?>"></script>
		<script src="<?php echo base_url('assets_s/js/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js');?>"></script>
		
		<script src="<?php echo base_url('assets_s/js/demo/DemoTableDynamic.js');?>"></script>

  <!-- End custom js for this page-->
</body>

</html>