<?php
   require_once('core/loader.php');
   $t=new task(get_option('elsa_pluginpatch',false).'/task/');

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
