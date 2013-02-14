<?php
require_once('../../../../../wp-load.php');
?>
<div id="elsagr_tmplinp">
<?=__('Имя','ELSAGR');?> <br/>
<input type="text" value="" id="add_name">
 </div>


<div id="elsagr_tmplinp">
<?=__('Тип','ELSAGR');?> <br/>
<select size="1" id="add_type">
	<option value="rss">RSS</option>
	</select>
 </div>


<div id="elsagr_tmplinp">
<?=__('Состояние','ELSAGR');?> <br/>
<select size="1" id="add_action">
	<option value="on">On</option>
	<option value="off" selected>Off</option>
	</select>
 </div>



<div id="elsagr_tmplinp">
<?=__('Описание','ELSAGR');?> <br/>
<textarea id="add_text" style="min-height:30px !important;"></textarea>
 </div>


<div id="elsagr_tmplinp">
<?=__('Период запуска','ELSAGR');?> <div id="elsagrinfopict"><a href="http://savitov.ru/ELSAGR/?a=12" target=_blank><img src="<?=__wUrl__;?>/rs/info.png"></a></div> <br/>
<input type="text" value="" id="add_time">
 </div>




<div id="elsagr_tmplinp">
<?=__('Текст задания','ELSAGR');?> <div id="elsagrinfopict"><a href="http://savitov.ru/ELSAGR/?a=2" target=_blank><img src="<?=__wUrl__;?>/rs/info.png"></a></div> <br/>
<textarea id="add_task"></textarea>
 </div>



<button onclick="elsagrAddTask()"> <?=__('Добавить','ELSAGR');?> </button>
<button onclick="elsagrTestTaskLive()"><?=__('Тестировать','ELSAGR');?></button>
 <button onclick="elsagrCloseWin()"> <?=__('Закрыть','ELSAGR');?> </button>
<script type="text/javascript">
jQuery(document).ready(function(){
   elsagrLoader(2);
}); </script>
