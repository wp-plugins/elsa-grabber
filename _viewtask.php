<html><head><title></title></head><body>
   <?php
   $dir=$_REQUEST['elsadir'];
   if ($dir[strlen($dir)-1]=='/'){$dir=substr($dir,0,strlen($dir)-1);}

   DEFINE ('WP_PLUGIN_DIR',$dir);
   require_once('core/loader.php');

   $del=$_REQUEST['viewtask'];

   //print $del.'<br>';
   //print $_REQUEST['elsadir'];
   $t=new task($dir.'/elsa/task');
    $task=$t->getTask('filename='.$del);

    $t_name=$task['name'];
    $t_time=$task['time'];
    $t_info=$task['info'];
    $t_text=$task['text'];
    $t_rss=$task['rss'];

   Echo <<<HTML
   <h2>Задание — $t_name </h2>
   <br><u>Период запуска</u> — $t_time
   <br><u>Адрес RSS</u> — $t_rss
   <br><u>Информация</u> — $t_info
   <hr>
   <b>Содержание:</b><br>$t_text






HTML;
   ?>


   <br><br><br><div id="alert">  </div>
   <form action="" method="post">
   <input type="hidden" name="testtask" value="<?=$del;?>">
   <input type="submit" name="ttest" value="Тестировать" style="float:left">
   <input type="button" value="Закрыть" name="no" onclick="tb_remove()" style="float:right"></div>
   </form>


</body></html>
