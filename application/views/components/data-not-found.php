<div class='<?=(isset($containerClass)? $containerClass : '')?>' style='<?=(isset($containerStyle)? $containerStyle : '')?>'>
     <?php if(strlen($dataNotFoundTitle) >= 1){ ?>
          <h1 class='text-danger text-center' id='dataNotFoundTitle'><?=$dataNotFoundTitle?></h1>
     <?php } ?>
     <img src='<?=base_url('assets/img/unknown-people.svg')?>' alt='Unknown People' class='pb-2 pt-4 img-block' style='width:250px' />
     <p class='text-danger text-center' id='dataNotFoundDesc'><?=$dataNotFoundDesc?></p>
</div>