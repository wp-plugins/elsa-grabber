<html><head><title></title></head><body>
   <?php
   require_once('core/loader.php');

   $del=$_REQUEST['viewtask'];

   //print $del.'<br>';
   //print $_REQUEST['elsadir'];
   $t=new task(get_option('elsa_pluginpatch',false).'/task');
    $task=$t->getTask('filename='.$del);

    $t_name=$task['name'];
    $t_time=$task['time'];
    $t_info=$task['info'];
    $t_text=$task['text'];
    $t_rss=$task['rss'];

   Echo "<h2>".__('Title','elsagrabber')." - $t_name </h2>
   <br><u>".__('Time run','elsagrabber')."</u> - $t_time
   <br><u>".__('RSS adress','elsagrabber')."</u> - $t_rss
   <br><u>".__('Information','elsagrabber')."</u> - $t_info
   <hr>
   <b>".__('Content task','elsagrabber').":</b><br>$t_text";
   ?>


   <br><br><br><div id="alert">  </div>
   <form action="" method="post">
   <input type="hidden" name="testtask" value="<?=$del;?>">
   <input type="submit" name="ttest" value="<?php _e('Test','elsagrabber');?>" style="float:left">
   <input type="button" value="<?php _e('Close','elsagrabber');?>" name="no" onclick="tb_remove()" style="float:right"></div>
   </form>


</body></html>
