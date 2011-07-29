<?php
  class task
    {
     var $_patch='';
     var $_tasks=array();
     var $_error='';

     function task($a)
      {
      $this->_patch=$a;
      $this->loadTask();
      }

    function addTask($a)
      {
      if (is_array($a))
        {
        if (empty($a['name'])){$this->_error='addTask:: Название задание не может быть пустым'; return false;}
        if (empty($a['rss'])){$this->_error='addTask:: Rss не может быть пустым'; return false;}
        if (empty($a['text'])){$this->_error='addTask:: Текст задания не может быть пустым'; return false;}
        if (empty($a['time'])){$this->_error='addTask:: Период задания не может быть пустым'; return false;}

         if (empty($a['filename']))
          {$tmp=tempnam($this->_patch,'ta_');}
         else {$tmp=$this->_patch.$a['filename'];}


           if ($tmp===false){$this->_error='addTask:: Не могу создать файл задания'; return false;}

           $f=fopen($tmp,"w+");
            flock($f, LOCK_EX);
            fwrite($f,$a['name']."\r\n");
            fwrite($f,$a['time']."\r\n");
            fwrite($f,$a['rss']."\r\n");
            fwrite($f,$a['info']."\r\n");
            fwrite($f,$a['text']."\r\n");
            flock($f, LOCK_UN);
           fclose($f);

        $this->loadTask();
        return basename($tmp);
        }
      else {$this->_error='addTask:: аргумент не является массивом'; return false;}
      }

    function delTask ($a)
      {
      if (empty($a)){$this->_error='delTask:: Укажите задание для удаления'; return false;}
       $ex=explode('=',$a);
        $param=trim($ex[0]);
        $value=trim($ex[1]);

        for($i=0;$i<sizeof($this->_tasks);$i++)
          {
          $now=$this->_tasks[$i];
            if ($now[$param]==$value)
              {
              if (unlink($now['absfilename']))
                  {$this->loadTask(); return true;}
              else
                  {
                  $this->_error='delTask:: Не могу удалить файл ('.$now['absfilename'].')';
                  return false;
                  }
              }
          }
      $this->_error='delTask:: Файл для удаления (где '.$param.' = '.$value.') не найден';
      return false;
      }

    function loadTask()
      {
      if (is_dir($this->_patch).'/')
        {

         $f=opendir($this->_patch.'/');

          unset($this->_tasks);
          while (($file=readdir($f))!==false)
            {

            if ($file=='.'){continue;}
            if ($file=='..'){continue;}
            if (is_dir($this->_patch.'/'.$file)){continue;}

             $ff=file($this->_patch.'/'.$file);

             @$count=sizeof($this->_tasks);

             $this->_tasks[$count]['name']=$ff[0];
             $this->_tasks[$count]['time']=$ff[1];
             $this->_tasks[$count]['rss']=$ff[2];
             $this->_tasks[$count]['info']=$ff[3];
             $this->_tasks[$count]['text']=join('',array_splice($ff,4));

             $this->_tasks[$count]['filename']=$file;
             $this->_tasks[$count]['absfilename']=$this->_patch.$file;
             //echo "$file<br>";
            }

        }
        else {$this->_error='loadTask:: Директория с заданиями не обнаружена'; return false;}
      }

    function getTask($a='')
      {
      $this->loadTask();
      if (empty($a)){return $this->_tasks;}

       $ex=explode('=',$a);
        $param=trim($ex[0]);
        $value=trim($ex[1]);

        for($i=0;$i<sizeof($this->_tasks);$i++)
          {
          $now=$this->_tasks[$i];
            if ($now[$param]==$value)
              {
              return $this->_tasks[$i];
              }
          }
      $this->_error='getTask:: Запрашиваемое задание (где '.$param.' = '.$value.') не найдено';
      return false;
      }
    function runTask($a,$test=false)
      {
       $z=$this->getTask('filename='.$a);
       $parser=new parser($z);
       $parser->run($test);
       return $parser->_error;
      // var_dump($parser->getVars());
      }
    }
?>
