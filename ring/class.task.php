<?php
require_once('load.php');
 class elsa_task
  {
     var $t;
     var $DB;
     function __construct($a='')
      {
      global $wpdb;
      $this->DB=&$wpdb;
      $this->t='';

      if (empty($a))
        {
        $this->loadTask();
        }
      else
        {
        $this->t=$a;
        }
      }
    function loadTask()
      {
      $this->t=array();
        $res=$this->DB->get_results("select * from ".__tTask__." order by id");
          foreach ($res as $line)
            {
            $k=sizeof($this->t);
              $this->t[$k]['id']=stripslashes($line->id);
              $this->t[$k]['name']=stripslashes($line->name);
              $this->t[$k]['text']=stripslashes($line->text);
              $this->t[$k]['time']=stripslashes($line->time);
              $this->t[$k]['type']=stripslashes($line->type);
              $this->t[$k]['task']=stripslashes($line->task);
              $this->t[$k]['action']=stripslashes($line->action);
              $this->t[$k]['addtime']=stripslashes($line->addtime);
            }
      }
    function getList()
      {
      $out='';
      foreach ($this->t as $line)
        {
        $out.='<div id="elsagr_task"><ul>';
          $out.='<li class="elsagrMW400">'.$line['name'].'</li>';
          $out.='<li class="elsagrMW35"><a href="javascript:void(0)" onclick="elsagrTestTask(\''.$line['id'].'\')"><img src="'.__wUrl__.'rs/test.png" title="'._('Тестировать','ELSAGR').'"></a></li>';
           if ($line['action']=='on' || $line['action']=='yes' || $line['action']=='1' || $line['action']==1)
            {
            $out.='<li class="elsagrMW35"><a href="javascript:void(0)" onclick="elsagrActTask(\''.$line['id'].'\',\'off\')"><img src="'.__wUrl__.'rs/acoff.png" title="'._('Выключить','ELSAGR').'"></a></li>';
            }
           else
            {
            $out.='<li class="elsagrMW35"><a href="javascript:void(0)" onclick="elsagrActTask(\''.$line['id'].'\',\'on\')"><img src="'.__wUrl__.'rs/acon.png" title="'._('Включить','ELSAGR').'"></a></li>';
            }
          $out.='<li class="elsagrMW35"><a href="javascript:void(0)" onclick="elsagrEditTask(\''.$line['id'].'\')"><img src="'.__wUrl__.'rs/edit.png" title="'._('Изменить','ELSAGR').'"></a></li>';
          $out.='<li class="elsagrMW35"><a href="javascript:void(0)" onclick="elsagrDelTask(\''.$line['id'].'\')"><img src="'.__wUrl__.'rs/del.png" title="'._('Удалить','ELSAGR').'"></a></li>';
        $out.='</ul></div>';
        }
      return $out;
      }
   function addNew($a='')
    {
     if (is_array($a))
      {
      $b=$a;
      } else {$b=unserialize($a);}
      $q=$this->DB->insert(__tTask__,array('addtime'=>time()));
      $res=$this->DB->insert_id;
      $this->loadTask();
      return $res;
    }
  function updTask($id,$k,$v)
    {
    $this->DB->query("update ".__tTask__." set $k='$v' where id='$id'");
    $this->loadTask();
    }
  function delTask($a)
    {
    $this->DB->query("delete from ".__tTask__." where id='$a'");
    $this->loadTask();
    }
  function addNewTask($a)
    {
     $field=array('addtime','id');
     if (is_array($a))
      {
      $b=$a;
      } else {$b=unserialize($a);}
    $this->DB->query("delete from ".__tTask__." where id='$a'");
    $newid=$this->addNew();
      foreach ($b as $k=>$v)
        {
         if (in_array($k,$field)){continue;}
         $this->updTask($newid,$k,addslashes($v));
        }
    $this->loadTask();
    if (intval($newid)>-1){return true;}
    return false;
    }
  function getTask($a)
    {
    foreach ($this->t as $line)
      {
      if ($line['id']==$a)
        {
        return $line;
        }
      }
    }
  function getAllTask()
    {
    return $this->t;
    }
  }
   //$this->DB->show_errors();
    //$this->DB->print_error();
?>
