<style>
    .disappear_underline:hover {
        text-decoration: none;
    }
</style> 


<div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                <?php if($_SESSION['level'] == '1') { ?>
                  <img src="<?php echo base_url('assets_s/images/people/002-man.png');?>" alt="profile image">
                <?php } else if($_SESSION['level'] == '2') { ?>
                    <img src="<?php echo base_url('assets_s/images/people/001-man-1.png');?>" alt="profile image">
                <?php } else { ?>
                     <img src="<?php echo base_url('assets_s/images/people/003-team.png');?>" alt="profile image">
                <?php } ?>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name"><?= $_SESSION['nama_user'] ?></p>
                  <div>
                    <small class="designation text-muted"> <?php if($_SESSION['level'] == '1') { ?>
                 Wakil Dekan II
                <?php } else if($_SESSION['level'] == '2') { ?>
                   Validator/Sub Unit
                <?php } else { ?>
                    Sub Unit
                <?php } ?></small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
                
                <?php if($_SESSION['level'] == '2' OR $_SESSION['level'] == '3') { ?>
              <a class="disappear_underline" href="<?php echo base_url('Permintaan/buat_permintaan'); ?>"><button class="btn btn-success btn-block">Buat Permintaan
                <i class="mdi mdi-plus"></i>
            </button></a>
                <?php } ?>
                
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('Permintaan/index') ; ?>">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title">Permintaan Unit</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url('Permintaan/permintaan_asli'); ?>">Permintaan Asli</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url('Permintaan/permintaan_divalidasi'); ?>">Sudah Divalidasi</a>
                </li>
              </ul>
            </div>
          </li>
            
            <?php if($_SESSION['level'] == '1' OR $_SESSION['level'] == '2') { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('Permintaan/validasi_permintaan'); ?>">
              <i class="menu-icon mdi mdi-backup-restore"></i>
              <span class="menu-title">Validasi Permintaan</span>
            </a>
          </li>
            <?php } ?>
            
            <?php if($_SESSION['level'] == '2') { ?>
            
            <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#setting" aria-expanded="false" aria-controls="setting">
              <i class="menu-icon mdi mdi-restart"></i>
              <span class="menu-title">Setting</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="setting">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url('Permintaan/setting/kategori'); ?>">Kategori DPA</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url('Permintaan/setting/akun'); ?>">Akun</a>
                </li>
              </ul>
            </div>
          </li>
            
            <?php } ?>
<!--
          <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartjs.html">
              <i class="menu-icon mdi mdi-chart-line"></i>
              <span class="menu-title">Laporan</span>
            </a>
          </li>
-->
          
        </ul>
      </nav>