<?php
if (isset($_REQUEST['f']))
  {
  if (function_exists($_REQUEST['f']))
    {
    require_once('../../../../wp-load.php');
    $func = $_REQUEST['f'];
      $func($_REQUEST);
    }
  }
function elsagrSaveparams($a)
  {
   $k=$a['k'];
   $v=trim($a['v']);
   if ($k=='elsa-opt-imgdir' || $k=='elsa-opt-imgurl')
    {
    if ($v[strlen($v)-1]=='/')
      {
      $v=substr($v,0,strlen($v)-1);
      }
    }
  update_option($k,$v);
  }
function elsagrAddTask($a)
  {
      $t=new elsa_task();
       if ($a['k']=='task')
        {
        $ex=explode("\n",$a['v']);
        $ex2=explode(");",$a['v']);
          if (sizeof($ex)<sizeof($ex2))
            {
            $a['v']=implode(');'."\n",$ex2);
            }
        }
      if ($a['k']=='time')
        {
        $a['v']=intval($a['v']);
        }
      $t->updTask(addslashes($a['t']),addslashes($a['k']),addslashes($a['v']));
  }
function elsagrAddTaskId($a)
  {
   $t=new elsa_task();
    echo trim($t->addNew());
  }
function elsagrGetListTask($a)
  {
   $t=new elsa_task();
   echo $t->getList();
  }
function elsagrDelTask($a)
  {
      $t=new elsa_task();
      $t->delTask(intval(addslashes($a['v'])));
  }
function elsagrTestTask($a)
  {
     if (isset($a['live']) && $a['live'])
      {
      $TEXTID=$a['t'];
      }
     else
      {
      $TID=$a['id'];
      }
     include('../rs/templates/_testtask.php');
  }
function elsagrRemoteTask($a)
  {
  global $_wopt;
  $url='http://savitov.ru/ELSA/remotetask/lists.php?str='.$a['id'].'&s='.$_SERVER['SERVER_NAME'].'&k='.$_wopt['elsa-opt-key']['b'].'&d='.$_wopt['elsa-opt-domen']['b'];
  $f=file($url);

  $ftext=trim(implode('',$f));
  $error=array('GERROR###permission denied [bad key]','GERROR###permission denied [bad domen]');
   if (in_array($ftext,$error))
    {
    echo str_ireplace('GERROR###','',$ftext);
    exit();
    }
    $res=unserialize(implode('',$f));
    if (sizeof($res)==0 || $res===false || !is_array($res))
      {
      echo __('Ничего не найдено','ELSAGR');
      return false;
      }
    $out='';
    foreach ($res as $line)
      {
      $ex=explode('###',$line);
        $out.='<div id="elsagr_findtaskline" class="elsagr_findtaskline'.trim($ex[1]).'"><a href="javascript:void(0)" onclick="elsagrShowRemoteTask('.trim($ex[1]).')">'.$ex[0].'</a></div>';
       }
   echo $out;
  }
function elsagrGetRemoteTask($a)
  {
  global $_wopt;
  $f=file('http://savitov.ru/ELSA/remotetask/files.php?f='.$a['id'].'&s='.$_SERVER['SERVER_NAME'].'&k='.$_wopt['elsa-opt-key']['b'].'&d='.$_wopt['elsa-opt-domen']['b']);
  echo nl2br(implode('',$f));
  echo '<br><a href="javascript:void(0)" onclick="elsagr_copytask('.$a['id'].')">'.__('Добавить к моим заданиям','ELSAGR').'</a>';
  }
function elsagrGetRemoteTaskFC($a)
  {
  global $_wopt;
  $f=file('http://savitov.ru/ELSA/remotetask/files.php?f='.$a['id'].'&s='.$_SERVER['SERVER_NAME'].'&k='.$_wopt['elsa-opt-key']['b'].'&d='.$_wopt['elsa-opt-domen']['b']);
  $i=array();
  foreach ($f as $l)
    {
    if (($l[0]=='/' && $l[1]=='/') || $l[0]=='#'){continue;}
    $i[]=$l;
    }
  echo implode('',$i);
  }
function elsagrShareTask($a)
  {
  $t=new elsa_task();
  $text=$t->getTask(addslashes($a['id']));
  $mass=serialize($text);
  if (sendsharecatalog($mass))
    {
    _e('Спасибо за пополенение каталога заданий<br>После проверки, задание станет доступно для установки','ELSAGR');
    }
  else
    {
    _e('Ошибка передачи данных на сервер<br>Попробуйте повторить операцию позже.','ELSAGR');
    }
  }
function elsagrCheckUpd($a)
  {
  global $_wopt;
  $out=needUpdate($_wopt['elsa-opt-version']['b'],$_wopt['elsa-opt-key']['b'],$_wopt['elsa-opt-domen']['b']);
  update_option('elsa-opt-lasttryupd',time());
  echo $out;
  }
function elsagrExportTask($a)
  {
  $task=new elsa_task();
  $all=$task->getAllTask();
  $sall=serialize($all);
  $files=__wDir__.'export/ELSA4_export_'.date("d.m.Y").'.zip';
  if (is_writable(__wDir__.'export'))
    {
     $zip = new ZipArchive();
     if (file_exists($files)){unlink($files);}
     $openzip=$zip->open($files, ZIPARCHIVE::CREATE);
      if ($openzip)
        {
        $zip->addFromString('elsa_task.txt', $sall);
        $zip->close();

        echo trim('OK:'.str_ireplace(__wDir__,__wUrl__,$files));
        }
      else
        {
        echo __('Ошибка экспорта:<br/> ','ELSAGR').$openzip;
        }
        
    }
  else
    {
    echo __('Папка export не доступна для записи. Експорт невозможен<br /> Установите для папки export права на запись','ELSAGR');
    }
  }
?>
