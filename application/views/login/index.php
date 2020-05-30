<!DOCTYPE html>
<html>
     <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title><?= $title ?></title>
          <meta name="viewport" content="width=device-width, initial-scale=1">

          <link rel="stylesheet" href="<?=base_url('assets/AdminLTE/')?>plugins/fontawesome-free/css/all.min.css">
          
          <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
          
          <link rel="stylesheet" href="<?=base_url('assets/AdminLTE/')?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
          
          <link rel="stylesheet" href="<?=base_url('assets/AdminLTE/')?>dist/css/adminlte.min.css">
          
          <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
          <link href='<?=base_url('assets/img/icon.png')?>' rel='shortcut icon' />

          <style type='text/css'>
               body{
                    position: relative;
                    background-image: url('<?=base_url("assets/img/login-background.jpg")?>') !important;
                    background-position: center !important;
                    background-attachment: fixed !important;
                    background-size: cover !important;
               }
               .overlay{
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    background:rgba(0, 0, 0, .4);
                    z-index: -1;
               }
               .card{
                    box-shadow: 5px 5px 20px rgba(0, 0, 0, .4);
               }
               .forgot-password{
                    font-size:11pt;
               }
               .login-card-body{
                    padding-top:30pt;
                    padding-bottom:30pt;
               }
               #submitBtn{
                    border-radius:30px;
               }
          </style>
     </head>
     <body class="hold-transition login-page">
          <div class="overlay"></div>
          <div class="login-box">
               <div class="login-logo">
                    <a href="<?=site_url('auth/login')?>" style='font-weight:bold; font-size:25pt;'>
                         <b class='text-white'>Aplikasi</b> <b class='text-white'>Tabungan Sekolah</b>
                    </a>
               </div>
               
               <div class="card">
                    <div class="card-body login-card-body">
                         <?php if(isset($_GET['showNotice'])){ ?>
                              <p class="login-box-msg text-danger text-bold">
                                   Anda harus login terlebih dahulu agar bisa mengakses aplikasi ini
                              </p>
                         <?php }else{ ?>
                              <p class="login-box-msg text-info text-bold" style='font-size:15pt;'>
                                   Portal Login
                              </p>
                         <?php } ?>

                         <form id='formLogin'>
                              <div class="input-group mb-3">
                                   <input type="text" class="form-control" placeholder="Email or Username" name='username'>
                                   <div class="input-group-append">
                                        <div class="input-group-text">
                                             <span class="fas fa-envelope"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="input-group mb-3">
                                   <input type="password" class="form-control" placeholder="Password" name='password'>
                                   <div class="input-group-append">
                                        <div class="input-group-text">
                                             <span class="fas fa-lock"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-12">
                                        <div class="icheck-primary">
                                             <input type="checkbox" id="remember" name='rememberMe'>
                                             <label for="remember">
                                                  Remember Me
                                             </label>
                                        </div>
                                   </div>
                              </div>
                              <div class="row mt-2">
                                   <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-block" id='submitBtn'>Sign In</button>
                                   </div>
                              </div>
                         </form>
                         <hr />
                         <p class="mb-1 text-center forgot-password">
                              <a href="<?=site_url('auth/forgot_password')?>">I forgot my password</a>
                         </p>
                         <!-- <p class="mb-0">
                              <a href="<?=site_url('auth/register')?>" class="text-center">Register</a>
                         </p> -->
                    </div>
               </div>
          </div>

          <script src="<?=base_url('assets/AdminLTE/')?>plugins/jquery/jquery.min.js"></script>
          <script src="<?=base_url('assets/AdminLTE/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
          <script src="<?=base_url('assets/AdminLTE/')?>dist/js/adminlte.min.js"></script>

          <script src='<?=base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.js')?>'></script>
          <link href='<?=base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.css')?>' rel='stylesheet' />
          
          <script language='Javascript'>
               $('#formLogin').on('submit', function(e){
                    e.preventDefault();
                    let formData   =    $(this).serialize();
                    
                    let submitBtn  =    $(this).find('#submitBtn');
                    let initialText     =    submitBtn.text();
                    submitBtn.prop('disabled', true);
                    submitBtn.text('Processing ..');

                    $.ajax({
                         url  :    '<?=base_url("auth/autentikasi")?>',
                         type :    'POST', 
                         data :    formData,
                         success   :    function(responseFromServer){
                              let JSONResponse    =    JSON.parse(responseFromServer);

                              if(JSONResponse.statusAutentikasi === true){
                                   window.location.href     =    "<?=site_url('welcome')?>";
                              }else{
                                   Swal.fire({
                                        title     :    'Autentikasi',
                                        html      :    `Login Gagal ! <b class='text-danger'>${JSONResponse.message}</b>.`,
                                        type      :    'error',
                                        backdrop  :    false
                                   });
                              }

                              submitBtn.prop('disabled', false);
                              submitBtn.text(initialText);
                         } 
                    });
               });
          </script>
     </body>
</html>