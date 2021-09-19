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
    
    <style>
        body {
            font: 14px calibri;
        }
        table {
            border-spacing: 0px;
        }
        th {
            padding: 5px;
        }
    
    </style>
</head>

<body>
            
          
           
             <?php $nama_kategori = ''; foreach($kategori as $k) { ?>
            <div class="col-lg-12 grid-margin stretch-card" style="font:Calibri">
                
                
               
              <div class="card">
                <div class="card-body">
                  
                        <h4 class="card-title"><?= $k->nama_kategori ?> <span><p style="float:right"><?= $DPA = "Rp " . number_format($k->DPA,2,',','.'); ?></p></span> </h4>
                   
                  
                
                  <div class="table-responsive">
                    <table class="table table-bordered" border="1" >
                      <thead>
                        <tr>
                          <th width="5%">
                            #
                          </th>
                          <th width="30%">
                            Deskripsi
                          </th>
                          <th width="15%">
                            Kuantitas
                          </th>
                          <th width="20%">
                            Satuan
                          </th>
                          <th width="15%">
                            Harga Satuan
                          </th>
                         <th width="15%">
                            Harga Total
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                         
                          <?php $sum = 0; $no = 1; foreach($data as $d) { if(($k->id_kategori == $d->id_kategori) AND ($d->permintaan != NULL)) { ?>
                          
                            <tr>
                                <td width="5%"><?= $no++ ?></td>
                                <td width="30%"><?= $d->permintaan ?></td>
                                <td width="15%"><?= $d->kuantitas ?></td>
                                <td width="20%"><?= $d->satuan ?></td>
                                <td width="15%"><?php $harga_satuan = "Rp " . number_format($d->harga_satuan,2,',','.'); echo $harga_satuan; ?></td>
                                <td width="15%"><?php $harga_total = "Rp " . number_format($d->harga_total,2,',','.'); echo $harga_total; ?></td>
                               
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