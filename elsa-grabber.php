<?php
/*
Plugin Name: ElSa-grabber
Plugin URI: http://savitov.ru/ELSAGR
Description: Граббер RSS лент
Version: 4.0.4
Author: Savitov
Author URI: http://Savitov.ru
*/
require_once(WP_PLUGIN_DIR.'/'.dirname(plugin_basename( __FILE__ )).'/ring/load.php');
function elsa_opt()
  {
   require_once('rs/templates/_maintext.php');
  }
function elsaShowOpt()
  {
  require_once('elsa-options.php');
  }
function elsaShowTask()
  {
  require_once('elsa-task.php');
  }
function elsaShowUpd()
  {
  require_once('elsa-update.php');
  }
function elsa_menu()
  {
  $newnemu=add_menu_page('ELSA grabber','ELSA grabber',10,'elsa-grabber/elsa-grabber.php','elsa_opt');
  add_submenu_page('elsa-grabber/elsa-grabber.php', __('Задания','ELSAGR'), __('Задания','ELSAGR'),10,'elsa-task.php','elsaShowTask');
  add_submenu_page('elsa-grabber/elsa-grabber.php', __('Параметры','ELSAGR'), __('Параметры','ELSAGR'),10,'elsa-options.php','elsaShowOpt');
  add_submenu_page('elsa-grabber/elsa-grabber.php', __('Обновление','ELSAGR'), __('Обновление','ELSAGR'),10,'elsa-update.php','elsaShowUpd');
  }
add_action('admin_menu', 'elsa_menu');
add_action('init', 'elsagrloadlang');
add_action('wp_footer', 'elsa_footer',100);
add_action('get_footer', 'elsa_footer',100);


register_activation_hook( __FILE__, 'elsagr_activation');
register_deactivation_hook( __FILE__, 'elsagr_deactivation' );
?>
