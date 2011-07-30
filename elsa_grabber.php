<?php
/*
Plugin Name: ElSa_grabber
Plugin URI: http://elchepunebrek.ru/novyj-plagin-grabber-dlya-wp.html
Description: Граббер RSS лент
Version: 3.0.1
Author: Elchepunebrek, Savitov
Author URI: http://Elchepunebrek.ru, http://Savitov.ru
*/

function elsa_selfmenu()
  {
   $elsamo=WP_PLUGIN_DIR.'/'.dirname( plugin_basename( __FILE__ ) ) . '/language/'.get_locale().'.mo';
   load_textdomain('elsagrabber',$elsamo);
   //echo $elsamo;
  ?>
  <div class="wrap">
  <div id="elsa_left">
  
     <h2><?php _e('The panel of manager ElSa Grabber','elsagrabber');?> </h2>

    <h3><?php _e('The list of tasks','elsagrabber');?></h3>
  <ul class="tabs">
    <li><a href="#tab1" class="elsa_A"><?php _e('The list of tasks','elsagrabber');?></a></li>
    <li><a href="#tab2" class="elsa_A"><?php _e('Add/Edit task','elsagrabber');?></a></li>
  </ul>
  <div class="tab_container">
    <div id="tab1" class="tab_content">
        <?php
        $UP=get_option('elsa_pluginpatch',false).'/';
        $task=new task($UP.'task/');
        $up2=plugin_dir_url(__FILE__);
        //echo  "<h1>$up2</h1>";
        $up3=WP_PLUGIN_DIR;
        $mess='';
        

        if (isset($_REQUEST['elsa_change_patch']))
          {
           update_option('elsa_absimgpatch',$_REQUEST['elsapatches_abs']);
           update_option('elsa_imgurl',$_REQUEST['elsapatches_url']);
           update_option('elsa_links',$_REQUEST['elsa_linksoption']);

          }

        if (isset($_REQUEST['deletetask']) && (!empty($_REQUEST['deletetask'])))
          {
           $t=$task->delTask('filename='.$_REQUEST['deletetask']);
            if (!$t) {$mess=$task->_error;}
          }

        if (isset($_REQUEST['tadd']) && (!empty($_REQUEST['tadd'])) && (isset($_REQUEST['tfilename'])))
          {
           $new=array();
           $new['name']=stripslashes($_REQUEST['tname']);
           $new['time']=stripslashes($_REQUEST['ttime']);
           $new['rss']=stripslashes($_REQUEST['trss']);
           $new['info']=stripslashes($_REQUEST['tinfo']);
           $new['text']=stripslashes($_REQUEST['ttext']);
           $new['filename']=stripslashes($_REQUEST['tfilename']);


           $t=$task->addTask($new);
            if (!$t) {$mess=$task->_error;}
          }

        if (isset($_REQUEST['playtask']) && (!empty($_REQUEST['playtask'])))
          {
           $tempplay=get_option('elsa_playtask',false);
           $tempplay=unserialize($tempplay);

           $tempplay[$_REQUEST['playtask']]=true;
           $tempplay=serialize($tempplay);
           update_option('elsa_playtask',$tempplay);
          }
        if (isset($_REQUEST['stoptask']) && (!empty($_REQUEST['stoptask'])))
          {
           $tempplay=get_option('elsa_playtask',false);
           $tempplay=unserialize($tempplay);
           $tempplay[$_REQUEST['stoptask']]=false;
           $tempplay=serialize($tempplay);
           update_option('elsa_playtask',$tempplay);
          }

        unset($play);
        $play=get_option('elsa_playtask',false);
        if (!is_array($play)) {$play=unserialize($play);}

          $all=$task->getTask();
            foreach ($all as $t)
              {
              $out='';
              $out.='<div id="elsatask">'.$t['name'].' - '.__('Time run','elsagraber').': '.$t['time'].'; '.__('File','elsagraber').': ['.$t['filename'].']';
              $out.='<a href="'.$up2.'_deltask.php?KeepThis=true&modal=true&deltask='.$t['filename'].'" class="thickbox"><img src="'.$up2.'images/delete.png"></a>';
              $out.='<a href="javascript:void(0)" onclick="editTask(\''.$t['filename'].'\')"><img src="'.$up2.'images/edit.png"></a>';

              if ($play[$t['filename']]==true)
                {
                 $out.='<a href="?stoptask='.$t['filename'].'&page='.$_REQUEST['page'].'"><img src="'.$up2.'images/stop.png"></a>';
                 $out.='<img src="'.$up2.'images/grey.png">';
                }
              else
                {
                 $out.='<img src="'.$up2.'images/grey.png">';
                 $out.='<a href="?playtask='.$t['filename'].'&page='.$_REQUEST['page'].'"><img src="'.$up2.'images/play.png"></a>';
                }
              $out.='<a href="'.$up2.'_viewtask.php?KeepThis=true&modal=true&elsadir='.$up3.'&viewtask='.$t['filename'].'&width=700" class="thickbox"><img src="'.$up2.'images/view.png"></a>';

              $out.='</div>';
              echo $out;

              }
        echo '<br>'.$mess;
        ?>
    </div>

    <div id="tab2" class="tab_content">
     <form action="" method="post" name="edit_add">
      <?php _e('Title','elsagrabber');?><br>
      <input type="text" name="tname" value="" class="inp"><br>
      <?php _e('Time run','elsagrabber');?><br>
      <input type="text" name="ttime" value="" class="inp"><br>
      <?php _e('RSS adress','elsagrabber');?><br>
      <input type="text" name="trss" value="" class="inp"><br>
      <?php _e('Information','elsagrabber');?><br>
      <input type="text" name="tinfo" value="" class="inp"><br>
      <input type="hidden" name="tfilename" value=""><br>
      <?php _e('Content task','elsagrabber');?><br>
      <textarea name="ttext" class="textinp"></textarea>
      <br><br>
      <input type="submit" name="tadd" value="<?php _e('Add/Edit task','elsagrabber');?>"> <input type="reset" name="tclear" value="<?php _e('Clear','elsagrabber');?>">

     </form>
    </div>
  </div>
<h2>&nbsp;</h2><h3><?php _e('Patch','elsagrabber');?></h3>
<form action="" name="elsa_patches" method="post">
<?php _e('Absolute way to a directory with images','elsagrabber');?><br>
<input type="text" name="elsapatches_abs" value="<?=get_option('elsa_absimgpatch',false);?>" class="inp2"><br>
<br><?php _e('URL to a directory with images','elsagrabber');?><br>
<input type="text" name="elsapatches_url" value="<?=get_option('elsa_imgurl',false);?>" class="inp2">
<h3><?php _e('Links on plugin','elsagrabber');?></h3>
<select size="1" name="elsa_linksoption">
	<option value="link1" <?php if(get_option('elsa_links',false)==='link1') echo 'selected';?>><?php _e('In footer','elsagrabber');?></option>
 <option value="link2" <?php if(get_option('elsa_links',false)==='link2') echo 'selected';?>><?php _e('In posts','elsagrabber');?></option>
 <option value="link3" <?php if(get_option('elsa_links',false)==='link3') echo 'selected';?>><?php _e('Not put','elsagrabber');?></option>
	</select>
<br><br>
<input type="submit" name="elsa_change_patch" value="<?php _e('Apply','elsagrabber');?>">
</form>

 </div>
<h2>&nbsp;</h2>
<h3><?php _e('Information','elsagrabber');?></h3>
<img src="<?=$up2;?>images/elsalogo.png"><br> <br>
<div id="elsa_right">

<?php
if (isset($_REQUEST['testtask']))
  {
   echo '<div id="elsa_testtask">';
   Echo $task->runTask($_REQUEST['testtask'],true);
   echo '</div>';
  }
?>


  <br><br><br><b><?php _e('Sites of developers','elsagrabber');?>:</b><br>
  <a href="http://elchepunebrek.ru" target="_elche">Elhepunebrek</a><br>
  <a href="http://savitov.ru" target="_savitov">Savitov</a><br>
  <a href="http://vkontakte.ru/club28928982" target="_vkelsa"><?php _e('Page','elsagrabber');?> Vkontakte.ru</a><br>
  <a href="http://www.facebook.com/pages/ElSa-Grabber/245560198797041" target="_elsafa"><?php _e('Page','elsagrabber');?> Facebook.com</a><br><br>
  
<h3><?php _e('It was pleasant? Click!','elsagrabber');?></h3>
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
<fb:like-box href="http://www.facebook.com/pages/ElSa-Grabber/245560198797041" width="400" show_faces="false"
border_color="" stream="false" header="true">
</fb:like-box>

<h3><?php _e('Page of plugin','elsagrabber');?></h3>
<a href="http://elchepunebrek.ru/novyj-plagin-grabber-dlya-wp.html" target="_elsapp"><?php _e('Plugin description','elsagrabber');?> (RU)</a>

</div>
  </div>

    <script language=javascript>

    function editTask(a)
      {
      var tname=getParamTask(a,'name');  document.edit_add.tname.value=tname;
      var ttime=getParamTask(a,'time');  document.edit_add.ttime.value=ttime;
      var trss=getParamTask(a,'rss');    document.edit_add.trss.value=trss;
      var tinfo=getParamTask(a,'info');  document.edit_add.tinfo.value=tinfo;
      var ttext=getParamTask(a,'text');  document.edit_add.ttext.value=ttext;
      var tfilename=getParamTask(a,'filename');   document.edit_add.tfilename.value=tfilename;
      $("ul.tabs li").click();
      
      }
      
    function getParamTask(a,a1)
     {
    var ret='';
    var urlf="<?=plugin_dir_url(__FILE__);?>_globaltask.php";
    var alldata = 'filename='+a+'&need='+a1;
    alldata+='&getparam=true'
       ret=$.ajax({
       url: urlf,
       cache: false,
       error:function (b,b1,b2){alert(b2);},
       async: false,
       data: alldata,
       success: function(html){
         return html;

         }
          }).responseText;
    return ret;
     }
    </script>
    
  <?php
  }
