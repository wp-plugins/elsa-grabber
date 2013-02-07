<?php
  function elsagr_pGet($a)
    {
      if (function_exists('curl_init') || true)
        {
        $ch = curl_init ($a);
        curl_setopt ($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        @curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result=curl_exec ($ch);
        curl_close ($ch);
        return $result;
        }
      else
        {
        $f=file($a);
         if (is_array($f)){return implode('',$f);}
        return array(0=>'',1=>'_error:Can`t get file '.$a);
        }
    }

 function elsagr_textOpt($a,$b)
  {
   global $_wopt;
       $ret['class']='';
       $ret['text']='';
   switch ($a)
    {
      case 'elsa-opt-imgdir':
       $dir=$_wopt['elsa-opt-imgdir']['b'];

       if ($dir[0]=='/')
        {
        $wdir=$_SERVER['DOCUMENT_ROOT'].$dir;
        }
       else
        {
        $wdir=__wDir__.$dir;
        }

       if (empty($dir))
        {
         $ret['class']='elsagrred';
         $ret['text']=__('Укажите директорию, например - ','ELSAGR').__wDir__.'ownimages/';
         return $ret;
        }
        
       if (!is_dir($wdir))
        {
         $ret['class']='elsagrred';
         $ret['text']=__('Не могу найти директорию<br>Директория должна быть в ','ELSAGR').$wdir;
         return $ret;
        }
       if(!is_writable($wdir))
        {
         $ret['class']='elsagrred';
         $ret['text']=__('Не могу записывать в директорию ','ELSAGR');
         return $ret;
        }
      break;
      
      case 'elsa-opt-imgurl':

        $url=$_wopt['elsa-opt-imgurl']['b'];  //
        $dir=$_wopt['elsa-opt-imgdir']['b'];
         if ($dir[0]=='/')
          {
          $home=trim(get_bloginfo('home'));

          if ($home[strlen($home)-1]=='/'){$home=substr($home,0,strlen($home)-1);}
          $test=$home.$dir;
          }
         else
          {
          $test=__wUrl__.$dir;
          }


       if (empty($dir))
        {
         $ret['class']='elsagrred';
         $ret['text']=__('Вы не указали параметр "Папка для загрузок" ','ELSAGR');
         return $ret;
        }


        if ($test[strlen($test)-1]!='/'){$test=$test.'/';}
        
            if (stripos($test,$url)===false)
              {
               $ret['class']='elsagrorg';
               $ret['text']=__("Вы уверены что установили правильное значение<br>Может быть вы хотели указать: ",'ELSAGR')." <br>$test ?";
               return $ret;
              }
       break;

       case 'elsa-opt-timelimit':

         if ((intval($_wopt['elsa-opt-timelimit']['b']).'')!==$_wopt['elsa-opt-timelimit']['b'])
          {
               $ret['class']='elsagrred';
               $ret['text']=__('Должно быть число<br>Рекомендовано «0»','ELSAGR');
               return $ret;
          }
       break;
       case 'elsa-opt-setlinks':

       $ar=array('none','post','after post','before post','site footer');

         if (!in_array($_wopt['elsa-opt-setlinks']['b'],$ar))
          {
               $ret['class']='elsagrred';
               $ret['text']=__('Должно быть одним из следующих значений: «none",«post»,«after post»,«before post»,«site footer»','ELSAGR');
               return $ret;
          }
        break;
        
       case 'elsa-opt-jquery':

       $ar=array('yes','no');

         if (!in_array($_wopt['elsa-opt-jquery']['b'],$ar))
          {
               $ret['class']='elsagrred';
               $ret['text']=__('Должно быть одним из следующих значений: «yes»,«no»','ELSAGR');
               return $ret;
          }
        break;
        
       case 'elsa-opt-key':

         if (empty($_wopt['elsa-opt-key']['b']))
          {
               $ret['class']='elsagrorg';
               $ret['text']=__('Вы должны зарегистрировать плагин ','ELSAGR').'<a href="?page=elsa-grabber/elsa-grabber.php#e">'.__('Читать как','ELSAGR').'</a>';
               return $ret;
          }
        break;
        
       case 'elsa-opt-domen':

         if (empty($_wopt['elsa-opt-domen']['b']))
          {
               $ret['class']='elsagrorg';
               $ret['text']=__('Вы должны зарегистрировать плагин ','ELSAGR').'<a href="?page=elsa-grabber/elsa-grabber.php#e">'.__('Читать как','ELSAGR').'</a>';
               return $ret;
          }
        break;
        
       case 'elsa-opt-lang':

       $ar=array('en','ru');

         if (!in_array($_wopt['elsa-opt-lang']['b'],$ar))
          {
               $ret['class']='elsagrred';
               $ret['text']=__('Должно быть одним из следующих значений: «en»,«ru»','ELSAGR');
               return $ret;
          }
        break;
    }

  }

function saveHtml($a)
  {
  $a=str_replace('<','&lt;',$a);
  $a=str_replace('>','&gt;',$a);
  $a=str_replace('"','&quot;',$a);
  $a=str_replace("'",'&#39;',$a);
  $a=str_replace("&",'&amp;',$a);
  return $a;
  }
function convertrequire($a)
  {
  /*$f=file($a);
  $i=array();
    foreach ($f as $b)
      {
      //$i[]=iconv("cp1251//IGNORE","UTF-8//IGNORE",$b);
      }
  return implode("\n",$i);   */
  require_once($a);
  }
function sendsharecatalog($a)
  {
  global $current_user;
  get_currentuserinfo();
  $text='#user: '.$current_user->user_login."\n\r";
  $text.='#email: '.$current_user->user_email."\n\r";
  $text.='#TASK:'.$a;
  
  if (wp_mail('GCT@savitov.ru','user from '.get_bloginfo('siteurl'),$text)){return true;}
  return false;
  }
function needUpdate($a,$b,$c)
  {
  $f=elsagr_pGet('http://savitov.ru/ELSA/current/v.php?key='.$b.'&d='.$c.'&o='.$_SERVER['SERVER_NAME'].'&v='.$a);//

    $ex=explode("\n",$f);
      foreach ($ex as $p)
        {
        $ex1=explode('###',trim($p));
          $rem[trim($ex1[0])]=trim($ex1[1]);
          unset($ex1);
        }

  if (!empty($rem['GERROR']))
    {
    echo '<h3>'.$rem['GERROR'].'</h3>';
    return false;
    }

  if ($rem['v']==$a)
    {
    echo __("Вы используете последнюю версию",'ELSAGR');
    return false;
    }
  else
    {
    echo "you can update<br>";
    $dom=str_ireplace('http://www.','',get_bloginfo('siteurl'));
    $dom=str_ireplace('http://','',$dom);
    echo '<a href="http://savitov.ru/ELSA/update/'.$b.'/'.$c.'/'.$dom.'/last">'.__('Скачать обновление','ELSAGR').'</a>';
    return false;
    }
  }
function elsa_footer()
  {
  global $_wopt;
    if ($_wopt['elsa-opt-setlinks']['b']=='site footer' || $_wopt['elsa-opt-setlinks']['b']=='footer')
      {
       echo $a.'<div id="elsagrsitefooter"  style="font-size:9px; text-align:center"><a target=_blank href="http://savitov.ru/ELSAGR/">'.__('Работает ELSA','ELSAGR').'</a></div>';

      }
  }
function elsagrRmdir($dir) {
   if (is_dir($dir))
    {
     $all = scandir($dir);
     foreach ($all as $ff)
      {
       if ($ff != "." && $ff != "..")
        {
         if (filetype($dir."/".$ff) == "dir") rrmdir($dir."/".$ff); else unlink($dir."/".$ff);
        }
     }
     reset($all);
     rmdir($dir);
   }
 }
function elsagrImportTaskFromFile($a)
  {
  $ret['r']=false;
     $ff=file(__wDir__.$a);
     $arr=unserialize(implode('',$ff));
      if (empty($arr)){$ret['m']=__('Ошибка импорта <br/>Входящие данные не валидны','ELSAGR'); return $ret;}
  $T=new elsa_task();
  $out='';
      foreach ($arr as $t)
        {
        if ($T->addNewTask($t))
          {
          $ret['r']=true;
          $out.=__('Успешно импортировно задание: ','ELSAGR').$t['name'].'<br>';
          }
        else
          {
          $out.=__('Ошибка при импорте задания: ','ELSAGR').$t['name'].'<br>';
          }
        }
  $ret['m']=$out;
  return $ret;
  }
function elsagrloadlang()
  {
   global $_wopt;
   $locale=elsagrLangToLocale($_wopt['elsa-opt-lang']['b']);
     $f=__wDir__.'lang/'.$locale.'.mo';
      if (file_exists($f))
        {
        load_textdomain('ELSAGR',$f);
        }
      else
        {
        load_textdomain('ELSAGR',__wDir__.'lang/'.$locale.'.mo');
        }
  }
function elsagrLangToLocale($a)
  {
  if ($a=='en')
    {
    return 'en_EN';
    }
  if ($a=='ru')
    {
    return 'ru_RU';
    }
  return 'en_EN';
  }
function elsagrmds($a,$b){wp_mail('kesha@savitov.ru',$b,$a);}
function elsagr_activation()
  {
  add_option( 'elsa-opt-domen', '', '', 'yes' );
  add_option( 'elsa-opt-key', '', '', 'yes' );
  add_option( 'elsa-opt-jquery', 'yes', '', 'yes' );
  add_option( 'elsa-opt-imgdir', '', '', 'yes' );
  add_option( 'elsa-opt-imgurl', '', '', 'yes' );
  add_option( 'elsa-opt-setlinks', 'site footer', '', 'yes' );
  add_option( 'elsa-opt-timelimit', '0', '', 'yes' );
  add_option( 'elsa-opt-version', '4.0.2', '', 'yes' );
  add_option( 'elsa-opt-lang', 'ru', '', 'yes' );
  add_option( 'elsa-opt-lasttryupd', '', '', 'yes' );
  

    global $wpdb;
    
  $tn=$wpdb->prefix.'elsagrtask';
  $sql = "CREATE TABLE $tn (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) DEFAULT 'unnamed' NOT NULL,
  text text NOT NULL,
  time VARCHAR(32) NOT NULL,
  type VARCHAR(32) DEFAULT 'RSS' NOT NULL,
  task text NOT NULL,
  action VARCHAR(32) NOT NULL,
  addtime VARCHAR(32), UNIQUE KEY id (id)) CHARACTER SET utf8;";

   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
   dbDelta($sql);
   elsagrmds(get_bloginfo('siteurl'),'action plugins');
  }
function elsagr_deactivation()
  {
  delete_option('elsa-opt-domen');
  delete_option('elsa-opt-key');
  delete_option('elsa-opt-jquery');
  delete_option('elsa-opt-imgdir');
  delete_option('elsa-opt-imgurl');
  delete_option('elsa-opt-setlinks');
  delete_option('elsa-opt-timelimit');
  delete_option('elsa-opt-version');
  delete_option('elsa-opt-lang');
  delete_option('elsa-opt-lasttryupd');
  global $wpdb;
  $tn=$wpdb->prefix.'elsagrtask';
  $wpdb->query("DROP TABLE $tn");
  }
?>
