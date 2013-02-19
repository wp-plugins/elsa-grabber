<?php
 require_once(__wDir__.'ring/load.php');
 global $_wopt;
 $cltask = new elsa_task ();
 $list=$cltask->getList();
 
 if (!empty($_FILES))
  {
  foreach ($_FILES as $k=>$v)
    {
      if (strpos($k,'elsagruploadfile')===false) {continue;}
      $ex=explode('.',$v['name']);
      $mufn=$ex[sizeof($ex)-1];
      if (empty($v['name']))
        {
        echo '<script type="text/javascript">elsagrShowMessage("'.__('Передан пустой файл','ELSAGR').'");</script>';
        break;
        }
      if ($mufn!='zip' && $mufn!='txt')
        {
        echo '<script type="text/javascript">elsagrShowMessage("'.__('Неподдерживаемый формат файла','ELSAGR').'");</script>';
        break;
        }
      if (@move_uploaded_file($v['tmp_name'], __wDir__.'export/'.basename($v['tmp_name']).'.'.$mufn))
        {
         if ($mufn=='zip')
          {
          $zip = new ZipArchive;
            if ($zip->open(__wDir__.'export/'.basename($v['tmp_name']).'.'.$mufn) === TRUE)
              {
                if (is_dir(__wDir__.'export/'.basename($v['tmp_name']).'/')){elsagrRmdir(__wDir__.'export/'.basename($v['tmp_name']).'/');}
                if (!mkdir(__wDir__.'export/'.basename($v['tmp_name']).'/'))
                  {
                    echo '<script type="text/javascript">elsagrShowMessage("'.__('Ошибка! <br/>не могу распаковать архив','ELSAGR').'");</script>';
                    break;
                  }
                $zip->extractTo(__wDir__.'export/'.basename($v['tmp_name']).'/');
                $zip->close();
                 $ff=scandir(__wDir__.'export/'.basename($v['tmp_name']).'/');
                 foreach ($ff as $file)
                  {
                  if ($file=='.' || $file=='..' || is_dir(__wDir__.'export/'.basename($v['tmp_name']).'/'.$file)) {continue;}
                  $itog=elsagrImportTaskFromFile('export/'.basename($v['tmp_name']).'/'.$file);
                  if ($itog['r'])
                    {
                     $mout.=$itog['m'].'<br/>';
                    }
                  else
                    {
                     $mout.=$itog['m'].'<br/>';
                    }
                  }
                  if (!empty($mout)){echo '<script type="text/javascript">elsagrShowMessage("'.$mout.'"); elsagrReloadTimePage(2500); </script>';} //elsagrReloadTimePage(2900);                     }
                  elsagrRmdir(__wDir__.'export/'.basename($v['tmp_name']).'/');
                  unlink(__wDir__.'export/'.basename($v['tmp_name']).'.'.$mufn);
              }
            else
              {
              echo '<script type="text/javascript">elsagrShowMessage("'.__('Ошибка! <br/>не могу распаковать архив','ELSAGR').'");</script>';
              break;
              }

        }
        }
      else
        {
        echo '<script type="text/javascript">elsagrShowMessage("'.__('Папка export не найдена или недоступна для записи','ELSAGR').'");</script>';
        break;
        }
    }
  }
?>
<div id="wpbody" class="wrap">
<div id="elsagr_main"> <div class="elsagrlogo76"> </div> <h2><?=_e('Задания','ELSAGR');?></h2> <br />
  <div id="elsagr_menu">
    <ul>
      <li><button class="elsagrbutton button-primary" onclick="elsagrLoadTemlModal('_addtask','php')"><?=_e('Добавить новое задание','ELSAGR');?></button></li>
      <li><button class="elsagrbutton button-primary" onclick="elsagrLoadDevTask()"><?=_e('Каталог заданий','ELSAGR');?></button></li>
      <li><button class="elsagrbutton button-primary" onclick="elsagrExportTask()"><?=_e('Экспорт заданий','ELSAGR');?></button></li>
      <li><button class="elsagrbutton button-primary" onclick="elsagrImportTask()"><?=_e('Импорт заданий','ELSAGR');?></button></li>
    </ul>
  </div>  <br />   <br /><br /><br />
  <div id="elsagrtasklist">
      <?php
        echo $list;
      ?>
  </div>
</div> </div>
