<?php
 require_once(__wDir__.'ring/load.php');
 global $_wopt;
?>
<div id="wpbody" class="wrap">
    <div id="elsagr_main"> <div class="elsagrlogo76"> </div> <h2><?=_e('Параметры','ELSAGR');?></h2> <br />
       <?php
      $out='';
        foreach ($_wopt as $k=>$v)
          {
           if ($v['a']==1)
            {
            $nice='';
            $nice = elsagr_textOpt($k,$v);
            $class=$nice['class'];
            $badtext=$nice['text'];
            $out.='<div id="elsagr_opt" class="'.$k.' '.$class.'">';
              $out.='<div id="elsagr_optname">'.$v['d'].'</div>';
              $out.='<div id="elsagr_optval"><input type="text" value="'.$v['b'].'"  id="'.$k.'"></div>';
              $out.=(!empty($badtext))?'<div class="elsagr_error">'.$badtext.'</div>':'';
            $out.='</div>';
            }
          }
        $out.='<br /><button class="elsagrbutton button-primary" onclick=elsagrSaveparam()>'._('Сохранить','ELSAGR').'</button>';
        echo $out;
        ?>
       <br /><br />
       <h4>interpretation:</h4>
       <div id="elsagrfootererror"><img src="<?=__wUrl__;?>rs/error_1.png"> &mdash; <?=_e('Критическая ошибка','ELSAGR');?></div>
       <div id="elsagrfootererror"><img src="<?=__wUrl__;?>rs/error_2.png"> &mdash; <?=_e('Не критическая ошибка','ELSAGR');?></div>
   </div>
</div>
