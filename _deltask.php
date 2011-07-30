<html><head><title></title><meta http-equiv="content-type" content="text/html; charset=utf-8" /></head><body>
   <?php
   require_once('core/loader.php');
   //$elsamo=WP_PLUGIN_DIR.'/'.dirname( plugin_basename( __FILE__ ) ) . '/language/'.get_locale().'.mo';
   //load_textdomain('elsagrabber',$elsamo);


   $del=$_REQUEST['deltask'];

    $t=new task(get_option('elsa_pluginpatch',false).'/task');
    $task=$t->getTask('filename='.$del);

    $t_name=$task['name'];
    $t_time=$task['time'];
    $t_info=$task['info'];
    $t_text=$task['text'];
    $t_rss=$task['rss'];

   Echo "
   <h2>".__('Title','elsagrabber')." - $t_name </h2>
   <u>".__('Time run','elsagrabber')."</u> - $t_time
   <br><u>".__('RSS adress','elsagrabber')."</u> - $t_rss
   <br><u>".__('Information','elsagrabber')."</u> - $t_info
   <hr>
   <b>".__('Content task','elsagrabber').":</b><br>$t_text";
   ?>


   <br><br><br><div id="alert"><b><?php _e('You really want to remove this task?','elsagrabber');?></b>
   <form action="" method="post">
   <input type="hidden" value="<?=$del;?>" name="deletetask">
   <input type="submit" value="<?php _e('Yes','elsagrabber');?>" name="yes">
   <input type="button" value="<?php _e('No','elsagrabber');?>" name="no" onclick="tb_remove()"></div>


   </form>

</body></html>
