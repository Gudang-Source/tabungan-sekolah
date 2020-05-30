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
               #submitBtn, #backBtn{
                    border-radius:30px;
               }
          </style>
     </head>
     <body class="hold-transition login-page">
          <div class="overlay"></div>
          <div class="login-box">
               <div class="card">
                    <div class="card-body login-card-body">
                         <p class="login-box-msg text-success text-bold" style='font-size:15pt;'>
                              Lupa Password
                         </p>

                         <form id='formLupaPassword'>
                              <div class="input-group mb-3">
                                   <input type="text" class="form-control" placeholder="Email or Username" name='emailOrUsername'>
                                   <div class="input-group-append">
                                        <div class="input-group-text">
                                             <span class="fas fa-envelope"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="row mt-2">
                                   <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <button type="submit" class="btn btn-success btn-block" id='submitBtn'>Pulihkan Password</button>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <a href="<?=site_url('auth')?>">
                                             <button type="button" class="btn btn-light btn-block" id='backBtn'>Login Page</button>
                                        </a>
                                   </div>
                              </div>
                              <hr>
                              <p class="text-center mb-0 text-sm">
                                   Password baru akan dikirimkan melalui email yang terdaftar
                              </p>
                         </form>
                    </div>
               </div>
          </div>

          <script src="<?=base_url('assets/AdminLTE/')?>plugins/jquery/jquery.min.js"></script>
          <script src="<?=base_url('assets/AdminLTE/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
          <script src="<?=base_url('assets/AdminLTE/')?>dist/js/adminlte.min.js"></script>

          <script src='<?=base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.js')?>'></script>
          <link href='<?=base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.css')?>' rel='stylesheet' />
          
          <script language='Javascript'>
               $('#formLupaPassword').on('submit', function(e){
                    e.preventDefault();
                    let formData   =    $(this).serialize();
                    
                    let submitBtn  =    $(this).find('#submitBtn');
                    let initialText     =    submitBtn.text();
                    submitBtn.prop('disabled', true);
                    submitBtn.text('Processing ..');

                    $.ajax({
                         url  :    '<?=base_url("auth/recovery_password")?>',
                         type :    'POST', 
                         data :    formData,
                         success   :    function(responseFromServer){
                              let JSONResponse    =    JSON.parse(responseFromServer);

                              let textColor, message, type;
                              if(JSONResponse.recoveryPassword === true){
                                   message   =    'Recovery Password Berhasil ! Silahkan Cek email anda !';
                                   textColor =    'text-success';
                                   type      =    'success';
                              }else{
                                   message   =    JSONResponse.message;
                                   textColor =    'text-danger';
                                   type      =    'error';
                              }

                              Swal.fire({
                                   title     :    'Recovery Password',
                                   html      :    `<b class='${textColor}'>${JSONResponse.message}</b>.`,
                                   type      :    type,
                                   backdrop  :    false
                              }).then(() => {
                                   submitBtn.prop('disabled', false);
                                   submitBtn.text(initialText);
                              })
                         } 
                    });
               });
          </script>
     </body>
</html>