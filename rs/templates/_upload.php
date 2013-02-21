<?php
require_once('../../../../../wp-load.php');

_e('В этом окне вы можете испортировать в базу данных сайта задания которые вы ранее экспортировали
<br />Поддерживается загрузка нескольких файлов, но для этого вам нужно запаковать их в zip архив
<br />Перед началом процедуры импорта убедитесь что директория export внутри папки плагина доступна для записи <br /><br />','ELSAGR');    ?>
<form action="" method=post enctype="multipart/form-data">
<?=__('Выберите файл','ELSAGR');?><br />
<input type="file" name="elsagruploadfile" size="20">
<button type="submit">import</button>
</form>

<script type="text/javascript">
jQuery(document).ready(function(){
   elsagrLoader(2);
}); </script>
