<?php

  class parser
    {
     var $_task;
     var $_VARS=array();
     var $_RESULT=array();
     var $_error='';
     var $_inter=array();
     var $_test=false;

    function parser($a)
      {
              $now=$a;
          foreach ($now as $k=>$v)
            {
            $T[$k]=stripslashes($v);
            }
      $this->_task=$T;
      }

    protected function beforeRun($a)
      {
      $this->initRss($this->_task['rss']);


        $ex=explode(';',$a);
          foreach ($ex as $run)
            {
            if (($run[0].$run[1])==='//'){continue;}
            if (strlen($run)<2){continue;}
            $this->runLine($run);
            }

      }


    function runLine($a,$r=false,$pref='')
      {
      if ((strlen($a))<2){return false;}
      $ex=explode('=',$a);
        if (sizeof($ex)<2)
          {
          $var='';      //нигже не выполняется
          $do=$a;
          }
        else
          {
          $var=trim($ex[0]);
          $do=trim($ex[1]);
          }
      if (sizeof($ex)>2)  //в тексте задания есть "="
        {
        $var=trim($ex[0]);
        $do=trim(join('=',array_splice($ex,1)));

        }

       $param=trim(strstr($do,'('));
        $func=str_replace($param,'',$do);
        $func=str_replace('#','',$func);

        //print '<b>'.$var.'</b><br>';
       $param=substr($param,1,strrpos($param,")")-1);

       $ex2=explode(',',$param);
       unset($value);
       $value=array();
        if (sizeof($ex2)==0)
          {
          $value[0]=$param;
          }
        else
          {
           foreach($ex2 as $v)
            {
            $value[sizeof($value)]=trim($v);

            }
          }
      //////////
         //инициализация переменных
           for ($j=0;$j<sizeof($value);$j++)
            {
            $now=$value[$j];

            if ($this->isVars($now))
              {
             // $key=str_replace('%','',$now);
             $now=$this->mytrim($now);
              $key=substr($now,strpos($now,'%')+1);
              $key=str_replace(strrchr($now,'%'),'',$key);
               //echo "<hr>$now<h2>$key</h2>";
               if (is_array($this->_VARS[$key]))
                {
                $value[$j]=$this->_VARS[$key];
                }
               else
                {
                $value[$j]=str_replace("%$key%",$this->_VARS[$key],$value[$j]);
                }



              //print( '@@-'.$this->_VARS["$key"].'<br><hr>');
              }
            }



      //////
        if (empty($var))
          {
           $tmpvar=$this->$func($value);    //не выполняется нигде
          }
        else
          {
           unset($res);
           $res[0]=trim(str_replace('%','',$var));
           $res[1]=$this->$func($value);

           if ($r){$this->addVars($res,true,$pref);}
           $this->addVars($res);
          }
      }

    function run($test=false)
      {
       $a=$this->_task;
       $this->_test=$test;
       $text=$a['text'];

       $ex=explode('DO',$text);
         $beforerun=trim($ex[0]);
       $ex1=explode('END',$ex[1]);
          $afterrun=trim($ex1[1]);
          $run=trim($ex1[0]);

      $this->beforerun($beforerun);

      $rsst=$this->getVars();
      $rss=$rsst['_RSS_'];


        foreach ($rss->channel->item as $item)
        {
         $ex2=explode(';',$run);

          unset($res);
          unset($this->_VARS['_ITEM_']);
          $res[0]='_ITEM_';
          $res[1]=$item;
          settype($res[1],"Array");
          $this->addVars($res);

          foreach($ex2 as $line)
            {
            $nnn=$this->mytrim($line);
            if ($nnn[0]=='#') {continue;}
            $this->runLine($line,true,$pref);

            }
        if ($test){break;}

        }
      }

    function afterrun($a=false)
      {
       if ($a)
        {
        //echo '<pre>';
        var_dump($this->getResult());
        //echo '</pre>';
        }
      }
    function addVars($a,$r=false,$pref='')
      {
       if ($r)
        {
        $this->_RESULT['new_'.$pref][]=$a;
        }
       else
        {
        $this->_VARS[$a[0]]=$a[1];
        }
      }


    function initRss()
      {
      if (empty($this->_task['rss'])){$this->_error='initRss:: Передана пустой параметр Rss';return false;}
      unset($res);
      $res[0]='_RSS_';
      $res[1]=simplexml_load_file(trim($this->_task['rss']));
      $this->addVars($res);
      }
    function getVars()
      {
      return $this->_VARS;
      }
    function getResult()
      {
      return $this->_RESULT;
      }
    function repairHTML($a,$cod='utf8')
      {
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
    function parseHtml()
      {
       ///require_once(_PATCH_.'/libs/simple_html_dom.php');

      }
    function isVars($a)
      {
        if (preg_match("/%(.*)%/",$a)==1)
          {
          return true;
          }
        else
          {
          false;
          }
      }
    function mytrim($a)
      {
        $max=strlen($a);
        $out='';
          for ($i=0; $i<$max;$i++)
            {
            $char=$a[$i];
            $ord=ord($char);
              if (($ord<32)||(($ord>126) && ($ord<160)))
                {
                continue;
                }
              else
                {
                $out.=$a[$i];
                }
            }

      return trim($out);
      }
    //////////////////////////
    function _copy($a)
      {
      return $a[0];
      }
    function _init($a)   //не рабочий
      {
      return $this->addVars($a[0]);
      }
    function _ext($a)
      {
      if ($a[0]=='_RSS_'){$rss=$this->_VARS['_RSS_'];}
      if ($a[0]==='_RSS_')
      {
       $ex=explode('->',$a[1]);
        foreach ($ex as $l)
          {
          $z.='->'.$l;
          }
       $z2=str_replace('->','/',$a[1]);
       $z2='/rss/'.$z2.'/text()';
       $need=$rss->xpath($z2);
       $ret=$need[0];
       settype($ret,"string");

      return $ret;
      }
      else
      {
      // var_dump($a[0][$a[1]]);
      // echo '<hr>';
       return $a[0][$a[1]];
      }
      }
    function _get($a)
      {
       $out=join('',file($a[0]));
       return $out;
      }
    function _extHtml($a)
      {
      $data=$a[0];

      $xpath=$this->mytrim($a[1]);
      $xpath=stripslashes($xpath);
      if (empty($a[2])) {$cod="utf8";} else {$cod=trim($a[2]);}
      if (empty($a[3])){$need='value';}else{$need=trim($a[3]);}
      $data=$this->repairHTML($data,$cod);

       	$dom = new DOMDocument();
	      @$dom->loadHTML($data);
       $x = new DOMXPath( $dom );
       $_res = $x->query($xpath);


       unset($out);
       $out='';

      if ($need==='value')
        {
         foreach ($_res as $l)
         {
         $out.=$l->nodeValue;
         }
        }
       else
        {
         foreach ($_res as $l)
         {
         $out.=$l->getAttribute($need);
         }
        }
      //print $out;
      return $out;
      }

    function _clearHtml($a)
      {
      $data=$a[0];
      $out=preg_replace("/<script(.*)<\/script>/Uis",'',$data);
      return $out;
      }
    function _setAttr($a)
      {
       $tag=$a[0];
       $attr=array_splice($a,1);
        $all=join(' ',$attr);
       return str_replace('>',' '.$all.'>',$tag);
      }
    function _dump($a)
      {
      var_dump($a[0]);
      }
    function _makeTag($a)
      {
      $tag=$a[0];
      return "<$tag>";
      }
    function _join($a)
      {
      return join('',$a);
      }
    function _saveToFile()
      {


      }
    function _stripHTML($a)
      {
      return strip_tags($a[0]);
      }
    function _setEncoding($a)
      {
      return str_replace('</head>','<meta http-equiv="Content-Type" content="text/html; charset='.$a[1].'" /></head>',$a[0]);
      }
    function _strReplace($a)
      {
      //Echo '<pre>';
      //var_dump($a);
      //echo '</pre>';
      return  str_replace(trim($a[1]),trim($a[2]),trim($a[0]));
      }
    function _loadFtp($a)
      {
       require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
       $elsa_absimgpatch=get_option('elsa_absimgpatch',false);
       $elsa_imgurl=get_option('elsa_imgurl',false);
       $elsa_site=get_option('siteurl',false);

       $link=trim($a[0]);
       $ex=explode('.',$link);

       $ras=$ex[sizeof($ex)-1];
       $ras=trim($ras);
       $h1=md5($link);

        $tmpimg_name=$h1.'.'.$ras;

        if(file_exists($elsa_absimgpatch.$tmpimg_name)) {return $elsa_imgurl.$tmpimg_name;}

       if ((copy ($link,$elsa_absimgpatch.$tmpimg_name)))
        {
        return trim($elsa_imgurl.$tmpimg_name);
        }
       else
        {
        return plugin_dir_url(get_option('elsa_pluginpatch',false).'/images/h').'uncopy.gif';
        }
       }
     function _addMore($a)
      {
       $text=$a[0];
       $chars=$a[1];

       $text_350=substr($text,0,$chars);

       $text_split=strrpos($text_350,' ');
       //echo  "<h1>$text_split</h1>";
       $text_1=substr($text,0,$text_split);
       $text_2=substr($text,$text_split);
       return $text_1.'<!--more-->'.$text_2;
      }
    function _iconv ($a)
      {
      $t=$a[0];
      //return mb_detect_encoding($a[0],"auto");
      $e1=trim($a[1]);
      $e2=trim($a[2]).'//IGNORE';
      return iconv($e1,$e2, $t);
      //return iconv ("cp1251","UTF-8//IGNORE",$t);
      //print iconv(trim($a[1]),trim($a[2])."//IGNORE", $t);
      }
      
    function _insertPost($a)
      {
        if (strlen($a[5])<300){return 0;}
        $post = array(
        'post_title' => trim($a[0]),
        'post_author' => $a[1],
        'post_type' => $a[2],
        'tags_input' => $a[3],
        'post_category' => array($a[4]),
        'post_content' => $a[5],
        'post_date' => date("Y-m-d H:i:s",strtotime($a[6])),
        'post_name' => $a[7],
        'post_status' => 'publish');

        require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

             $link=get_option('elsa_links',false);
             if ($link==='link2')
              {
              $post['post_content'].='<br><br><p align="right"><font size="1">Запись опубликована с помощью <a target="_elsasites" href="http://elchepunebrek.ru/novyj-plagin-grabber-dlya-wp.html">ElSa grabber</a></font></p>';
              }
              
        if ($this->_test)
          {
          echo "<h2>Результат выполнения задания</h2>";
           // <pre>";
            var_dump($post);
           // echo "</pre>";
          }
        else
          {
          $title=trim($a[0]);
          global $wpdb;
          $havepost=$wpdb->get_row("select * from $wpdb->posts where post_title='$title'");
          if (empty($havepost))
            {
             $new=wp_insert_post($post,$wp_error);
            }


          }
      //var_Dump($this->_test);
      }
    }
    
?>
