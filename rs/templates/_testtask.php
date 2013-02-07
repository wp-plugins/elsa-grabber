<?php
require_once('../../../../wp-load.php');

    $p=new elsa_parser();
    $t= new elsa_task();
    
    if (isset($TEXTID))
      {
      $task['task']=urldecode($TEXTID);

      }
     else
      {
      $task=$t->getTask($TID);
      }
    

    $res=$p->run($task,true);

   $analiz=array();
    foreach($res[1] as $k=>$v)
      {
      foreach ($v as $kk=>$vv)
        {
        if ($kk=='_analiz')
          {
          $analiz[]=$vv;
          }
        }
      }

   $error=array();
    foreach($res[1] as $k=>$v)
      {
      foreach ($v as $kk=>$vv)
        {
        if ($kk=='_error')
          {
          $error[$k]=$vv;
          }
        }
      }

?>

<div id="elsageTWtop">
  <div id="elsageTWmenu">
     <ul>
      <a href="javascript:void(0)" onclick="elsageActive(1)"><li class="elsagrActAc"><?=_e('Текст результата','ELSAGR');?></li></a>
      <a href="javascript:void(0)" onclick="elsageActive(2)"><li class="elsagrActNo"><?=_e('Код результата','ELSAGR');?></li></a>
      <a href="javascript:void(0)" onclick="elsageActive(3)"><li class="elsagrActNo"><?=_e('Анализ входящих данных','ELSAGR');?></li></a>
      <a href="javascript:void(0)" onclick="elsageActive(4)"><li class="elsagrActNo"><?=_e('Дамп данных','ELSAGR');?></li></a>
      <a href="javascript:void(0)" onclick="elsageActive(5)"><li class="elsagrActNo"><?=_e('Текст задания','ELSAGR');?></li></a>
     </ul>
  </div>  <div id="elsagrTWclose"> <span class="elsagr_win_close2"><a href="javascript:void(0)" onclick="wlsagrtwc()">X</a></span> </div>  </div>

<div id="elsagrTWtextM">


  <div id="elsagrTWtext" class="elsagrTWtext1">

   <?php




     if (!empty($error))
      {
        echo '<h2>'.__('Проблемы в тексте задания','ELSAGR').'</h2>';     //you have a problem with text task
      }
     else
      {

      if (empty($res[0]['_TESTRESULT_']))
        {
        echo '<h2>'.__('Возвращен нулевой результат','ELSAGR').'</h2>';
        }

      else
      {
      foreach($res[0]['_TESTRESULT_'] as $k=>$v)
      {
        echo "<div id='elsagrdumpt'>$k</div>";
        if (is_array($v))
          {
          foreach ($v as $kk=>$vv)
            {
            echo "<div id='elsagrdumpt'>$kk</div>";
            echo $vv;
            }
          }
         else
          {
          echo $v;
          }
      }

      }

      }//else
   ?>


  </div>
  
  <div id="elsagrTWtext" class="elsagrTWtext2">

   <?php
     if (!empty($error))
      {
        echo '<h2>'.__('Проблемы в тексте задания','ELSAGR').'</h2>';
      }
     else{

     if (empty($res[0]['_TESTRESULT_']))
      {
       echo '<h2>'.__('Возвращен нулевой результат','ELSAGR').'</h2>';
      }else{
     foreach($res[0]['_TESTRESULT_'] as $k=>$v)
      {
        echo "<div id='elsagrdumpt'>$k</div>";
        if (is_array($v))
          {
          foreach ($v as $kk=>$vv)
            {
            echo "<div id='elsagrdumpt'>$kk</div>";
            echo '<xmp>'.$vv.'</xmp>';
            }
          }
         else
          {
          echo '<xmp>'.$v.'</xmp>';
          }
      }}}
   ?>


  </div>
  
  <div id="elsagrTWtext" class="elsagrTWtext3">
   <?php

      echo '<xmp>';
      var_dump($analiz);
      echo '</xmp>';

   ?>
  </div>
  
  <div id="elsagrTWtext" class="elsagrTWtext4">
   <?php

      echo '<xmp>';
      var_dump($res[1]);
      echo '</xmp>';

   ?>
  </div>
  
  <div id="elsagrTWtext" class="elsagrTWtext5">
   <?php

     if (empty($error)){echo "<h2>".__('Проблемных директив не выявленно','ELSAGR')."</h2>";}
      echo '<xmp>';
      $ex=explode("\n",$task['task']);
      $ex1=array();
        foreach ($ex as $v)
          {
          if (($v[0]=='#') || ($v[0]=='/' && $v[1]=='/'))  {continue;}
          $ex1[]=$v;
          }
        foreach($ex1 as $k=>$v)
          {

            if (empty($error[$k]))
              {
              echo stripslashes($v)."\n";
              }

            else
            
              {
              echo '</xmp><span class="elsagrredtext"><xmp>'.$v.'</xmp></span>';
              foreach ($error[$k] as $kkk=>$vvv)
                {
                 echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>".$vvv."</b>";
                } echo '<xmp>';
              }





          }
        
     echo '</xmp>';
   ?>
  </div>
 </div>
<script type="text/javascript">
jQuery(document).ready(function(){
   elsagrLoader(2);
}); </script>
