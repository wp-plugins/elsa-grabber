<html><head><title></title></head><body>
   <?php
   require_once('core/loader.php');

   $del=$_REQUEST['deltask'];

    $t=new task(get_option('elsa_pluginpatch',false).'/task');
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


   <br><br><br><div id="alert"><b>Вы действительно хотите удалить это задание?</b>
   <form action="" method="post">
   <input type="hidden" value="<?=$del;?>" name="deletetask">
   <input type="submit" value="Да" name="yes">
   <input type="button" value="Нет" name="no" onclick="tb_remove()"></div>


   </form>

</body></html>
