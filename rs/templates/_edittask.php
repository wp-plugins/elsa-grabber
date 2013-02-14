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
<?=__('Имя','ELSAGR');?><br/>
<input type="text" value="<?=$data['name'];?>" id="add_name">
 </div>


<div id="elsagr_tmplinp">
<?=__('Тип','ELSAGR');?><br/>
<select size="1" id="add_type">
	<option value="2" <?=($data['type']=='rss')?" selected ":""?>>RSS</option>

	</select>
 </div>
 
 
<div id="elsagr_tmplinp">
<?=__('Состояние','ELSAGR');?><br/>
<select size="1" id="add_action">
	<option value="on" <?=($data['action']=='on' || $data['action']=='yes')?" selected ":""?>>On</option>
	<option value="off" <?=($data['action']=='off' || $data['action']=='no')?" selected ":""?>>Off</option>
	</select>
 </div>


 
<div id="elsagr_tmplinp">
<?=__('Описание','ELSAGR');?><br/>
<textarea id="add_text" style="min-height:30px !important;"><?=$data['text'];?></textarea>
 </div>


<div id="elsagr_tmplinp">
<?=__('Период запуска','ELSAGR');?> <div id="elsagrinfopict"><a href="http://savitov.ru/ELSAGR/?a=12" target=_blank><img src="<?=__wUrl__;?>/rs/info.png"></a></div><br/>
<input type="text" value="<?=$data['time'];?>" id="add_time">
 </div>
 

 
 
<div id="elsagr_tmplinp">
<?=__('Текст задания','ELSAGR');?> <div id="elsagrinfopict"><a href="http://savitov.ru/ELSAGR/?a=2" target=_blank><img src="<?=__wUrl__;?>/rs/info.png"></a></div> <br/>
<textarea id="add_task"><?=$data['task'];?></textarea>
 </div>



<button onclick="elsagrEditTaskDo()"> <?=__('Сохранить','ELSAGR');?> </button>  <button onclick="elsagrCloseWin()"> Close </button>
<button onclick="elsagrTestTaskLive()"> <?=__('Тестировать','ELSAGR');?> </button>

<button onclick="elsagrShareTask(<?=$data['id'];?>)"><?=__('Разместить в каталоге','ELSAGR');?></button>
<script type="text/javascript">
jQuery(document).ready(function(){
   elsagrLoader(2);
}); </script>
