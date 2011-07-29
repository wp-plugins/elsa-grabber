<?php
   require_once('core/loader.php');
   $t=new task('task/');

if (isset($_REQUEST['deletetask']) && ($_REQUEST['deletetask']=='true'))
    {

    $task=$t->getTask('filename='.$_REQUEST['filename']);
    echo 'Запрос на удаление файла — '.$task['filename'];
    $ans=$t->delTask('filename='.$_REQUEST['filename']);
    if ($ans) {echo '<br><b>Файл задания удален</b><br>';}
    else {echo '<br>Ошибка при выполнения удаления<br><br>ОШИБКА:<br>'; $t->_error;}
    exit();
    }
if (isset($_REQUEST['loadtasklist']) && ($_REQUEST['loadtasklist']=='true'))
    {
          $all=$t->getTask();
          $up2='http://elsa.ru/wp-content/plugins/';
            foreach ($all as $t)
              {
              $out='';
              $out.='<div id="elsatask">'.$t['name'].' — запуск: '.$t['time'].'; файл: ['.$t['filename'].']';
              $out.='<a href="'.$up2.'elsa/_deltask.php?KeepThis=true&modal=true&deltask='.$t['filename'].'" class="thickbox"><img src="'.$up2.'elsa/images/delete.png"></a>';
              $out.='<img src="'.$up2.'elsa/images/edit.png">';
              $out.='<img src="'.$up2.'elsa/images/view.png">';


              $out.='</div>';
              echo $out;
              }
    }

if (isset($_REQUEST['getparam']) && ($_REQUEST['getparam']=='true'))
    {
    $task=$t->getTask('filename='.$_REQUEST['filename']);
    //var_dump($task);
    echo $task[$_REQUEST['need']];
    }
if (isset($_REQUEST['testtask']) && ($_REQUEST['testtask']=='true'))
   {
    //$task=$t->getTask('filename='.$_REQUEST['filename']);
    $task=$t->runTask($_REQUEST['filename'],true);
    echo $task;
   }





//  else {var_Dump($_REQUEST);}
?>