function elsaAddCss()
  {
  $d=plugin_dir_url(__FILE__);
  echo "<link rel='stylesheet' href='{$d}style.css' type='text/css' media='all' />\n";
  echo "<link rel='stylesheet' href='http://savitov.ru/shared/thickbox.css' type='text/css' media='all' />\n";
  }
function elsa_add_menu() {
    $d=plugin_dir_url(__FILE__);
    add_options_page('ElSa Grabber [v 3.0]', 'ElSa Grabber [v 3.0]', 8, __FILE__, 'elsa_selfmenu');
		wp_enqueue_script('jq', 'http://savitov.ru/shared/jquery.js');
		wp_enqueue_script('thickbox', 'http://www.savitov.ru/shared/thickbox.js');
		wp_enqueue_script('elsa_js_file', "{$d}js.js");
    add_action('admin_head', 'elsaAddCss', 999);
    require(get_option('elsa_pluginpatch',false)."/core/loader.php");
}
function elsa_deactive()
  {
  delete_option(elsa_playtask);
  delete_option(elsa_absimgpatch);
  delete_option(elsa_imgurl);
  delete_option(elsa_links);
  delete_option(elsa_pluginpatch);
  }
function elsa_get_footer()
  {
   $elsamo=WP_PLUGIN_DIR.'/'.dirname( plugin_basename( __FILE__ ) ) . '/language/'.get_locale().'.mo';
   load_textdomain('elsagrabber',$elsamo);
  $link=get_option('elsa_links',false);
    if (($link==='link1') || empty($link))
      {
      echo $ELSAHTML='<script language=javascript>
      var elsaElem = document.createElement("div");
      elsaElem.id = "elsa_links";
      var starttext="'.__("On site work ","elsagrabber").'";
      var elsalinktext = starttext+" <a target=\"_elsasites\" href=\"http://elchepunebrek.ru/novyj-plagin-grabber-dlya-wp.html\">ElSa grabber</a>";
      elsaElem.innerHTML="<p align=\"center\"><font size=1>"+elsalinktext+"</font></p>";
       document.body.appendChild(elsaElem);
       </script>';

      }
  }
function  elsa_active()
  {
  add_option( 'elsa_playtask', '', '', 'yes' );
  add_option( 'elsa_absimgpatch', $_SERVER['DOCUMENT_ROOT'].'/wp-content/elsa-grabber/', '', 'yes' );
  add_option( 'elsa_imgurl', get_option('siteurl',false).'/wp-content/elsa-grabber/', '', 'yes' );
  add_option('elsa_links','','','yes');
  add_option('elsa_pluginpatch',dirname(__FILE__),'',yes);
  }
add_action('admin_menu', 'elsa_add_menu');
register_activation_hook( __FILE__, 'elsa_active' );
register_deactivation_hook( __FILE__, 'elsa_deactive' );
add_action('get_footer', 'elsa_get_footer');
?>
