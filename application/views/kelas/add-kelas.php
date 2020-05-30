<div class="modal fade" id="modal-add-kelas">
     <div class="modal-dialog modal-lg">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id='modalTitle'>Tambah Kelas Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <div class="modal-body">
                    <div style='display:none' id='action' action='add'></div>
                    <form id='form-add-kelas' onsubmit='formSubmitted(this, event)'>
                         <div class='form-group'>
                              <label for='namaKelas'>Nama Kelas</label>
                              <input type='text' class='form-control' placeholder='Nama Kelas' id='namaKelas' name='namakelas' />
                         </div>
                    </form>
               </div>
               <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-success btn-sm" id='submit'>Simpan Kelas</button>
               </div>
          </div>
     </div>
</div>
<link href='<?=base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.css')?>' rel='stylesheet' />
<script src='<?=base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.js')?>'></script>
<script language='Javascript'>
     $('#submit').on('click', function(e){
          e.preventDefault();

          let action     =    $('#action').attr('action');
          let dataPOST   =    $('#form-add-kelas').serialize();

          doAjax(dataPOST, action);
     });

     function formSubmitted(formElement, event){
          event.preventDefault();

          let dataPOST  =    $(formElement).serialize();
          let action     =    $('#action').attr('action');

          doAjax(dataPOST, action);
     }

     function doAjax(dataPOST, action){
          if(action === 'edit'){
               let dataKelas  =    $('#action').attr('datakelas');
               dataKelas      =    JSON.parse(dataKelas);

               url       =    '<?=site_url('kelas/addKelas')?>';
               dataPOST  +=   `&idKelas=${dataKelas.idKelas}`;
          }
          
          $.ajax({
               url  : '<?=site_url('kelas/addKelas')?>',
               type : 'POST',
               data : dataPOST,
               success : function(responseFromServer){
                    let JSONResponse    =    JSON.parse(responseFromServer);
                    let type, title;

                    if(JSONResponse.addKelas === true){
                         window.getListKelas();
                         $('#modal-add-kelas').modal('hide');
                    }else{
                         type      =    'error';
                         title     =    'Data Kelas Gagal di Simpan !';

                         Swal.fire('Add Kelas', title, type);
                    }
               }
          });

     }
</script>