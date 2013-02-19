tIdg='';

tGp=isRunFromDir(window.location.pathname);

function isRunFromDir(a)
  {
  var b=a.replace('/wp-admin/admin.php','');
  return b;
  }

function elsagrSaveparams(b,c)
  {
    if (c==undefined){c=false;}
    elname="#"+b;
    elclass='.'+b;
    a=jQuery(elname).val();
      jQuery(elclass).addClass('elsagr_opthover');
      rt=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrSaveparams&k='+b+'&v='+a,async: false}).responseText;
   if (c){alert(rt);}

  }
function elsagrSaveparam()
  {
   elsagrLoader(1);
   elsagrSaveparams('elsa-opt-domen');
   elsagrSaveparams('elsa-opt-key');
   elsagrSaveparams('elsa-opt-jquery');
   elsagrSaveparams('elsa-opt-imgdir');
   elsagrSaveparams('elsa-opt-imgurl');
   elsagrSaveparams('elsa-opt-setlinks');
   elsagrSaveparams('elsa-opt-timelimit');
   elsagrSaveparams('elsa-opt-lang');
    window.setTimeout('elsagrSaveparamclear()','1000');
  }
function elsagrSaveparamclear()
  {
   jQuery(".elsa-opt-timelimit, .elsa-opt-domen, .elsa-opt-key, .elsa-opt-jquery, .elsa-opt-imgdir, .elsa-opt-imgurl, .elsa-opt-setlinks").removeClass('elsagr_opthover');
    window.location.href=window.location.href;
  }
function elsagrLoader(a)
  {
  if (a==1 || a=='1')
    {
     jQuery("#elsagrmw").css('display','block');
    }
  else
    {
    jQuery("#elsagrmw").css('display','none');
    }
  }
function elsagrCloseWin()
  {
  jQuery("#elsagrmodalwin").css('display','none');
  jQuery("#elsagr_winselfmiddle").html('');
  jQuery("#elsagrwt").text('');
  }
jQuery(document).ready(function(){
  if (parseInt(jQuery("#elsagrmodalwin").length)!=0){return '';}
  jQuery(document.body).append("<div id='elsagrmodalwin'></div>");
  jQuery("#elsagrmodalwin").load(tGp+'/wp-content/plugins/elsa-grabber/rs/templates/_window.html');
     // html='';
      jQuery(document.body).prepend('<div id="elsagrmw"><div id="elsagrwmself"><b>'+STR.m+'</b></div></div>');

 // elsagrTestTask(25);
});
function elsagrLoadTemlModal(a,b,c)
  {
   elsagrLoader(1);
   if (b==undefined || b==''){b='html';}
   if (c==undefined || c==''){c='';}else {c='?'+c;}

   jQuery("#elsagr_winselfmiddle").load(tGp+'/wp-content/plugins/elsa-grabber/rs/templates/'+a+'.'+b+c);
   jQuery("#elsagrwt").text(STR.m1);
   elsagrShowWin();

  }
function elsagrShowWin()
  {
  jQuery("#elsagrmodalwin").css('display','block');
  }
function elsagrAddTask()
  {
   a={name:jQuery("#add_name").val(),text:jQuery("#add_text").val(),action:jQuery("#add_action").val(),
   time:jQuery("#add_time").val(),type:jQuery("#add_type").val(),task:jQuery("#add_task").val()}
   elsagrCloseWin();
   elsagrLoader(1);
   newid =jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTaskId&k=new&v=new',async: false}).responseText;

  rt=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTask&k=name&v='+a.name+'&t='+parseInt(newid),async: false}).responseText;
  rt1=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTask&k=text&v='+a.text+'&t='+parseInt(newid),async: false}).responseText;
  rt2=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTask&k=action&v='+a.action+'&t='+parseInt(newid),async: false}).responseText;
  rt3=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTask&k=time&v='+a.time+'&t='+parseInt(newid),async: false}).responseText;
  rt4=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTask&k=type&v='+a.type+'&t='+parseInt(newid),async: false}).responseText;
  rt5=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTask&k=task&v='+a.task+'&t='+parseInt(newid),async: false}).responseText;
  //alert(rt5);
  window.location.reload(false);
  }
function elsagrAddTaskFC(a)
  {
  newid =jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTaskId&k=new&v=new',async: false}).responseText;
  rt=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTask&k=name&v=copy from remote task&t='+parseInt(newid),async: false}).responseText;
  rt1=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTask&k=text&v=&t='+parseInt(newid),async: false}).responseText;
  rt2=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTask&k=action&v=off&t='+parseInt(newid),async: false}).responseText;
  rt3=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTask&k=time&v=55&t='+parseInt(newid),async: false}).responseText;
  rt4=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTask&k=type&v=RSS&t='+parseInt(newid),async: false}).responseText;
  rt5=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTask&k=task&v='+a+'&t='+parseInt(newid),async: false}).responseText;

  }
function elsagrActTask(a,b)
  {
  rt=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTask&k=action&v='+b+'&t='+parseInt(a),async: false}).responseText;
  window.location.reload(false);
  }
function elsagrDelTask(a)
  {
  if (window.prompt(STR.m5)=='delete'){
  elsagrLoader(1);
  rt=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrDelTask&k=del&v='+a,async: false}).responseText;
  window.location.reload(false);   }
  }
function elsagrEditTask(a)
  {
  elsagrLoader(1);
  elsagrLoadTemlModal('_edittask','php','t='+a);
  jQuery("#elsagrwt").text(STR.m2);
  }
  
