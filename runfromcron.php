<?php
$full_abs=dirname(__FILE__);
require_once ($full_abs.'/core/loader.php');
$task=new task($full_abs.'/task');
require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
$opt=get_option('elsa_playtask',false);
  if(!is_array($opt))
    {
    $opt=unserialize($opt);
    }
    foreach ($opt as $e=>$v)
      {
      if ($v)
        {
        $now=$task->getTask('filename='.$e);
        $nowmin=date("i");
        $needmin=$now['time'];
        if ($nowmin%$needmin===0)
          {
           $task->runTask($e);
          }
        }
      }
?>
