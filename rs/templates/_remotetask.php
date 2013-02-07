<?php
require_once('../../../../../wp-load.php');

?>

<?=__('Введите доменное имя или его часть','ELSAGR');?><br />
<Input type="text" value="" id="elsagrfindtask">
<button onclick="elsagrFindTaskDo()"><?=__('Найти задания','ELSAGR');?></button>


<script type="text/javascript">
function elsagrFindTaskDo()
  {
  elsagrLoader(1);
  param=jQuery("#elsagrfindtask").val();
  rt=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrRemoteTask&k=&id='+param,async: false}).responseText;
  jQuery("#elsagr_findtask").html();
  jQuery("#elsagr_findtask").html(rt);
  elsagrLoader(2);
  }
jQuery(document).ready(function(){
   elsagrLoader(2);
});
function elsagrShowRemoteTask(a)
  {
   elsagrLoader(1);
   rt=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrGetRemoteTask&k=&id='+a,async: false}).responseText;
   names=".elsagr_findtaskline"+a;
   jQuery("#elsagr_remtasktext").remove();
   jQuery(names).after('<div id="elsagr_remtasktext"><code>'+rt+'</code></div>');
   elsagrLoader(2);
  }
function elsagr_copytask(a)
  {
   elsagrLoader(1);
   rt=jQuery.ajax({url:tGp+'/wp-content/plugins/elsa-grabber/ring/back.php?f=elsagrGetRemoteTaskFC&k=&id='+a,async: false}).responseText;
   elsagrAddTaskFC(rt);
   window.location.href=window.location.href;
   
  }
</script>
<br /><br />
<div id="elsagr_findtask">



</div>
