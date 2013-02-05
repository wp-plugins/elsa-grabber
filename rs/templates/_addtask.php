<?php
require_once('../../../../../wp-load.php');
?>
<div id="elsagr_tmplinp">
<?=_('Имя','ELSAGR');?><br/>
<input type="text" value="" id="add_name">
 </div>


<div id="elsagr_tmplinp">
<?=_('Тип','ELSAGR');?><br/>
<select size="1" id="add_type">
	<option value="rss">RSS</option>
	</select>
 </div>
 
 
<div id="elsagr_tmplinp">
<?=_('Состояние','ELSAGR');?><br/>
<select size="1" id="add_action">
	<option value="on">On</option>
	<option value="off" selected>Off</option>
	</select>
 </div>


 
<div id="elsagr_tmplinp">
<?=_('Описание','ELSAGR');?><br/>
<textarea id="add_text" style="min-height:30px !important;"></textarea>
 </div>


<div id="elsagr_tmplinp">
<?=_('Период запуска','ELSAGR');?><br/>
<input type="text" value="" id="add_time">
 </div>
 

 
 
<div id="elsagr_tmplinp">
<?=_('Текст задания','ELSAGR');?><br/>
<textarea id="add_task"></textarea>
 </div>



<button onclick="elsagrAddTask()"> <?=_('Добавить','ELSAGR');?> </button>
<button onclick="elsagrTestTaskLive()"><?=_('Тестировать','ELSAGR');?></button>
 <button onclick="elsagrCloseWin()"> <?=_('Закрыть','ELSAGR');?> </button>
<script type="text/javascript">
jQuery(document).ready(function(){
   elsagrLoader(2);
}); </script>
