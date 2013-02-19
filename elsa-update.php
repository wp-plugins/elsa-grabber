<?php
 require_once(__wDir__.'ring/load.php');
 global $_wopt;
?>
<div id="wpbody" class="wrap">
<div id="elsagr_main"> <div class="elsagrlogo76"> </div><h2><?=_e('Обновление','ELSAGR');?></h2> <br/>
   <?php
     if ((intval($_wopt['elsa-opt-lasttryupd']['b'])+172799)<time())
      {?>
      <button onclick="elsagrCheckUpd()" id="elsagrcheckbutton" class="elsagrbutton button-primary"> <?=_e('Проверить наличие обновления','ELSAGR');?> </button>
      <?php }
      else
        {?>
        <b><?=_e('Проверка обновления может осуществляться не ранее чем через 2 суток после последней проверки','ELSAGR');?></b>
        <?php }  ?>
   <div id="elsagr_resultupd">  </div>
</div></div>
