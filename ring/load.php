<?php

   global $wpdb;
   define (__wDir__,WP_PLUGIN_DIR.'/elsa-grabber/');
   define (__wUrl__,WP_PLUGIN_URL.'/elsa-grabber/');

   define (__tTask__,$wpdb->prefix.'elsagrtask');




    require_once(__wDir__.'ring/class.task.php');
    require_once(__wDir__.'ring/class.parser.php');
    require_once(__wDir__.'ring/function.php');



 $_wa = array (
              'elsa-opt-domen'=>array('a'=>1,'b'=>'','d'=>__('Домен, на который выдан ключ','ELSAGR')),
              'elsa-opt-key'=>array('a'=>1,'b'=>'','d'=>__('Ключ плагина','ELSAGR')),
              'elsa-opt-jquery'=>array('a'=>1,'b'=>'','d'=>__('Подключать jQuery','ELSAGR')),
              'elsa-opt-imgdir'=>array('a'=>1,'b'=>'','d'=>__('Папка для загрузок','ELSAGR')),
              'elsa-opt-imgurl'=>array('a'=>1,'b'=>'','d'=>__('Урл к папке с загрузками','ELSAGR')),
              'elsa-opt-setlinks'=>array('a'=>1,'b'=>'','d'=>__('Куда прописывать линки на плагин','ELSAGR')),
              'elsa-opt-timelimit'=>array('a'=>1,'b'=>'','d'=>__('Максимальное время выполнения','ELSAGR')),
              'elsa-opt-version'=>array('a'=>0,'b'=>'4.0.1','d'=>__('Текущая версия плагина','ELSAGR')),
              'elsa-opt-lang'=>array('a'=>1,'b'=>'en','d'=>__('Язык','ELSAGR')),
              'elsa-opt-lasttryupd'=>array('a'=>0,'b'=>'','d'=>__('Последний запрос обновлений','ELSAGR'))


              );

 $_wopt=array();



 foreach ($_wa as $k=>$v)
  {
   $_wopt[$k]['b']=get_option($k);
   $_wopt[$k]['a']=$v['a'];
   $_wopt[$k]['d']=$v['d'];
  }






  set_time_limit(intval($_wopt['elsa-opt-timelimit']['b']));


if (trim($_wopt['elsa-opt-jquery']['b'])=='yes')
    {
    wp_register_script('elsagrjquery',  __wUrl__.'ext/jquery-1.8.3.min.js');
    wp_enqueue_script('elsagrjquery');
    }
if (is_admin()){

  wp_register_style('elsagrstyle', __wUrl__.'rs/style.css');
  wp_enqueue_style( 'elsagrstyle');

  $locale=elsagrLangToLocale($_wopt['elsa-opt-lang']['b']);


  $f=__wDir__.'lang/jsstring_'.$locale.'.js';
  $f_url=__wUrl__.'lang/jsstring_'.$locale.'.js';
    if (file_exists($f))
      {
        wp_register_script('elsagrjslang',$f_url);
        wp_enqueue_script('elsagrjslang');
      }
    else
      {
        wp_register_script('elsagrjslang',__wUrl__.'lang/jsstring_en_EN.js');
        wp_enqueue_script( 'elsagrjslang');
      }





  wp_register_script('elsagrjs',  __wUrl__.'ring/function.js' );
  wp_enqueue_script( 'elsagrjs');    }








?>
