<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
  $t= new elsa_task();
  $p=new elsa_parser();
  $all = $t->getAllTask();
  $dotime=intval(date("i"));
      foreach ($all as $now)
        {
          if ($now['action']=='yes' || $now['action']=='on')
            {
             $donow=intval($now['time']);
             if ($donow==0){continue;}
              if (!empty($donow))
                {
                if ($dotime%$donow==0)
                  {
                   $as=$p->run($now);
                  // var_dump($as);
                  }
                }
            }
        }
?>
