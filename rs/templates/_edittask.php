<?php
require_once('../../../../../wp-load.php');
$t=new elsa_task();
$data=$t->getTask($_REQUEST['t']);
foreach ($data as $k=>$v)
  {
  $data[$k]=stripslashes($v);
  }

?>
<input type="hidden" value="<?=$data['id'];?>" id="add_id">
<div id="elsagr_tmplinp">
<?=_('Имя','ELSAGR');?><br/>
<input type="text" value="<?=$data['name'];?>" id="add_name">
 </div>


<div id="elsagr_tmplinp">
<?=_('Тип','ELSAGR');?><br/>
<select size="1" id="add_type">
	<option value="2" <?=($data['type']=='rss')?" selected ":""?>>RSS</option>

	</select>
 </div>
 
 
<div id="elsagr_tmplinp">
<?=_('Состояние','ELSAGR');?><br/>
<select size="1" id="add_action">
	<option value="on" <?=($data['action']=='on' || $data['action']=='yes')?" selected ":""?>>On</option>
	<option value="off" <?=($data['action']=='off' || $data['action']=='no')?" selected ":""?>>Off</option>
	</select>
 </div>


 
<div id="elsagr_tmplinp">
<?=_('Описание','ELSAGR');?><br/>
<textarea id="add_text" style="min-height:30px !important;"><?=$data['text'];?></textarea>
 </div>


<div id="elsagr_tmplinp">
<?=_('Период запуска','ELSAGR');?><br/>
<input type="text" value="<?=$data['time'];?>" id="add_time">
 </div>
 

 
 
<div id="elsagr_tmplinp">
<?=_('Текст задания','ELSAGR');?><br/>
<textarea id="add_task"><?=$data['task'];?></textarea>
 </div>



<button onclick="elsagrEditTaskDo()"> <?=_('Сохранить','ELSAGR');?> </button>  <button onclick="elsagrCloseWin()"> Close </button>
<button onclick="elsagrTestTaskLive()"> <?=_('Тестировать','ELSAGR');?> </button>

<button onclick="elsagrShareTask(<?=$data['id'];?>)"><?=_('Разместить в каталоге','ELSAGR');?></button>
<script type="text/javascript">
jQuery(document).ready(function(){
   elsagrLoader(2);
}); </script>
