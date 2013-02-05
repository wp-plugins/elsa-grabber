<?php
  class elsa_parser
    {
      var $G=array();
      var $W=array();
       function run($a,$test=false)
        {
        $this->G=array();
        if (!is_array($a)) {return false;}   //!!!!!
          $TEXT = $a['task'];
          $ITOG=array();
          $ex=explode("\n",$TEXT);

             foreach ($ex as $line)
              {
               if (strlen($line)<10){continue;}
               if (($line[0]=='#') || ($line[0]=='/' && $line[1]=='/'))  {continue;}
                $id=sizeof($ITOG);
                $ITOG[$id]['_raw']=$line;
                $this->analyze($id,&$ITOG);
              }

              foreach ($ITOG as $v)
                {
                   $_err = $v['_error'];
                   if (!empty($_err))
                    {
                    $RET[0]=$this->W[0];
                    $RET[1]=$ITOG;
                    }
                }
              foreach ($ITOG as $v)
                {
                 if ($test && $v['_analiz']['_FUNC']=='insertpost')
                  {

                  $this->make($v,&$ITOG,$test);
                  }
                 else
                  {
                  $this->make($v,&$ITOG);
                  }
                //echo "make <br>"; var_dump($v);
                }

           if ($test)
            {
              $RET[0]=$this->W[0];
              $RET[1]=$ITOG;
              return $RET;
            }
        }
    function analyze($a,$b)
      {
        global $_wopt;
        $ex=explode('=',$b[$a]['_raw']);
          $V=trim($ex[0]); array_shift($ex);
          $D=trim(implode('=',$ex));
            $b[$a]['_analiz']['_V']=$V;
            $b[$a]['_analiz']['_D']=$D;
            $b[$a]['_id']=$a;
            if (empty($V)) {$b[$a]['_error']['_V']='BAD V';}  //!!!!
            if (empty($V)) {$b[$a]['_error']['_D']='BAD D';}  //!!!!
          $ex=explode('(',$D);
           $func=$ex[0]; array_shift($ex);
           $func_data=implode('(',$ex);
           $func_data=trim($func_data);
           if ($func_data[strlen($func_data)-1]==';'){$func_data=trim(substr($func_data,0,strlen($func_data)-1));}
           if ($func_data[strlen($func_data)-1]==')'){$func_data=trim(substr($func_data,0,strlen($func_data)-1));}
           $b[$a]['_analiz']['_FUNC']=$func;
           $b[$a]['_analiz']['_RAWDATA']=$func_data;
           if (empty($func)){$b[$a]['_error']['_FUNC']=_('Пустое имя функции','ELSAGR');}
           if (empty($func_data)){$b[$a]['_error']['_RAWDATA']=_('Не переданы данные для функции ','ELSAGR');}
           if ($func=='get')
            {
              if (empty($_wopt['elsa-opt-imgdir']['b']))
                {
                $b[$a]['_error']['_FUNC']=_('Директория для файлов не установлена. <br/>Задания не может быть выполнено','ELSAGR');
                }
              if (empty($_wopt['elsa-opt-imgurl']['b']))
                {
                $b[$a]['_error']['_FUNC']=_('Ссылка на директорию файлов не установлена. <br/>Задания не может быть выполнено','ELSAGR');
                }
            }
           $functext=$b[$a]['_analiz']['_FUNC'];
           if ($this->is_var($V))
            {
              if (!method_exists($this,'__c_'.$functext))
                {
                $b[$a]['_error']['_FUNC_exists']=_('Не найдена функция ','ELSAGR').'"'.$functext.'"';
                }
            }
          else
            {
              if (!method_exists($this,'__'.$functext))
                {
                $b[$a]['_error']['_FUNC_exists']=_('Не найдена функция ','ELSAGR').'"'.$functext.'"';
                }
            }
          $ex=explode(',',$func_data);
            foreach ($ex as $p)
              {
              $p=trim($p);
              if ($p[0]=="'"){$p=substr($p,1,strlen($p));}
              if ($p[strlen($p)-1]=="'"){$p=substr($p,0,strlen($p)-1);}
              $b[$a]['_analiz']['_DATA'][]=trim($p);
              }
      }
    function make($a,$b,$c=false) //a-string b- ITOG
      {
        $var=$a['_analiz']['_V']; //
        $func=$a['_analiz']['_FUNC'];
        $data=$a['_analiz']['_DATA'];
          if ($var[0]=='_' && $var[strlen($var)-1]=='_')
            {
            $func='__c_'.$func;
            }
          else
            {
            $func='__'.$func;
            }
         if (!method_exists($this,$func))
          {
            $b[$a['_id']]['_error']['_FUNC']=_('Не найден метод ','ELSAGR').$func;
            return false;
          }
         $func=strtolower($func);
          foreach ($data as $k=>$v)
            {
            $data[$k]=stripslashes($v);
            }

         if ($func=='__c_insertpost' && $c)
          {

          $this->$func($var,$data,$c);
          }
        else
          {

          $this->$func($var,$data);
          }
      }
    function is_var($a)
      {
      if ($a[0]=='_' && $a[strlen($a)-1]='_')
        {return true;}return false;
      }
    function __loadRss($a,$b)
      {
       if (is_array($b)){$b=$b[0];}
       $res=elsagr_pGet($b);
       $this->G[$a]=$res;
         $xml=simplexml_load_string($this->G[$a]);
          foreach ($xml->channel->item as $i)
            {
            $id=sizeof($this->W);
            $this->W[$id]=array();
              foreach ($i as $k=>$v)
                {
                $this->W[$id]['_'.$k.'_']=$v;
                }
            }

      }
    function __c_load($a,$b)
      {
      if (is_array($b)){$b=$b[0];}
      foreach ($this->W as $k=>$v)
        {
         $id=$k;
         $new='';
         $new=elsagr_pGet($this->W[$id][$b]);
         $this->W[$id][$a]=$new;
        }
      }
    function __c_ext($a,$b)
      {
      if (is_array($b)){$xpath=$b[0]; $cont=$b[1];}
      
      $xpath=stripslashes($xpath);
      
      foreach ($this->W as $k=>$v)
        {
        $id=$k;
        $content='';
          if ($cont[0]=='_' && $cont[strlen($cont)-1]=='_')
            {
            $content=$this->W[$id][$cont];

                if (empty($content)){continue;} //!!!!
                

                
             $content=$this->__clearHtml($content);
             $content=$this->__repairHTML($content);
             $content=mb_convert_encoding($content, 'HTML-ENTITIES', 'utf-8');

             $dom = new DOMDocument;
             @$dom->loadHTML($content);

             $x = new DOMXPath($dom);
             $res = $x->query($xpath);

             //echo "<h1>$xpath</h1>";

             $result='';
              foreach ($res as $l)
                {
                 if (@empty($b[2]))
                  {
                  $result.=$l->nodeValue;
                  }
                 else
                  {
                  $result.=$l->getAttribute($b[2]);
                  }
                }
            $this->W[$id][$a]=$result;
            }
        }
      }
    function __c_get($a,$b)
      {
      if (is_array($b)){$b=$b[0];}
      global $_wopt;
      $localpath = $_wopt['elsa-opt-imgdir']['b'];
      $localurl=$_wopt['elsa-opt-imgurl']['b'];
      if ($localpath[0]=='/')
        {
        $localpath=$_SERVER['DOCUMENT_ROOT'].$localpath;
        }
      else
        {
        $localpath=__wDir__.$localpath;
        }
      foreach ($this->W as $k=>$v)
        {
        $img=$this->W[$k][$b];
        if (empty($img)){continue;}
        $raw=elsagr_pGet($img);
        $bn=basename($img);
        $bn2=$bn;
        $GG=0;
          while (true)
            {
            if (file_exists($localpath.'/'.$bn2))
              {
               $bn2=$GG.$bn;
               $GG++;
              }
             else
              {
              break;
              }
            }

        $f=fopen($localpath.'/'.$bn2,"w+");
        fwrite($f,$raw);
        fclose($f);
        $this->W[$k][$a]=$localurl.'/'.$bn2;
        }
      }
    function __c_implode($a,$b)
      {
      foreach ($this->W as $k=>$v)
        {
        $new='';
        foreach ($b as $d)
          {
          if ($this->is_var($d)){$d=$this->W[$k][$d];}
          $new.=$d;
          }
        $this->W[$k][$a]=$new;
        }
      }
    function __c_insertpost($a,$b,$c=false)
      {
       global $_wopt; global $wpdb;
        foreach ($this->W as $k=>$v)
          {

            $pp=array();
            foreach ($b as $kk=>$vv)
              {if ($this->is_var($vv)) {$pp[$kk]=$this->W[$k][$vv];} else {$pp[$kk]=$vv;}}

              if (empty($pp[5]) || strlen($pp[5])<250)
                {
                  if ($c)
                    {
                     $this->W[$k][$a]=$pp;
                     $this->W[$k]['_TESTRESULT_']['ERROR']=_('Пост не может быть вставлен потому что текст менее 250 символов ','ELSAGR');
                    }
                  else
                    {
                      $this->W[$k][$a]=$pp;
                      $this->W[$k]['_RESULTS']=_('Пост не может быть вставлен потому что текст менее 250 символов ','ELSAGR');
                    }
                continue;
                }
            $L['h']=false;
            $L['w']=false;
            $links=trim($_wopt['elsa-opt-setlinks']['b']);
            switch ($links) {
              case 'post':
                $L['h']=true;
                $L['w']='after';
                break;
              case 'after post':
                $L['h']=true;
                $L['w']='after';
                break;
              case 'before post':
                $L['h']=true;
                $L['w']='before';
                break;
              } // switch
              if ($L['h'] && $L['w']=='before')
                {
                $pp[5]=_('Писатель ','ELSAGR').' <a href="http://savitov.ru/elsa/">ElSa</a><br /><br />'.$pp[5];
                }
            $post = array(
              'post_title' => trim($pp[0]),
              'post_author' => $pp[1],
              'post_type' => $pp[2],
              'tags_input' => $pp[3],
              'post_category' => array($pp[4]),
              'post_content' => $pp[5],
              'post_date' => date("Y-m-d H:i:s",strtotime($pp[6])),
              'post_name' => trim($pp[7]),
              'post_status' => 'publish');
              if ($L['h'] && $L['w']=='after')
                {
                $pp[5]=$pp[5].'<br><br>'._('Писатель ','ELSAGR').'<a href="http://savitov.ru/elsa/">ElSa</a><br/><br/>';
                }
          $testtitle=trim($pp[0]);
          
          //echo "<h1>$testtitle</h1>";
          
          $havepost=$wpdb->get_row("select * from $wpdb->posts where post_title='$testtitle'");
          if (empty($havepost) && !$c)
            {
             $new=wp_insert_post($post,$wp_error);
             $this->W[$k]['_RESULTS']=_('Пост размещен','ELSAGR');

            }
           $this->W[$k][$a]=$pp;
          $this->W[$k]['_TESTRESULT_']['post_status']=$new;

          if ($c)
            {
            $this->W[$k]['_TESTRESULT_']['post_title']=trim($pp[0]);
            $this->W[$k]['_TESTRESULT_']['post_author']=$pp[1];
            $this->W[$k]['_TESTRESULT_']['post_type']=$pp[2];
            $this->W[$k]['_TESTRESULT_']['tags_input']=$pp[3];
            $this->W[$k]['_TESTRESULT_']['post_category']=array($pp[4]);
            $this->W[$k]['_TESTRESULT_']['post_content']=$pp[5];
            $this->W[$k]['_TESTRESULT_']['post_date']=date("Y-m-d H:i:s",strtotime($pp[6]));
            $this->W[$k]['_TESTRESULT_']['post_name']=trim($pp[7]);
            $this->W[$k]['_TESTRESULT_']['post_status']='publish';
            }
          }
      }
    function __repairHTML($a,$cod='utf8')  //  �� �������������
      {
      if (is_array($a)){$a=$a[0];}
       $config = array(
           'indent'         => true,
           'show-errors'    => 0,
           'output-xhtml'   => true,
           'wrap'           => 0);
      $tidy = new tidy();
      $tidy->parseString ($a,$config,trim($cod));
      $tidy->cleanRepair();
      return $tidy->value;
      }
    function __clearHtml($a) //  �� �������������
      {
      if (is_array($a)){$a=$a[0];}
      $a=preg_replace("/<script(.*)\/script>/Uis",'',$a);
      $a=preg_replace("/<noscript(.*)\/noscript>/Uis",'',$a);
      $a=preg_replace("/<style(.*)\/style>/Uis",'',$a);
      $a=preg_replace("/<!--(.*)-->/Uis",'',$a);
      return $a;
      }
    function __c_convert($a,$b)
      {
      if (is_array($b)){$data=$b[0];$from=trim($b[1]);$to=trim($b[2]);}
      foreach ($this->W as $k=>$v)
        {
        $id=$k;
          if ($this->is_var($data))
            {
             $raw=$this->W[$id][$data];
             $this->W[$id][$data]=iconv("$from//IGNORE","$to//IGNORE",$raw);
            }
          else
            {
             //$raw=$this->G[$data];
             //$this->G[$data]=iconv("$from//IGNORE","$to//IGNORE",$raw);
            }
        }
      }
    function __c_copy($a,$b)
      {
      if (is_array($b)){$data=$b[0];}
      foreach ($this->W as $k=>$v)
        {
         if ($this->is_var($data))
          {
          $data=$this->W[$k][$data];
          }
        $this->W[$k][$a]=$data;
        }
      }
    function __c_dump($a,$b)
      {
      if (is_array($b)){$data=$b[0];}
      foreach ($this->W as $k=>$v)
        {
        if ($this->is_var($data)){$data=$this->W[$k][$data];}
        ob_start();
        var_dump($data);
        $dump=ob_get_contents();
        ob_end_clean();
        $this->W[$k]['_TESTRESULT_'][$a].=$dump;
        }
      }
    function __c_striphtml($a,$b)
      {
      if (is_array($b)){$data=$b[0];}
      foreach ($this->W as $k=>$v)
        {
        if ($this->is_var($data)){$data=$this->W[$k][$data];}

        $data=strip_tags($data);
        $this->W[$k][$a]=$data;
        }
      }
    function __c_replace($a,$b)
      {
      if (is_array($b)){$c=$b[0];$nc=$b[1];$wh=$b[2];}
      foreach ($this->W as $k=>$v)
        {
        if ($this->is_var($c)){$c=$this->W[$k][$c];}
        if ($this->is_var($nc)){$nc=$this->W[$k][$nc];}
        if ($this->is_var($wh)){$wh=$this->W[$k][$wh];}
        $this->W[$k][$a]=str_ireplace($c,$nc,$wh);
        }
      }
    function __c_addmore($a,$b)
      {
      if (is_array($b)){$c=$b[0];$after=intval($b[1]);$bool=$b[2];}
      foreach ($this->W as $k=>$v)
        {
        if ($this->is_var($c)){$c=$this->W[$k][$c];}
        if ($this->is_var($after)){$c=$this->W[$k][$after];}
        $text='';
        $text=substr($c,0,$after);
         if ($bool)
          {
           $space=strrpos($text,' ');
           $t1='';$t2='';
           if (!empty($space))
            {
             $t1=substr($c,0,$space);
             $t2=substr($c,$space);
            }
           else
            {
            $t1=$c;
            }
          $this->W[$k][$a]=$t1.'<!--more-->'.$t2;
          }
         else
          {
          $this->W[$k][$a]=substr($c,0,$after).'<!--more-->'.substr($c,$after);
          }
        }
      }
  }
?>
