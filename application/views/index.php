<!DOCTYPE html>
<html>
     <?php $this->load->view('components/head'); ?>
     <?php $this->load->view('components/body-open'); ?>
          <?php $this->load->view('components/navbar'); ?>
          <?php $this->load->view('components/sidebar'); ?>

          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
               <div class="container">
                    <div class="col-12 text-center pt-5 pb-5 h-100">
                         <h2 class="text-info text-center text-bold">Selamat Datang di Aplikasi Tabungan Sekolah</h2>
                         <h4 class='text-muted'>Hai, <?=$this->session->userdata('username')?></h4>
                         <br>
                         <img src='<?=base_url("assets/img/welcome-image.svg")?>' alt='Welcome Image' style='width:350px' 
                              class='mb-5 mt-2' />
                         <p class="text-justify ml-3 mr-3">
                              It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                         </p>
                    </div>
               </div>
          </div>
          <!-- /.content-wrapper -->

          <?php $this->load->view('components/footer'); ?>
          <?php $this->load->view('components/control-sidebar'); ?>
     <?php $this->load->view('components/body-close'); ?>
</html>
