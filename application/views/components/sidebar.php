<?php
     $activeIDUser  =    $this->session->userdata('idUser');
     $isLogin       =    ($activeIDUser === null)? false : true;

     if($isLogin){

          $this->db->where('idUser', $activeIDUser);
          $detailActiveUser   =    $this->db->get('ts_user')->row_array();
     }
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="index3.html" class="brand-link">
          <img src="<?=base_url('assets/img/icon.png')?>" alt="Tabungan Sekolah Logo" 
               class="brand-image img-circle elevation-3" style="opacity: .8" />
          <span class="brand-text font-weight-light">Tabungan Sekolah</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
               <div class="image">
                    <?php if($isLogin){ ?>
                         <img src="<?=base_url('assets/img/')?><?=$detailActiveUser['level']?>.png" class="img-circle" 
                              alt="User Image" style='width:3.5rem !important;'>
                    <?php }else{ ?>
                         <img src="<?=base_url('assets/img/student.png')?>" class="img-circle" 
                              alt="Student Image" style='width:3.5rem !important;'>
                    <?php } ?>
               </div>
               <div class="info">
                    <a href="#" class="d-block text-white"><?=($isLogin)? $detailActiveUser['nama'] : 'Free User'?></a>
                    <p class="mb-0 text-sm text-<?=($isLogin)? (strtolower($detailActiveUser['level']) === 'superadmin')? 'warning' : 'white' : 'white'?>">
                         <?=($isLogin)? $detailActiveUser['level'] : 'User Bebas'?>
                    </p>
                    
               </div>
          </div>
          
          <?php if($isLogin){ ?>
               <!-- Sidebar Menu -->
               <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                         <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                         <li class="nav-item">
                              <!-- tambahkan kelas menu-open untuk membuka slider dibawahnya -->
                              <a href="<?=site_url('welcome')?>" class="nav-link <?=(strtolower($this->uri->segment(1)) === 'welcome')? 'active' : ''?>">
                                   <i class="nav-icon fas fa-tv"></i>
                                   <p>
                                        Welcome Screen
                                   </p>
                              </a>
                         </li>
                         <li class="nav-header">Master Data</li>
                         <li class="nav-item">
                              <a href="<?=site_url('kelas')?>" class="nav-link <?=(strtolower($this->uri->segment(1)) === 'kelas')? 'active' : ''?>">
                                   <i class="nav-icon fas fa-home text-success"></i>
                                   <p>Kelas</p>
                              </a>
                         </li>
                         <li class="nav-item has-treeview">
                              <a href="<?=site_url('sekolah')?>" class="nav-link <?=(strtolower($this->uri->segment(1)) === 'sekolah')? 'active' : ''?>">
                                   <i class="nav-icon fas fa-school text-warning"></i>
                                   <p>
                                        Sekolah
                                        <i class="right fas fa-angle-left"></i>
                                   </p>
                              </a>
                              <ul class="nav nav-treeview">
                                   <?php if($detailActiveUser['level'] === 'superadmin'){ ?>
                                        <li class="nav-item">
                                             <a href="<?=site_url('sekolah/add')?>" class="nav-link">
                                                  <i class="fas fa-plus nav-icon"></i>
                                                  <p>Tambah Sekolah Baru</p>
                                             </a>
                                        </li>
                                   <?php } ?>
                                   <li class="nav-item">
                                        <a href="<?=site_url('sekolah/listsekolah')?>" class="nav-link">
                                             <i class="fas fa-list nav-icon"></i>
                                             <p>List Sekolah</p>
                                        </a>
                                   </li>
                              </ul>
                         </li>
                         <li class="nav-item has-treeview">
                              <a href="<?=site_url('siswa')?>" class="nav-link <?=(strtolower($this->uri->segment(1)) === 'siswa')? 'active' : ''?>">
                                   <i class="nav-icon fas fa-users text-info"></i>
                                   <p>
                                        Siswa
                                        <i class="right fas fa-angle-left"></i>
                                   </p>
                              </a>
                              <ul class="nav nav-treeview">
                                   <li class="nav-item">
                                        <a href="<?=site_url('siswa/add')?>" class="nav-link">
                                             <i class="fas fa-plus nav-icon"></i>
                                             <p>Tambah Siswa Baru</p>
                                        </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="<?=site_url('siswa/listsiswa')?>" class="nav-link">
                                             <i class="fas fa-list nav-icon"></i>
                                             <p>List Siswa</p>
                                        </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="<?=site_url('siswa/perubahan_kelas')?>" class="nav-link">
                                             <i class="fas fa-home nav-icon"></i>
                                             <p>Perubahan Kelas Siswa Masal</p>
                                        </a>
                                   </li>
                              </ul>
                         </li>
                         <?php if($detailActiveUser['level'] === 'superadmin'){ ?>
                              <li class="nav-item has-treeview">
                                   <a href="<?=site_url('user')?>" class="nav-link <?=(strtolower($this->uri->segment(1)) === 'user')? 'active' : ''?>">
                                        <i class="nav-icon fa fa-user-circle text-danger"></i>
                                        <p>
                                             User
                                             <i class="right fas fa-angle-left"></i>
                                        </p>
                                   </a>
                                   <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                             <a href="<?=site_url('user/add')?>" class="nav-link">
                                                  <i class="fas fa-plus nav-icon"></i>
                                                  <p>Tambah User Baru</p>
                                             </a>
                                        </li>
                                        <li class="nav-item">
                                             <a href="<?=site_url('user/listuser')?>" class="nav-link">
                                                  <i class="fas fa-list nav-icon"></i>
                                                  <p>List User</p>
                                             </a>
                                        </li>
                                   </ul>
                              </li>
                         <?php } ?>
                         <li class="nav-item has-treeview">
                              <a href="<?=site_url('tabungan')?>" class="nav-link <?=(strtolower($this->uri->segment(1)) === 'tabungan')? 'active' : ''?>">
                                   <i class="nav-icon fas fa-book text-warning"></i>
                                   <p>
                                        Tabungan
                                        <i class="right fas fa-angle-left"></i>
                                   </p>
                              </a>
                              <ul class="nav nav-treeview">
                                   <?php if($detailActiveUser['level'] === 'admin'){ ?>
                                        <li class="nav-item">
                                             <a href="<?=site_url('tabungan/add')?>" class="nav-link">
                                                  <i class="fas fa-plus nav-icon"></i>
                                                  <p>Tambah Tabungan Baru</p>
                                             </a>
                                        </li>
                                   <?php } ?>
                                   <li class="nav-item">
                                        <a href="<?=site_url('tabungan/listtabungan')?>" class="nav-link">
                                             <i class="fas fa-list nav-icon"></i>
                                             <p>List Data Tabungan</p>
                                        </a>
                                   </li>
                                   <?php if($detailActiveUser['level'] === 'superadmin'){ ?>
                                        <li class="nav-item">
                                             <a href="<?=site_url('tabungan/jenis_biaya')?>" class="nav-link">
                                                  <i class="fas fa-dollar-sign nav-icon"></i>
                                                  <p>Jenis Biaya Tabungan</p>
                                             </a>
                                        </li>
                                   <?php } ?>
                              </ul>
                         </li>
                         <li class="nav-item has-treeview">
                              <a href="<?=site_url('transaksi')?>" class="nav-link <?=(strtolower($this->uri->segment(1)) === 'transaksi')? 'active' : ''?>">
                                   <i class="nav-icon fas fa-credit-card text-green"></i>
                                   <p>  
                                        Transaksi Tabungan
                                        <i class="right fas fa-angle-left"></i>
                                   </p>
                              </a>
                              <ul class="nav nav-treeview">
                                   <?php if($detailActiveUser['level'] === 'admin'){ ?>
                                        <li class="nav-item">
                                             <a href="<?=site_url('transaksi/add')?>" class="nav-link">
                                                  <i class="fas fa-plus nav-icon"></i>
                                                  <p>Tambah Transaksi Baru</p>
                                             </a>
                                        </li>
                                   <?php } ?>
                                   <li class="nav-item">
                                        <a href="<?=site_url('transaksi/listtransaksi')?>" class="nav-link">
                                             <i class="fas fa-list nav-icon"></i>
                                             <p>List Transaksi Tabungan</p>
                                        </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="<?=site_url('transaksi/riwayattransaksisiswa')?>" class="nav-link">
                                             <i class="fas fa-history nav-icon"></i>
                                             <p>Riwayat Transaksi Siswa</p>
                                        </a>
                                   </li>
                              </ul>
                         </li>
                         <li class="nav-item has-treeview">
                              <a href="<?=site_url('reverse')?>" class="nav-link <?=(strtolower($this->uri->segment(1)) === 'reverse')? 'active' : ''?>">
                                   <i class="nav-icon fas fa-reply text-info"></i>
                                   <p>  
                                        Transaksi Reverse
                                        <i class="right fas fa-angle-left"></i>
                                   </p>
                              </a>
                              <ul class="nav nav-treeview">
                                   <?php if($detailActiveUser['level'] === 'admin'){ ?>
                                        <li class="nav-item">
                                             <a href="<?=site_url('reverse/transaksireverse')?>" class="nav-link">
                                                  <i class="fas fa-reply nav-icon"></i>
                                                  <p>Request Reverse</p>
                                             </a>
                                        </li>
                                   <?php } ?>
                                   <?php if($detailActiveUser['level'] === 'superadmin'){ ?>
                                        <li class="nav-item">
                                             <a href="<?=site_url('reverse/approvementreverse')?>" class="nav-link">
                                                  <i class="fas fa-check nav-icon"></i>
                                                  <p>Approvement Reverse</p>
                                             </a>
                                        </li>
                                   <?php } ?>
                              </ul>
                         </li>
                         <li class="nav-item has-treeview">
                              <a href="<?=site_url('laporan')?>" class="nav-link <?=(strtolower($this->uri->segment(1)) === 'laporan')? 'active' : ''?>">
                                   <i class="nav-icon fas fa-file text-danger"></i>
                                   <p>  
                                        Laporan
                                        <i class="right fas fa-angle-left"></i>
                                   </p>
                              </a>
                              <ul class="nav nav-treeview">
                                   <li class="nav-item">
                                        <a href="<?=site_url('laporan/reverse')?>" class="nav-link">
                                             <i class="fas fa-reply nav-icon"></i>
                                             <p>Laporan Reverse</p>
                                        </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="<?=site_url('laporan/transaksi')?>" class="nav-link">
                                             <i class="fas fa-table nav-icon"></i>
                                             <p>Transaksi Tabungan</p>
                                        </a>
                                   </li>
                              </ul>
                         </li>
                    </ul>
               </nav>
               <!-- /.sidebar-menu -->
          <?php } ?>
     </div>
     <!-- /.sidebar -->
</aside>