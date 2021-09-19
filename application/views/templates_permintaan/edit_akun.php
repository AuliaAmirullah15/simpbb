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
     <?php if($message != '') { ?>
              <div class="section-body" id="notif">
						<div class="alert alert-info" role="alert">
                            <h6><?= $message ?></h6></div>
              </div>
            <?php } ?>
            
            <div class="col-lg-12 grid-margin stretch-card">
                
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?= $title ?></h4>
                  <p class="card-description">
                      
                
                <?php if($level_pengguna == '1') {
                            foreach($data as $d){
                                $nama_user = $d->nama_user;
                                $username = $d->username;
                                $password = $d->password;
                                $level = $d->level;
                                $id_user = $d->id_user;
                            }
                        }
                      else {
                          foreach($data as $d){
                                $nama_user = $d->nama_user;
                                $username = $d->username;
                                $password = $d->password;
                                $level_user = $d->level_pengguna;
                                $id_user = $d->id_user;
                                $id_sub_unit = $d->id_sub_unit;
                                $level_cabang = $d->level_cabang;
                            }
                      } ?>
          
          
                  </p>
                    
                     <form class="forms-sample" method="post" action="<?php echo base_url('Permintaan/update_akun/'. $id_user.'/'. $username.'/'.$password.'/'. $level_pengguna) ; ?>">
                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Nama User</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Nama User" name="nama_user" value="<?= $nama_user ?>">
                          </div>
                        </div>
                         
                         <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Username</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputEmail2" placeholder="username" name="username" value="<?= $username ?>">
                          </div>
                        </div>
                         
                        <div class="form-group row">
                          <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password Baru</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" name="password">
                          </div>
                        </div>
                         
                         <?php if($level_pengguna != '1') { ?>
                         <div class="form-group row">
                          <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Level Pengguna</label>
                          <div class="col-md-9">
                        <div class="form-group">
                          <div class="form-radio">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="level_pengguna" id="optionsRadios1" value="2" <?php if($level_user== '2') { echo "checked";} ?>> Validator
                            </label>
                          </div>
                          <div class="form-radio">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="level_pengguna" id="optionsRadios2" value="3" <?php if($level_user == '3') { echo "checked";} ?>> Sub Unit
                            </label>
                          </div>
                        </div>
                        
                        </div>
                         </div>
                             
                             
                             <div class="form-group row">
                          <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Level Cabang</label>
                          <div class="col-md-9">
                        <div class="form-group">
                          <div class="form-radio">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="level_cabang" id="optionsRadios1" value="Fakultas" <?php if($level_cabang == 'Fakultas') { echo "checked";} ?>> Fakultas
                            </label>
                          </div>
                          <div class="form-radio">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="level_cabang" id="optionsRadios2" value="S1" <?php if($level_cabang == 'S1') { echo "checked";} ?>> S1
                            </label>
                          </div>
                             <div class="form-radio">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="level_cabang" id="optionsRadios2" value="S2" <?php if($level_cabang == 'S2') { echo "checked";} ?>> S2
                            </label>
                          </div>
                             <div class="form-radio">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="level_cabang" id="optionsRadios2" value="S3" <?php if($level_cabang == 'S3') { echo "checked";} ?>> S3
                            </label>
                          </div>
                        </div>
                        
                        </div>
                         </div>
                         <?php } ?>
                         
                         
                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                      </form>
                    
                 
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
    <script>
        // data-* attributes to scan when populating modal values
var ATTRIBUTES = ['value1', 'value2', 'value3'];

$('[data-toggle="modal"]').on('click', function (e) {
  // convert target (e.g. the button) to jquery object
  var $target = $(e.target);
  // modal targeted by the button
  var modalSelector = $target.data('target');
  
  // iterate over each possible data-* attribute
  ATTRIBUTES.forEach(function (attributeName) {
    // retrieve the dom element corresponding to current attribute
    var $modalAttribute = $(modalSelector + ' #modal-' + attributeName);
    var dataValue = $target.data(attributeName);
    
    // if the attribute value is empty, $target.data() will return undefined.
    // In JS boolean expressions return operands and are not coerced into
    // booleans. That way is dataValue is undefined, the left part of the following
    // Boolean expression evaluate to false and the empty string will be returned
    $modalAttribute.text(dataValue || '');
  });
});
    
    </script>

  <!-- End custom js for this page-->
</body>

</html>