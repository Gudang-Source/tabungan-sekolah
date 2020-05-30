<div class='col-lg-12'>
     <?php if(strlen($noDataTitle) >= 1){ ?>
          <h2 class='text-danger text-center'><?=$noDataTitle?></h2>
     <?php } ?>
     <img src='<?=base_url('assets/img/empty.svg')?>' alt='No Data Found' class='pb-2 pt-4 img-block' style='width:250px' />
     <p class='text-danger text-center'><?=$noDataDesc?></p>
</div>