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
                      
                
                
          
          
                  </p>
                    
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <?php if($jenis == 'kategori') { ?>
                      <thead>
                        <tr>
                          <th>
                            #
                          </th>
                           
                          <th>
                            Nama Kategori
                          </th>
                          <th>
                            Tanggal Pembuatan
                          </th>
                          <th>
                            Biaya
                          </th>
                           
                        <th>Action</th>
                        </tr>
                      </thead>
                        <?php } else { ?>
                        
                        <thead>
                        <tr>
                          <th>
                            #
                          </th>
                           
                          <th>
                            Nama Pengguna
                          </th>
                          <th>
                            Username
                          </th>
                           
                            <th>
                                Level Pengguna
                            </th>
                            
                            <th>
                                Unit Cabang
                            </th>
                        <th>Action</th>
                        </tr>
                      </thead>
                        
                        
                        <?php } ?>
                      <tbody>
                          
                          <?php if($data != '') { ?>
                        <?php if($jenis == 'kategori') { $no = 1; foreach($data as $d) { ?>
                          
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $d->nama_kategori ?></td>
                                <td><?= $d->tgl_pembuatan ?></td>
                                <td>Rp. <?= $d->biaya ?></td>
                                <td><?php echo anchor('Permintaan/edit_kategori/'. $d->id_kategori,'<button class="btn btn-primary" title="Edit" >Edit</button>',array('class'=>'edit_kategori')

                                                                         ); ?>
                                
                                 <?php echo anchor('Permintaan/delete_kategori/'. $d->id_kategori,'<button class="btn btn-warning" title="Hapus" OnClick="return confirm(\'Yakin Ingin Menghapus Data ini ? Data Yang Bersangkutan Dengan Kategori Ini Akan Hilang! \')">Hapus</button>',array('class'=>'delete_kategori',
						'onclick'=>"return confirmDialog('Yakin Ingin Menghapus?');")

                                                                         ); ?>
                                </td>
                            </tr>
                            
                          
                          <?php } } else { $no = 1; foreach($data as $d) { ?>
                          
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $d->nama_user ?></td>
                                <td><?= $d->username ?></td>
                                <td><?php switch($d->level_pengguna) {
    case '1' : echo "Wakil Dekan II"; break;
    case '2' : echo "Sub Unit/Validator"; break;
    case '3' : echo "Sub Unit"; break;
} ?></td>
                                <td><?= $d->level_cabang ?></td>
                                <td><a href="<?php echo base_url('Permintaan/edit_akun/'. $d->username.'/'.$d->password.'/'. $d->level_pengguna); ?>"><button class="btn btn-primary">Edit</button></a>
                                
                                    <?php echo anchor('Permintaan/delete_akun/'. $d->username.'/'.$d->password.'/'. $d->level_pengguna,'<button class="btn btn-warning" title="Hapus" OnClick="return confirm(\'Yakin Ingin Menghapus Data ini ? Data Yang Bersangkutan Dengan Akun Ini Akan Hilang! \')">Hapus</button>',array('class'=>'delete_akun',
						'onclick'=>"return confirmDialog('Yakin Ingin Menghapus?');")

                                                                         ); ?>
                                </td>
                            </tr>
                          
                          
                          <?php } } } else { if($jenis == 'kategori') {?>
                          
                          <tr>
                              <td colspan="4"><center>Maaf, Tidak Ada Data</center></td>
                          </tr>
                          
                          <?php } else { ?>
                           <tr>
                              <td colspan="6"><center>Maaf, Tidak Ada Data</center></td>
                          </tr>
                          
                          <?php }} ?>
                          
                      </tbody>
                    </table>
                      
                     
                  </div>
                     <button class="btn btn-success" data-toggle="modal" data-target="<?php if($jenis == 'kategori') {echo "#ModalKategori";} else {echo "#ModalUser";} ?>" ><?php if($jenis == 'kategori') {echo "Tambah Kategori"; } else {echo "Tambah Akun";} ?></button>
                </div>
                  
              </div>
            </div>
            
          </div>
          
          
          <!---- MODAL POPUP EDIT KATEGORI-->
          
          <!-- Modal -->
<div id="EditKategori" class="modal fade modal-lg" role="dialog">
  <div class="modal-dialog">
 <form method="post" action="<?php echo base_url('Permintaan/update_kategori'); ?>">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Kategori</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        
          <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Kategori</label>
                          <div class="col-sm-9">
                            <input type="text" name="nama_kategori" id="modal-value2" class="form-control">
                          </div>
                        </div>
                      </div>
                      
            </div>
         
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" value="Edit"/>
    </div>

  </div>
      </form>
    </div></div>
          
          <!---- MODAL POPUP EDIT KATEGORI -->
          
          
              <!---- MODAL POPUP TAMBAH KATEGORI-->
          
          <!-- Modal -->
<div id="ModalKategori" class="modal fade modal-lg" role="dialog">
  <div class="modal-dialog">
 <form method="post" action="<?php echo base_url('Permintaan/tambah_kategori'); ?>">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Kategori</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        
          <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Kategori</label>
                          <div class="col-sm-9">
                            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control">
                          </div>
                        </div>
                      </div>
                      
            </div>
         
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" value="Tambah"/>
    </div>

  </div>
      </form>
    </div></div>
          
          <!---- MODAL POPUP TAMBAH KATEGORI -->
          
          
          
          
          
          
                        <!---- MODAL POPUP TAMBAH USER -->
          
          <!-- Modal -->
<div id="ModalUser" class="modal fade modal-lg" role="dialog">
  <div class="modal-dialog">
 <form method="post" action="<?php echo base_url('Permintaan/tambah_user'); ?>">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Pengguna</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        
          <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Pengguna</label>
                          <div class="col-sm-9">
                            <input type="text" name="nama_user" id="nama_user" class="form-control">
                          </div>
                        </div>
                      </div>
            </div>
          
           <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Username</label>
                          <div class="col-sm-9">
                            <input type="text" name="username" id="username" class="form-control">
                          </div>
                        </div>
                      </div>
            </div>
          
           <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Password</label>
                          <div class="col-sm-9">
                            <input type="text" name="password" id="password" class="form-control">
                          </div>
                        </div>
                      </div>
            </div>
          
          <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Level Pengguna</label>
                          <div class="col-sm-9">
                          <div class="col-sm-4">
                            <div class="form-radio">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="level_user" id="level_user" value="2"> Validator
                              </label>
                            </div>
                          </div>
                              
                              <div class="col-sm-4">
                            <div class="form-radio">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="level_user" id="level_user" value="3"> Sub Unit
                              </label>
                            </div>
                          </div>
                          </div>
                        </div>
                      </div>
            </div>
          
          <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Level Cabang</label>
                          <div class="col-sm-9">
                            <div class="col-sm-3">
                            <div class="form-radio">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="level_cabang" id="level_cabang" value="Fakultas" checked> Fakultas
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-radio">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="level_cabang" id="level_cabang" value="S1" checked> S1
                              </label>
                            </div>
                          </div>
                              
                              <div class="col-sm-3">
                            <div class="form-radio">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="level_cabang" id="level_cabang" value="S2" checked> S2
                              </label>
                            </div>
                          </div>
                              
                              <div class="col-sm-3">
                            <div class="form-radio">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="level_cabang" id="level_cabang" value="S3" checked> S3
                              </label>
                            </div>
                          </div>
                          </div>
                        </div>
                      </div>
            </div>
          
          
         
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" value="Tambah"/>
    </div>

  </div>
      </form>
    </div></div>
          
          <!---- MODAL POPUP TAMBAH USER-->
          
          
          
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