function elsagrEditTaskDo()
  {
  a={name:jQuery("#add_name").val(),text:jQuery("#add_text").val(),action:jQuery("#add_action").val(),
   time:jQuery("#add_time").val(),type:jQuery("#add_type").val(),task:jQuery("#add_task").val(),id:jQuery("#add_id").val()};
   elsagrCloseWin();
   elsagrLoader(1);
  rt=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTask&k=name&v='+a.name+'&t='+parseInt(a.id),async: false}).responseText;
  rt1=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTask&k=text&v='+encodeURIComponent(a.text)+'&t='+parseInt(a.id),async: false}).responseText;
  rt2=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTask&k=action&v='+a.action+'&t='+parseInt(a.id),async: false}).responseText;
  rt3=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTask&k=time&v='+a.time+'&t='+parseInt(a.id),async: false}).responseText;
  rt4=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTask&k=type&v='+a.type+'&t='+parseInt(a.id),async: false}).responseText;
  rt5=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrAddTask&k=task&v='+encodeURIComponent(a.task)+'&t='+parseInt(a.id),async: false}).responseText;
  window.location.reload(false);
  }
function elsagrTestTask(a)
  {
  elsagrLoader(1);
  rt=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrTestTask&k=&id='+a,async: false}).responseText;
  jQuery("#elsagrTestWin").remove();
  jQuery("#elsagrTWT").remove();
  html='<div id="elsagrTestWin"></div><div id="elsagrTWT">'+rt+'</div>';
  jQuery(document.body).append(html);
  elsageActive(1);
  elsagrLoader(2);
  }
function elsagrTestTaskLive()
  {
  elsagrLoader(1);
  var t=encodeURIComponent(jQuery("#add_task").val());
  rt=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrTestTask&live=true&t='+t,async: false}).responseText;
  jQuery("#elsagrTestWin").remove();
  jQuery("#elsagrTWT").remove();
  html='<div id="elsagrTestWin"></div><div id="elsagrTWT">'+rt+'</div>';
  jQuery(document.body).append(html);
  elsageActive(1);
  }
function wlsagrtwc()
  {
  jQuery("#elsagrTestWin").remove();
  jQuery("#elsagrTWT").remove();
  }
  
function elsageActive(a)
  {
  jQuery("#elsageTWmenu").find('li').removeClass('elsagrActAc');
   allwin = new Array(1,2,3,4,5);
   var nn=".elsagrTWtext"+a;
     for (i=1;i<allwin.length+1;i++)
      {
      jQuery(".elsagrTWtext"+i).css('display','none');
      }
  jQuery(nn).css('display','block');
  jQuery("#elsageTWmenu").find('li').eq(a-1).addClass('elsagrActAc');
  }
function elsagrLoadDevTask()
  {
   elsagrCloseWin();
   elsagrLoader(1);
   elsagrLoadTemlModal('_remotetask','php');
   jQuery("#elsagrwt").text(STR.m3);
   elsagrShowWin();
  // elsagrLoader(2);
  }
function elsagrShareTask(a)
  {
  elsagrLoader(1);
  rt=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrShareTask&k=&id='+a,async: false}).responseText;
  elsagrShowMessage(rt);
  elsagrLoader(2);
  }
function elsagrShowMessage(a,b)
  {
   if ((typeof b =="undefined") || (parseInt(b)<0)) {b=3;}

   html='<div id="elsagr_winmessage">';
   html+='<div id="elsagr_winmessage0">';
   html+='<div id="elsagr_winmessage1"><span class="elsagr_wintimer">'+b+'</span></div>';
   html+='<div id="elsagr_winmessage3"><span class="elsagr_winmesstext">'+a+'</span></div>';
   html+='<div id="elsagr_winmessage2"></div>';
   html+='</div></div>';
   jQuery("#elsagr_winmessage").remove();
   jQuery(document.body).append(html);
   tIdg=window.setInterval('elsagrmeswinclose()',1000);
  }
function elsagrmeswinclose()
  {
  el=jQuery(".elsagr_wintimer").length;
  if (el==1)
    {
    elz=parseInt(jQuery(".elsagr_wintimer").text());
    jQuery(".elsagr_wintimer").text(elz-1);
      if (elz-1==0)
        {
        window.clearInterval(tIdg);
        jQuery("#elsagr_winmessage").remove();
        }
    }
  }
function elsagrCheckUpd()
  {
  elsagrLoader(1);
  rt=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrCheckUpd',async: false}).responseText;
  jQuery("#elsagrcheckbutton").remove();
  jQuery("#elsagr_resultupd").html(rt);

  elsagrLoader(2);
  }
function elsagrExportTask()
  {
  elsagrLoader(1);
  rt=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrExportTask',async: false}).responseText;

  if (~rt.indexOf('OK:'))
    {
    window.location.href=rt.substr(rt.indexOf(':')+1);
    }
  else
    {
    elsagrShowMessage(rt,5);
    }
  elsagrLoader(2);
  }
function elsagrImportTask()
  {
  elsagrLoader(1);
  elsagrLoadTemlModal('_upload','php');
  jQuery("#elsagrwt").text(STR.m4);
  }
function elsagrReloadTimePage(a)
  {
  window.setTimeout('elsagrReloadPage()',parseInt(a));
  }
function elsagrReloadPage()
  {
  window.location.href=window.location.href;
  }
